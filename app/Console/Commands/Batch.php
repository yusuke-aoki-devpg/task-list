<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
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
        //モデルからユーザー情報を取り出して
        $users = User::all();
        //メールアドレスで繰り返し
        foreach ($users as $user) {
            echo $user['email']."\n";

            Mail::raw("勉強しろや", function($message) use ($user)
            {
                $message->to($user->email)->subject('山岡朋樹のGmailから送信');
            });
        }
    }
}

