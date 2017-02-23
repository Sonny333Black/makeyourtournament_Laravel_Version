<?php namespace App\Http\Controllers\Team;
use App\User;
use App\Tournament;
use App\Modus;
use App\Statistic;
use App\Team;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/***************************************************************************************
                Controller für die Teams
 **************************************************************************************/
class TeamController extends Controller {

    public function getMyTeams() {
        $user = User::find(\Auth::user()->id);
        return view ('inapp/myTeams',['user'=>$user]);
    }

    public function addTeam(Request $request) {
        $user = User::find(\Auth::user()->id);
        Validator::make($request->all(), [
            'name' => 'required|max:255|min:3',
        ])->validate();

        $team = new Team();
        $team->name = $request->name;
        $stat = $this->zeroStats();
        $team->statistic()->associate($stat);
        $user->teams()->save($team);
        $team->save();

        return view ('inapp/myTeams',['user'=>$user]);
    }
    public function deleteTeam(Request $request) {
        /*$user = User::find(\Auth::user()->id);
        $team = Team::find($request->team_id);
        $team->statistic()->delete();
        $user->team
        $team->delete();
        return view ('inapp/myTeams',['user'=>$user]);*/
    }

    protected function zeroStats(){
        $statistic = new Statistic();
        $statistic->goals = 0;
        $statistic->owngoals = 0;
        $statistic->points = 0;
        $statistic->wins = 0;
        $statistic->loses = 0;
        $statistic->draws = 0;
        $statistic->totalgames = 0;
        $statistic->save();
        return $statistic;
    }

}