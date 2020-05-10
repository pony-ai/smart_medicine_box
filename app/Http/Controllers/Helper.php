<?php


namespace App\Http\Controllers;


use GuzzleHttp\Client;

class Helper
{
    const HOST = 'https://www.bigiot.net';
    const PARAMS = [
            "client_id"=>"854",
            "client_secret"=>"13f122ac0a",
            "username"=>"6893",
            "password"=>"ad089318c0",
            "grant_type"=>"password"
        ];

    public static function getAccessToken(){
        $client = new Client();
        $response = $client->request('POST',self::HOST.'/oauth/token', [
                'form_params'=>self::PARAMS,
                //上线后要注释掉verify字段
                'verify' => false,
                'headers'=>[
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ]
            ]);
        $body = $response->getBody();
        $responseArray = json_decode($body,true);
        return $responseArray['access_token'];
    }
}
