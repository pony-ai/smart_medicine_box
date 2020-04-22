<?php


namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MedicineModel extends Model
{
    protected $connection = 'iot_smb';
    protected $table = 'medicine';
    public $timestamps = TRUE;

    public function add($arr)
    {
        return DB::connection($this->connection)->table($this->table)->insert($arr);
    }

    public function lst(){
        return DB::connection($this->connection)->table($this->table)->get();
    }
}
