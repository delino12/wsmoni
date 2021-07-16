<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;

class WalletController extends Controller
{
    /*
    |-----------------------------------------
    | WALLET RESOLVE
    |-----------------------------------------
    */
    public function resolve(Request $request){
        // body
        $wallet = new Wallet();
        $data   = $wallet->resolve($request);

        // return.
        return response()->json($data);
    }
}
