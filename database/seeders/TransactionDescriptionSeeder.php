<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TransactionDescription;

class TransactionDescriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lists = [
            'Deposit',
            'Withdraw',
            'Transaction'
        ];

        TransactionDescription::truncate();
        
        foreach($lists as $value){
            $transaction_description        = new TransactionDescription();
            $transaction_description->name  = $value;
            $transaction_description->save();
        }
    }
}
