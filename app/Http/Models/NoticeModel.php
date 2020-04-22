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
        return DB::connection($this->connection)->table($this->table)->insert($arr);
//        return $this->save($arr);
    }

    public function lst()
    {
        return DB::connection($this->connection)
            ->table($this->table)
            ->get();
    }
}
