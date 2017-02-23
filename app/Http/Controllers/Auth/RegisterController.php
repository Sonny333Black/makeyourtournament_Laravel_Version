<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Statistic;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

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

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest');
    }



    protected function registerNewUser(Request $request){
        function generateRandomString($length = 50) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        Validator::make($request->all(), [
            'username' => 'required|max:255|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required|min:3|confirmed',
            'g-recaptcha-response' => 'required|captcha',
        ])->validate();

        $statistic = new Statistic();
        $statistic->goals = 0;
        $statistic->owngoals = 0;
        $statistic->points = 0;
        $statistic->wins = 0;
        $statistic->loses = 0;
        $statistic->draws = 0;
        $statistic->totalgames = 0;
        $statistic->save();

        $user1 = new User();
        $user1->username = $request->username;
        $user1->password = bcrypt($request->password);
        $user1->email = $request->email;
        $user1->friend_key =generateRandomString();
        $statistic->user()->save($user1);
        $user1->save();
        return redirect("/");

    }
}
