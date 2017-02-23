<?php

namespace App\Http\Controllers\Usersettings;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SettingController extends Controller
{
    protected function getSettings(){
        $user = Auth::user();
        return View("user/setting",['user'=>$user]);
    }

    protected function showDeleteUser() {
        $user = User::find(\Auth::user()->id);
        return View('user/showDeleteUser');
    }
    protected function deleteUser() {
        $userid = \Auth::user()->id;
        $user = User::find($userid);
        $user->statistic->delete();
        DB::delete('DELETE FROM `user_has_friends` WHERE  user_id=' . $user->id);

        $tempUser = User::where('email',"quiz@me.de")->first();

        foreach ($user->tournaments as $tour){
            $tour->owner = $tempUser->id;
            $tour->save();
            $tempUser->tournaments()->save($tour);
        }
        DB::delete('DELETE FROM `user_tournament` WHERE  user_id=' . $user->id);
        foreach ($user->teams as $team){
            $team->user_id=$tempUser->id;
            $team->save();
        }

        $user->delete();
        Session::flash('msg', 'Account wurde gelöscht');
        return redirect('/');
    }
    protected function getPasswordChange() {
        $user = User::find(\Auth::user()->id);
        return View('user/showPwChange');
    }
    protected function pwChange(Request $request) {

        $validator = Validator::make($request->all(), [
            'oldPassword' => 'required',
            'password' => 'required|min:3|confirmed',
        ]);

        if ($validator->fails()) {
            return View('user/showPwChange')->withErrors([
                'error' => 'Fehler bei der eingabe.',
            ]);
        }

        $pass = bcrypt($request->password);
        $oldpass = $request->oldPassword;

        $userid = \Auth::user()->id;
        $user = User::find($userid);

        if (Hash::check($oldpass, $user->password)) {
            $user->password = $pass;
            $user->save();
            return redirect('/settings');
        }else{
            return View('user/showPwChange')->withErrors([
                'error' => 'Altes Passwort stimmt nicht überein.',
            ]);
        }

    }

    protected function getUserUpdate(Request $request) {
        $userid = \Auth::user()->id;
        $user = User::find($userid);

        Validator::make($request->all(), [
            'username' => 'required|max:255|unique:users,username,'.$userid,
            'email' => 'required|unique:users,email,'.$userid,
        ])->validate();

        $user->username = $request->username;
        $user->email = $request->email;

        $user->save();

        return redirect('settings');
    }

    protected function searchFriends(Request $request) {
        $user = User::find(\Auth::user()->id);
        $key = $request->freundesschluessel;

        /*$friend_all =  DB::select( DB::raw("select * from users as u join user_has_friends on user_id <> 1 where friend_key = 'bwPr9O2LM8DZYKGDg8UqNF2UzhSOtmgFT563U8OHhrGgbnTsvN'") );
        */
        $friend = User::where('id','!=',$user->id)->where('friend_key','=',$key)->first();

        $isFriend= 3;
        if($friend){
            $isFriend_raw =  DB::select("select * from user_has_friends where user_id = $user->id && friend_id = $friend->id");
            $isFriend = count($isFriend_raw);
        }

        if($isFriend==0){
            $user->friends()->save($friend);
            $friend->friends()->save($user);
            Session::flash('msg', 'Du bist mit '.$friend->username.' befreundet.');
        }else if($isFriend==3) {
            Session::flash('msg', 'Fehler! Key war falsch, oder es war dein eigener oder ihr seid bereits befreundet.');
        }else{
            Session::flash('msg', 'Fehler! Key war falsch, oder es war dein eigener oder ihr seid bereits befreundet.');
            }
        return redirect('/');
    }
    protected function deleteFriend (Request $request){
        $friend = User::find($request->friend_id);
        $user = User::find(\Auth::user()->id);
        DB::select("delete from user_has_friends where (user_id = $user->id && friend_id = $friend->id)");
        DB::select("delete from user_has_friends where (friend_id = $user->id && user_id = $friend->id)");
        Session::flash('msg', 'Freund gelöscht');
        return redirect('/');
    }

}
