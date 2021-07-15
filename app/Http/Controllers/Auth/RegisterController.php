<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Transaction;
use App\Models\Wallet;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $already_exist = User::where('email', 'admin@wsmoni.com')->first();
        if($already_exist == null){
            $system_user = User::create([
                'name' => 'System Adminstrator',
                'email' => 'admin@wsmoni.com',
                'password' => Hash::make('password'),
            ]);

            // create wallet 
            $user_wallet                = new Wallet();
            $user_wallet->user_id       = $system_user->id;
            $user_wallet->wallet_code   = rand(1111, 9999);
            $user_wallet->status        = true;
            $user_wallet->save();

            // 

        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // create wallet 
        $user_wallet                = new Wallet();
        $user_wallet->user_id       = $user->id;
        $user_wallet->wallet_code   = rand(1111, 9999);
        $user_wallet->status        = true;
        $user_wallet->save();

        // bonus deposit


        return $user;
    }
}
