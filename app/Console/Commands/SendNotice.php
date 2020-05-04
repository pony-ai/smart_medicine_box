<?php

namespace App\Console\Commands;

use App\Http\Controllers\TakeMedicineNotice;
use Illuminate\Console\Command;

class SendNotice extends Command
{
    /**
     * The name and signature of the console command.
     *向硬件端发送定时提醒指令
     * @var string
     */
    protected $signature = 'SendNotice';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notices';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //设置时区
        date_default_timezone_set("PRC");
        /**
         * 开始执行
         */
        (new TakeMedicineNotice())->run();

    }
}
