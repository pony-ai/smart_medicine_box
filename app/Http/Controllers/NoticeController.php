<?php


namespace App\Http\Controllers;


use App\Http\Models\NoticeModel;
use Illuminate\Http\Request;

class NoticeController
{
    protected $notice;

    public function __construct()
    {
        $this->notice = new NoticeModel();
    }

    /**
     * Add notices
     * @param Request $request
     * @return array
     * @Author ponyxiao
     * @Date 2020/4/20 21:13
     */
    public function addNotice(Request $request){
        $noticeData = $request->all();
        $noticeData['isMeal'] = true ? 1 : 0;
        $noticeData['secondTime'] = $request->input('secondTime',0);
        $noticeData['thirdTime'] = $request->input('thirdTime',0);
        $res = $this->notice->add($noticeData);
        if ($res){
            return json_encode(['code'=>1001,'msg'=>'add notice success']);
        }
        return json_encode(['code'=>1002,'msg'=>'add notice fail']);
    }

    /**
     * Get notice list
     * @return false|string
     * @Author ponyxiao
     * @Date 2020/4/21 9:25
     */
    public function showNotice(){
        $res = $this->notice->lst();
        if ($res){
            return json_encode(['code'=>1003,'msg'=>'get notice success','data'=>$res]);
        }else{
            return json_encode(['code'=>1004,'msg'=>'get notice fail','data'=>null]);
        }
    }
}
