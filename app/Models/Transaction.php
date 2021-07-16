<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TransactionType;
use App\Models\TransactionDescription;
use App\Models\User;

class Transaction extends Model
{
    use HasFactory;


    /*
    |-----------------------------------------
    | GLUE TRANSACTION TYPE
    |-----------------------------------------
    */
    public function transaction_type(){
        // body
        return $this->hasOne(TransactionType::class, 'id', 'transaction_type_id');
    }

    /*
    |-----------------------------------------
    | GLUE TRANSACTION DESCRIPTION
    |-----------------------------------------
    */
    public function transaction_description(){
        // body
        return $this->hasOne(TransactionDescription::class, 'id', 'transaction_description_id');
    }

    /*
    |-----------------------------------------
    | GLUE USER
    |-----------------------------------------
    */
    public function user(){
        // body
        return $this->hasOne(User::class, 'id');
    }

    /*
    |-----------------------------------------
    | DEBIT USER
    |-----------------------------------------
    */
    public function debit($payload){
        // body
        $transactions                               = new Transaction();
        $transactions->user_id                      = $payload->user_id;
        $transactions->amount                       = $payload->amount;
        $transactions->transaction_type_id          = 1; // 1 credit 2 debit
        $transactions->transaction_description_id   = $payload->transaction_description_id; // 1 Deposit 2 Withdraw 
        $transactions->reference                    = strtolower(\Str::random(10));
        $transactions->currency                     = "NGN";
        $transactions->narration                    = $payload->narration;
        $transactions->save();
    }

    /*
    |-----------------------------------------
    | CREDIT USER
    |-----------------------------------------
    */
    public function credit($payload){
        // body
        $transactions                               = new Transaction();
        $transactions->user_id                      = $payload->user_id;
        $transactions->amount                       = $payload->amount;
        $transactions->transaction_type_id          = 2; // 1 credit 2 debit
        $transactions->transaction_description_id   = $payload->transaction_description_id; // 1 Deposit 2 Withdraw 
        $transactions->reference                    = strtolower(\Str::random(10));
        $transactions->currency                     = "NGN";
        $transactions->narration                    = $payload->narration;
        $transactions->save();
    }

    /*
    |-----------------------------------------
    | WALLET BALANCE
    |-----------------------------------------
    */
    public function balance($payload){
        // body
        $debit_balance = Transaction::where('user_id', auth()->user()->id)->where('transaction_type_id', 1)->sum('amount');
        $credit_balance = Transaction::where('user_id', auth()->user()->id)->where('transaction_type_id', 2)->sum('amount');

        if($debit_balance <= $credit_balance){
            $balance = $credit_balance - $debit_balance;
        }elseif($debit_balance >= $credit_balance){
            $balance = $debit_balance - $credit_balance;
        }

        $data = [
            'balance' => number_format($balance, 2)
        ];

        // return
        return $data;
    }

    /*
    |-----------------------------------------
    | GET ALL TRANSACTIONS
    |-----------------------------------------
    */
    public function history($payload){
        // body
        $transactions = Transaction::where('user_id', auth()->user()->id)
        ->with('transaction_type')
        ->with('transaction_description')
        ->with('user')
        ->orderBy('id', 'DESC')->get();

        $transactions->transform(function($item){
            $item->amount = number_format($item->amount, 2);
            $item->date = $item->created_at->diffForHumans();
            return $item;
        });

        // return
        return $transactions;
    }
}
