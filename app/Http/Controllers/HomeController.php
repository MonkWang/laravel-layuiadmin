<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('home');
    }

    public function console()
    {
        return view('home.console');
    }

    public function homepage1()
    {
        return view('home.homepage1');
    }

    public function homepage2()
    {
        return view('home.homepage2');
    }
}
