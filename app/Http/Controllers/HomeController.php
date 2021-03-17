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

        $dtoday = date("Y-m-d");
        $d3DaysLater = date("Y-m-d", strtotime('+ 3 days'));
        $d7DaysLater = date("Y-m-d", strtotime('+ 7 days'));
        $todos = Auth::user()->todos()->orderByRaw('`deadline` IS NULL ASC')->orderBy('deadline')->whereDay('deadline', '>=', $today)->get();

        return view('home', [
            'todos' => $todos,
            'dtoday' => $dtoday,
            'd3DaysLater' => $d3DaysLater,
            'd7DaysLater' => $d7DaysLater
        ]);
    }
}
