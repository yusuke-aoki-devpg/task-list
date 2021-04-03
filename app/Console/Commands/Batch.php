<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Auth;
use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Todo;
use Illuminate\Support\Facades\DB;
use DateTime;
//メール送信用ファサード
use Illuminate\Support\Facades\Mail;

class Batch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'laravel commandのtest';

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
     * @return int
     */
    public function handle()
    {
        // バッチ処理の誤差
        $from = date('Y/m/d H:i:s', strtotime('-5 seconds'));
        $to = date('Y/m/d H:i:s', strtotime('+5 seconds'));

        $todos = Todo::where('deadline', '>', $from)->where('deadline', '<', $to)->get();

        foreach ($todos as $todo) {
            Mail::raw($todo->deadline, function ($message) use ($todo) {
                $message->to($todo->user->email)->subject($todo->todo);
            });
        }

    }



}

