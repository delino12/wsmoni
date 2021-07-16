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

    /*
    |-----------------------------------------
    | DASHBOARD
    |-----------------------------------------
    */
    public function dashboard(Request $request){
        // body
        return view('dashboard');
    }

    /*
    |-----------------------------------------
    | TRANSACTIONS
    |-----------------------------------------
    */
    public function transactions(Request $request){
        // body
        return view('transactions');
    }

    /*
    |-----------------------------------------
    | DEPOSIT
    |-----------------------------------------
    */
    public function deposit(Request $request){
        // body
        return view('deposit');
    }

    /*
    |-----------------------------------------
    | TRANSFER
    |-----------------------------------------
    */
    public function transfer(Request $request){
        // body
        return view('transfer');
    }
}
