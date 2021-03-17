<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Auth;
use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Todo;
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
        //モデルからユーザー情報を取り出して


        $today = new DateTime();
        
        $users = Auth::user();
        $todos = Auth::user()->todos;

        foreach($users as $user){
            foreach($todos as $todo){
                Mail::raw($todo->deadline, function($message) use ($user,$todo){

                    $message->to($user->email)->subject($todo->todo);

                });
            }
        }





    }



}

