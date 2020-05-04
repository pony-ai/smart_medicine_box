<?php


namespace App\Http\Controllers;


use App\Http\Models\MedicineModel;
use App\Http\Models\MemberModel;
use App\Http\Models\NoticeModel;
use Illuminate\Http\Request;

class NoticeController
{
    protected $notice;
    protected $medicine;
    protected $member;

    public function __construct()
    {
        $this->notice = new NoticeModel();
        $this->medicine = new MedicineModel();
        $this->member = new MemberModel();
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
        if ($noticeData['isMeal'] < 1){
            $noticeData['isMeal'] = 0;
        } else{
            $noticeData['isMeal'] = 1;
        }
        $noticeData['secondTime'] = $request->input('secondTime',0);
        $noticeData['thirdTime'] = $request->input('thirdTime',0);
        $noticeData['box'] = $this->medicine->getMedicineBox($noticeData['mName'])->box;
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
        $medicine = $this->medicine->getMedicineName();
        $member = $this->member->getAllMemberName();
        foreach ($res as $key=>$val){
            $val->mName = $medicine[$val->mName]->mName;
            $val->member = $member[$val->member]->name;
        }
        if ($res){
            return json_encode(['code'=>1003,'msg'=>'get notice success','data'=>$res]);
        }else{
            return json_encode(['code'=>1004,'msg'=>'get notice fail','data'=>null]);

        }
    }

    public function delNotice($id){
        $res = $this->notice->del($id);
        if ($res){
            return json_encode(['code'=>1005,'msg'=>'Delete notice success']);
        }
        return json_encode(['code'=>1006,'msg'=>'Delete notice fail']);
    }
}
