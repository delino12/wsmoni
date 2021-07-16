<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Wallet extends Model
{
    use HasFactory;


    /*
    |-----------------------------------------
    | RESOLVE
    |-----------------------------------------
    */
    public function resolve($payload){
        // body
        $wallet = Wallet::where('wallet_code', $payload->wallet_code)->first();
        if($wallet == null){
            $data = [
                'status'    => 'error',
                'message'   => 'Invalid wallet ID'
            ];
        }else{
            $user = User::find($wallet->user_id);
            if($user == null){
                $data = [
                    'status'    => 'error',
                    'message'   => 'Invalid wallet ID'
                ];
            }else{
                $data = [
                    'status'    => 'success',
                    'message'   => $user->name
                ];
            }
        }

        // return
        return $data;
    }
}
