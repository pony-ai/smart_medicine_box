<?php


namespace App\Http\Controllers;


use App\Http\Models\MemberModel;
use Illuminate\Http\Request;

class MemberController
{
    protected $member;

    public function __construct()
    {
        $this->member = new MemberModel();
    }

    public function addMember(Request $request){
        $member = $request->all();
        $res = $this->member->add($member);
        if ($res){
            return json_encode(['code'=>1001,'msg'=>'Add member success...']);
        }
        return json_encode(['code'=>1002,'msg'=>'Add member fail...']);
    }

    public function showMember(){
        $res = $this->member->lst();
        if ($res){
            return json_encode(['code'=>1003,'msg'=>'Get member success...','data'=>$res]);
        }
        return json_encode(['code'=>1004,'msg'=>'Get member fail...','data'=>null]);
    }
}
