<?php namespace App\Http\Controllers;
use App\User;

/***************************************************************************************
                Wichtigster Controller, hauptsächlich View
 **************************************************************************************/
class PageController extends Controller {


    public function home() {

        if(\Auth::user()){
            $user = User::find(\Auth::user()->id);
            return view('welcome',["user"=>$user]);
        }else{
            return view('welcome');
        }

    }

}