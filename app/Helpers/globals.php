<?php

use App\Models\Transaction;
use App\Models\Wallet;

if(!function_exists("accountBalance")){
    function accountBalance($user_id){
        // body
        $debit_balance = Transaction::where('user_id', $user_id)->where('transaction_type_id', 1)->sum('amount');
        $credit_balance = Transaction::where('user_id', $user_id)->where('transaction_type_id', 2)->sum('amount');

        if($debit_balance <= $credit_balance){
            $balance = $credit_balance - $debit_balance;
        }elseif($debit_balance >= $credit_balance){
            $balance = $debit_balance - $credit_balance;
        }

        return number_format($balance, 2);
    }
}


if(!function_exists("walletId")){
    function walletId($user_id){
        // body
        $wallet = Wallet::where('user_id', $user_id)->first();

        // return
        return $wallet->wallet_code;
    }
}