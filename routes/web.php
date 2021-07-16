<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/transactions', 'HomeController@transactions')->name('transactions');
Route::get('/deposit',      'HomeController@deposit')->name('deposit');
Route::get('/transfer',     'HomeController@transfer')->name('transfer');



Route::get('transactions/balance',  'TransactionController@balance');
Route::get('transactions/history',  'TransactionController@history');
Route::post('transactions/post',    'TransactionController@post');
Route::post('transactions/deposit', 'TransactionController@deposit');
Route::post('transactions/transfer', 'TransactionController@transfer');


Route::post('wallet/resolve',       'WalletController@resolve');