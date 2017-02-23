<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\User;
use Illuminate\Support\Facades\Mail;
class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    protected function postLogin(Request $request) {

        if (Auth::attempt(['email'=> $request->username, 'password'=> $request->password])) {
            return redirect('/');
        }
        if (Auth::attempt(['username'=> $request->username, 'password'=> $request->password])) {
            return redirect('/');
        }
        return redirect('/')->withErrors([
            'email' => 'Email oder Passwort falsch! Bitte versuchen Sie es erneut.',
        ]);
    }
    protected function logoutUser(){
        return redirect('impressum');
    }

    protected function showPasswordReset() {
        return View('/user/passwordReset');
    }
    protected function passwordReset(Request $request) {
        $email = $request->email;
        $user = User::where('email',$email)->first();

        if($user === null){
            return redirect('/user/passwordReset')->withErrors([
                'error' => 'Email stimmt nicht überein.',
            ]);
        }

        $pw = "new" . rand(0, 10000) ;
        $user->password = bcrypt($pw);
        $user->save();

        Mail::send('user.pwMail.passwordReset',['user' => $user->username, 'pw' => $pw], function ($message) use ($user)
        {
            $message->from('info@makeyourtournament.de', 'makeyourtournament');
            $message->to($user->email);
            $message->subject('makeyourtournament Passwort zurückgesetzt');
        });
        Mail::send('user.pwMail.passwordResetReminder',['user' => $user->username], function ($message) use ($user)
        {
            $message->from('info@makeyourtournament.de', 'makeyourtournament');
            $message->to('info@makeyourtournament.de');
            $message->subject('Reminder Passwort Reset');
        });

        session(['msg' => 'Passwort wurde zurückgesetzt. Ihnen wurde eine E-Mail gesendet.']);
        return view('welcome');
    }


}
