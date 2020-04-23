<?php


namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MemberModel extends Model
{
    protected $connection = 'iot_smb';
    protected $table = 'member';

    public function add(array $data){
        return DB::connection($this->connection)->table($this->table)->insert($data);
    }

    public function lst(){
        return DB::connection($this->connection)->table($this->table)->get();
    }
}
