<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TransactionType;

class TransactionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lists = [
            'Debit',
            'Credit'
        ];

        TransactionType::truncate();
        
        foreach($lists as $value){
            $transaction_description        = new TransactionType();
            $transaction_description->name  = $value;
            $transaction_description->save();
        }
    }
}
