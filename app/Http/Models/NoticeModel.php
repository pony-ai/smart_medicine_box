<?php


namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class NoticeModel extends Model
{
    protected $connection = 'iot_smb';
    protected $table = 'notice';

    public function add(array $arr)
    {
        return DB::connection($this->connection)
            ->table($this->table)
            ->insert($arr);
    }

    public function lst()
    {
        return DB::connection($this->connection)
            ->table($this->table)
            ->get()
            ->toArray();
    }

    public function del($id)
    {
         return DB::connection($this->connection)
            ->table($this->table)
            ->where('id',$id)
            ->delete();
    }

    public function getNoticeDate()
    {
        return DB::connection($this->connection)
            ->table($this->table)
            ->select('firstTime','secondTime','thirdTime')
            ->get()
            ->toArray();
    }

    public function getRecords($data)
    {
        return DB::connection($this->connection)
            ->table($this->table)
            ->select('member','mName')
            ->where('box',$data)
            ->orderByDesc('id')
            ->first();
    }
}
