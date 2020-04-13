<?php


namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;

class IndexController
{
    public function index()
    {
        $result = DB::table('user')->get();

        return $result;

    }
}
