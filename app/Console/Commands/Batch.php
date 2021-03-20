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
        // $todos = Todo::where('deadline', '=', date('Y-m-d H:i:s'),time()-86400)->get();
        // $today = new DateTime();

        for ($i = 1; $i < User::count() + 2; $i++) {

            $users = User::where('id', '=', $i)->get();
            $todos = Todo::where('user_id', '=', $i)->whereDay('deadline', '=', date('Y-m-d H:i:s'),time()-86400)->get();

            foreach ($users as $user) {
                foreach ($todos as $todo) {
                    Mail::raw($todo->deadline, function ($message) use ($user, $todo) {
                        $message->to($user->email)->subject($todo->todo);
                    });
                }
            }
        }
    }
}
