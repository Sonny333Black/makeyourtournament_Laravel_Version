<?php

Route::get('/', 'PageController@home');
Route::post('/', 'PageController@home');

Route::get('/register', function () {
    return view('static/register');
});
Route::get('/impressum', function () {
    return view('static/impressum');
});

Route::get('tournament', 'Tournament\TournamentController@tournament');

Route::post('register', 'Auth\RegisterController@registerNewUser');
Route::post('login', 'Auth\LoginController@postLogin');

Route::get('user/passwordReset', 'Auth\LoginController@showPasswordReset');
Route::post('user/resetPasswordAction', 'Auth\LoginController@passwordReset');


Route::group(['middleware' => 'auth'], function () {

    Route::get('settings', 'Usersettings\SettingController@getSettings');
    Route::post('settings', 'Usersettings\SettingController@getSettings');
    Route::post('userUpdate', 'Usersettings\SettingController@getUserUpdate');
    Route::post('passwordChange', 'Usersettings\SettingController@getPasswordChange');
    Route::post('pwChangeConfirm', 'Usersettings\SettingController@pwChange');
    Route::post('showDeleteUser', 'Usersettings\SettingController@showDeleteUser');
    Route::post('deleteUser', 'Usersettings\SettingController@deleteUser');
    Route::post('searchFriends', 'Usersettings\SettingController@searchFriends');
    Route::post('deleteFriend', 'Usersettings\SettingController@deleteFriend');


    Route::get('createTournament', 'Tournament\TournamentController@getCreateTournament');
    Route::post('createTournament', 'Tournament\TournamentController@postCreateTournament');
    Route::get('editTournament', 'Tournament\TournamentController@editTournament');
    Route::post('editTournament', 'Tournament\TournamentController@editTournament');
    Route::post('startTournament', 'Tournament\TournamentController@startTournament');
    Route::post('tournamentKOFinished', 'Tournament\TournamentController@tournamentKOFinished');
    Route::post('endGroup', 'Tournament\TournamentController@endGroup');
    Route::post('fromGroupToKO', 'Tournament\TournamentController@fromGroupToKO');
    Route::post('startKOTournament', 'Tournament\TournamentController@startKOTournament');
    Route::post('newKOPick', 'Tournament\TournamentController@newKOPick');




    Route::get('searchUserPick', 'Tournament\TournamentController@searchUserPick');
    Route::post('pickTeams', 'Tournament\TournamentController@pickTeams');
    Route::post('mixTeamsToGroupNew', 'Tournament\TournamentController@mixTeamsToGroupNew');

    Route::post('saveMatch', 'Tournament\TournamentController@saveMatch');
    Route::post('saveMatchKO', 'Tournament\TournamentController@saveMatchKO');


    Route::get('myTeams', 'Team\TeamController@getMyTeams');
    Route::post('addTeam', 'Team\TeamController@addTeam');
    Route::post('deleteTeam', 'Team\TeamController@deleteTeam');





    Route::get('/logout', function () {
        Auth::logout();
        Session::flash('msg', 'Sie wurden ausgelogt');
        return redirect('/');
    });
});