<?php


namespace App\Http\Controllers;


use App\Http\Models\NoticeModel;
use GuzzleHttp\Client;

class TakeMedicineNotice extends Controller
{
    const DEVICE = 'D17357';
    const SEND_COMMAND = '/oauth/say';
    public $client;
    public $notice;
    public $access_token;
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://www.bigiot.net',
        ]);
        $this->access_token = Helper::getAccessToken();
        $this->notice = new NoticeModel();
    }

    public function run(){
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
    }
}
