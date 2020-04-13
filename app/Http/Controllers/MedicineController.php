<?php


namespace App\Http\Controllers;


class MedicineController
{
    public function addMedicine(){
        $mData = $_POST;
        return json_encode('send success');
    }
}
