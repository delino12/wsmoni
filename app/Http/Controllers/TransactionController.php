<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    /*
    |-----------------------------------------
    | AUTHENTICATION
    |-----------------------------------------
    */
    public function __construct(){
        // body
        $this->middleware('auth');
    }
    
    /*
    |-----------------------------------------
    | SHOW VIEW INDEX
    |-----------------------------------------
    */
    public function index(Request $request){
        // body
        return view('index');
    }
    
    /*
    |-----------------------------------------
    | CREATE or STORE DATA 
    |-----------------------------------------
    */
    public function addOne(Request $request){
        // body
    }
    
    /*
    |-----------------------------------------
    | FETCH DATA 
    |-----------------------------------------
    */
    public function fetchOne(Request $request){
        // body
    }
    
    /*
    |-----------------------------------------
    | FETCH ALL DATA 
    |-----------------------------------------
    */
    public function transfer(Request $request){
        // body
        $transaction = new Transaction();
        $data        = $transaction->transfer($request);

        // return
        return $data;
    }
    
    /*
    |-----------------------------------------
    | MODIFY or UPDATE DATA 
    |-----------------------------------------
    */
    public function deposit(Request $request){
        // body
        $transaction = new Transaction();
        $data        = $transaction->deposit($request);

        // return
        return $data;
    }
    
    /*
    |-----------------------------------------
    | DELETE DATA
    |-----------------------------------------
    */
    public function balance(Request $request){
        // body
        $transaction = new Transaction();
        $data        = $transaction->balance($request);

        // return
        return $data;
    }
    
    /*
    |-----------------------------------------
    | DESTROY DATA
    |-----------------------------------------
    */
    public function history(Request $request){
        // body
        $transaction = new Transaction();
        $data        = $transaction->history($request);

        // return
        return $data;
    }
    
    
}
