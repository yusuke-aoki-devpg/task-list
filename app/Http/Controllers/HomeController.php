<?php

namespace App\Http\Controllers;


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
        // return view('home');

        $today = new DateTime();
        $todos = Auth::user()->todos()->orderByRaw('`deadline` IS NULL ASC')->orderBy('deadline')->whereDay('deadline', '>=', $today)->get();

        return view('home', [
            'todos' => $todos,
        ]);
    }
}
