<?php


namespace App\Http\Models;


use Illuminate\Support\Facades\DB;

class RecordsModel
{
    protected $connection = 'iot_smb';
    protected $table = 'records';

    public function add($data){
        return DB::connection($this->connection)
            ->table($this->table)
            ->insert($data);
    }

    public function isExist($time)
    {
        return DB::connection($this->connection)
            ->table($this->table)
            ->where('open_time',$time)
            ->first();
    }

    public function lst()
    {
        return DB::connection($this->connection)
            ->table($this->table)
            ->orderBy('id','desc')
            ->get()
            ->toArray();
    }
}
