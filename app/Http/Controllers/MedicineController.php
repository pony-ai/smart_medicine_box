<?php


namespace App\Http\Controllers;


class MedicineController extends Controller
{
    public function addMedicine(){
        $mData = $_POST;
        var_dump($mData);
    }
}
