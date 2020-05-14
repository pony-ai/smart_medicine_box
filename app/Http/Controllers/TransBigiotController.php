<?php


namespace App\Http\Controllers;


use App\Http\Models\MedicineModel;
use App\Http\Models\MemberModel;
use App\Http\Models\NoticeModel;
use App\Http\Models\RecordsModel;
use GuzzleHttp\Client;

class TransBigiotController
{
    const WIGHT_ID = 8669;
    const TEMP_ID = 15581;
    const HUM_ID = 8657;
    const IS_OPEN = 8666;
    const DEVICE = 'D17357';
    const HISTORY_DATA_API = '/oauth/historydata';
    const SEND_COMMAND = '/oauth/say';

    public $access_token;
    public $client;

    public $records;
    public $notice;
    public $member;
    public $medicine;
    public function __construct()
    {
        date_default_timezone_set("PRC");
        $this->notice = new NoticeModel();
        $this->member = new MemberModel();
        $this->medicine = new MedicineModel();
        $this->records = new RecordsModel();
        $this->access_token = Helper::getAccessToken();
        $this->client = new Client([
            'base_uri' => 'https://www.bigiot.net',
        ]);
    }

    /**
     * 获取压力数据
     * @return mixed
     * @Author ponyxiao
     * @Date 2020/5/8 12:17
     */
    public function getPressure(){
        $params = [
            'access_token'=>$this->access_token,
            'id'=>self::WIGHT_ID
        ];
        $response = $this->client->request('GET',self::HISTORY_DATA_API,[
            'query'=>$params,
            'headers'=>[
                'Content-Type' => 'application/json;charset=UTF-8'
            ],
            //上线后要注释掉verify字段
            'verify' => false,
        ]);
        $body = $response->getBody()->getContents();
        //去点非法字符\ufeff
        $tmp = substr($body,3);
        $res = json_decode($tmp,true);
        $now = count($res);
        $pressureCurrent = $res[$now-1];
        return $pressureCurrent;
    }

    /**
     * 获取温度
     * @return mixed
     * @Author ponyxiao
     * @Date 2020/5/14 17:28
     */
    public function getTemp(){
        $params = [
            'access_token'=>$this->access_token,
            'id'=>self::TEMP_ID
        ];
        $response = $this->client->request('GET',self::HISTORY_DATA_API,[
            'query'=>$params,
            'headers'=>[
                'Content-Type' => 'application/json;charset=UTF-8'
            ],
            //上线后要注释掉verify字段
            'verify' => false,
        ]);
        $body = $response->getBody()->getContents();
        //去点非法字符\ufeff
        $tmp = substr($body,3);
        $res = json_decode($tmp,true);
        $now = count($res);
        $tempCurrent = $res[$now-1];
        return $tempCurrent;
    }


    public function getHum(){
        $params = [
            'access_token'=>$this->access_token,
            'id'=>self::HUM_ID
        ];
        $response = $this->client->request('GET',self::HISTORY_DATA_API,[
            'query'=>$params,
            'headers'=>[
                'Content-Type' => 'application/json;charset=UTF-8'
            ],
            //上线后要注释掉verify字段
            'verify' => false,
        ]);
        $body = $response->getBody()->getContents();
        //去点非法字符\ufeff
        $tmp = substr($body,3);
        $res = json_decode($tmp,true);
        $now = count($res);
        $humCurrent = $res[$now-1];
        return $humCurrent;
    }
    /**
     * 获取服药记录
     * @return array|string
     * @Author ponyxiao
     * @Date 2020/5/9 9:59
     */
    public function getRecords(){
        $params = [
            'access_token'=>$this->access_token,
            'id'=>self::IS_OPEN,
        ];
        $response = $this->client->request('GET',self::HISTORY_DATA_API,[
            'query'=>$params,
            'headers'=>[
                'Content-Type' => 'application/json;charset=UTF-8'
            ],
            //上线后要注释掉verify字段
            'verify' => false,
        ]);
        $body = $response->getBody()->getContents();
        $tmp = substr($body,3);
        $recordsData = json_decode($tmp,true);

        $item = 0;
        for ($i=0;$i<count($recordsData);$i++){
            if(substr($recordsData[$i]['value'],-1)==0){
                $item = $i;
                break;
            }
        }
        /*
         * 已知药仓
         * 服药记录包含字段：服药人；药品名称；服药时间；
         * */
//        dd($item);
        $time = $recordsData[$item]['time'];
        $isInsert = $this->isInsert($time);
//        dd($isInsert);
        if (is_null($isInsert)){
            $box = substr($recordsData[$item]['value'],0,1);
            /*
             * 获取服药人和药品名称
             * */
            $notice = $this->notice->getRecords($box);
            $member = $this->member->getAllMemberName();
            $medicine = $this->medicine->getMedicineName();

            $data = [
                'open_time'=>$time,
                'box'=>$box,
                'member'=>$member[$notice->member]->name,
                'mName'=>$medicine[$notice->mName]->mName,
            ];
            $result = $this->records->add($data);
            if (!$result){
                return 'insert fail';
            }
        }
        $return = $this->records->lst();
        foreach ($return as $key=>$val){
            $val->open_time = date('Y-m-d H:i:s',$val->open_time);
        }

        return $return;

    }

    /**
     * 发送开箱指令
     * @return int
     * @Author ponyxiao
     * @Date 2020/5/9 15:53
     */
    public function openBox(){
//        dd($this->access_token);
        $params = [
            'access_token'=>$this->access_token,
            'id'=>self::DEVICE,
            'c'=>'open'
        ];
//        dd($params);
        $response = $this->client->request('POST',self::SEND_COMMAND,[
            'form_params'=>$params,
            //上线后要注释掉verify字段
            'verify' => false,
            'headers'=>[
                'Content-Type' => 'application/x-www-form-urlencoded',
            ]
        ]);
        $body = $response->getBody()->getContents();
//        var_dump($body);
        if ($body!='ok'){
            return $body;
        }
        return 'ok';
    }

    /**
     * 是否提醒
     * @return int|string
     * @Author ponyxiao
     * @Date 2020/5/10 9:29
     */
    public function isNotice(){
        $noticeTime = $this->notice->getNoticeDate();
        $arr = [];
        foreach ($noticeTime as $key=>$val){
            $arr[] = $val->firstTime;
            $arr[] = $val->secondTime;
            $arr[] = $val->thirdTime;
        }
        $now = date('H:i',time());
        if (in_array($now,$arr)){
            $params = [
                'access_token'=>$this->access_token,
                'id'=>self::DEVICE,
                'c'=>'auto'
            ];
            $response = $this->client->request('POST',self::SEND_COMMAND,[
                'form_params'=>$params,
                //上线后要注释掉verify字段
                'verify' => false,
                'headers'=>[
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ]
            ]);
            $body = $response->getBody()->getContents();
            return $body;
        }
        return 'un_send';


    }
    private function isInsert($time)
    {
        return $this->records->isExist($time);
    }
}
