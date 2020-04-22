<?php


namespace App\Http\Controllers;


use App\Http\Models\MedicineModel;
use Illuminate\Http\Request;

class MedicineController
{
    protected $medicine;

    public function __construct()
    {
        $this->medicine = new MedicineModel();
    }

    /**
     * Add medicine
     * @param Request $request
     * @return false|int|string
     * @Author ponyxiao
     * @Date 2020/4/16 9:27
     */
    public function addMedicine(Request $request){
        $mData = $request->all();
        if (empty($mData)) return json_encode(['code'=>1001,'msg'=>'上传信息为空']);
        $res = $this->medicine->add($mData);
        if (!$res) return 1002;
        return 1003;
    }

    /**
     * Show medicine
     * @return false|string
     * @Author ponyxiao
     * @Date 2020/4/21 0:25
     */
    public function showMedicine(){
        $data = $this->medicine->lst();
        return json_encode($data);
    }
}
