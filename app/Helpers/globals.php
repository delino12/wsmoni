<?php

use App\Models\Transaction;

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