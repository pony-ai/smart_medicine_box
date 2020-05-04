<?php


namespace App\Http\Controllers;


use App\Http\Models\NoticeModel;
use GuzzleHttp\Client;

class TakeMedicineNotice extends Controller
{
    public $client;
    public $notice;
    public function __construct()
    {
        $this->client = new Client();
        $this->notice = new NoticeModel();
    }

    public function run(){

    }
}
