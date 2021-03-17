<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DateTime;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $today = new DateTime();
// テスト----------------------------------------
        $targetTime = Auth::user()->todos()->select('deadline')->whereDay('deadline', '=', $today)->exists();

        if($targetTime) {
            echo '存在する！';
            //現在のユーザーのデータ
            echo Auth::user();
            echo Auth::user()->todos()->whereDay('deadline', '>=', $today)->get();
        }

// Viewに表示する---------------------------------
        $todos = Auth::user()->todos->orderByRaw('`deadline` IS NULL ASC')->orderBy('deadline')->whereDay('deadline', '>=', $today)->get();

        return view('home', [
            'todos' => $todos,
        ]);
    }
}
