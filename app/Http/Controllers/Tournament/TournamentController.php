<?php namespace App\Http\Controllers\Tournament;
use App\User;
use App\Tournament;
use App\Modus;
use App\Team;
use App\GroupCard;
use App\Round;
use App\Statistic;
use App\Matching;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

/***************************************************************************************
                Controller für die Turniere
 **************************************************************************************/
class TournamentController extends Controller {

    public function getCreateTournament() {
        $modu = Modus::all();
        return view ('inapp/createTournament',['modus'=>$modu]);
    }

    public function postCreateTournament(Request $request) {
        $user = User::find(\Auth::user()->id);
        $countFriends = $user->friends()->count();

        Validator::make($request->all(), [
            'turniername' => 'required|max:255|min:3',
            'modus' => 'required',
            'anzahlGruppen' => 'integer|min:0|max:8',
            'anzahlSpieler' => 'required|integer|min:2|max:'.($countFriends+1),
            'teamsProSpieler' => 'required|integer|min:1',
        ])->validate();

        $tur = new Tournament();
        $tur->name=$request->turniername;
        $tur->winner=0;
        $tur->countUser=$request->anzahlSpieler;
        $tur->countTeamsForUser=$request->teamsProSpieler;
        $tur->owner=$user->id;
        $tur->status=0;
        if($request->modus==1){
            $tur->countGroups = $request->anzahlGruppen;
        }
        if($request->modus==2){
            $tur->countGroups = 1;
        }
        if($request->modus==3){
            $tur->countGroups = 1;
        }

        $modu = Modus::find($request->modus);
        $modu->tournament()->save($tur);
        $tur->save();
        $user->tournaments()->save($tur);
        return view ('inapp/pickTeams',['tour'=>$tur,'user'=>$user,'friends'=>$this->giveFriendArray()]);
    }

    public function fromGroupToKO(Request $request){
        $tour = Tournament::find($request->tour_id);
        $tour->status = 2;
        $tour->save();
        $cards= GroupCard::where('tournament_id',$tour->id)
            ->join('statistics', 'statistics.id', '=', 'statistic_id')
            ->orderBy('statistics.points','DES')
            ->orderBy(DB::raw('ABS(statistics.goals) - ABS(statistics.owngoals)'),'DES' )
            ->orderBy('statistics.goals','DES')
            ->get();

        $tourArrayWithTeams= array();

        for ($i = 0; $i < $tour->countGroups; $i++){
            $j=0;
            foreach($cards as $card){
                if($card->groupNumber === $i+1){
                    $tourArrayWithTeams[$i][$j]=$card;
                    $j++;
                }
            }
        }

        $anzahlGruppen=$tour->countGroups;
        $gruppen=$tourArrayWithTeams;
        $roundstartAt=0;
        if($anzahlGruppen<3){
            $roundstartAt=4;
        }else if($anzahlGruppen<5){
            $roundstartAt=3;
        }else if($anzahlGruppen>=5){
            $roundstartAt=2;
        }

        if($anzahlGruppen % 2 == 0){
            for($i = 0; $i < $anzahlGruppen; $i = $i+2){

                $match = new Matching();
                $match->teamA = $gruppen[$i][0]->team->id;
                $match->teamB = $gruppen[$i+1][1]->team->id;
                $match->goalA = -1;
                $match->goalB = -1;
                $match->round()->associate(Round::find($roundstartAt));
                $tour->matchings()->save($match);
                $match->save();

                $match = new Matching();
                $match->teamA = $gruppen[$i+1][0]->team->id;
                $match->teamB = $gruppen[$i][1]->team->id;
                $match->goalA = -1;
                $match->goalB = -1;
                $match->round()->associate(Round::find($roundstartAt));
                $tour->matchings()->save($match);
                $match->save();
            }
        }
        if($roundstartAt==2){
            $match = new Matching();
            $match->teamA = -1;
            $match->teamB = -1;
            $match->goalA = -1;
            $match->goalB = -1;
            $match->round()->associate(Round::find(3));
            $tour->matchings()->save($match);
            $match->save();
            $match = new Matching();
            $match->teamA = -1;
            $match->teamB = -1;
            $match->goalA = -1;
            $match->goalB = -1;
            $match->round()->associate(Round::find(3));
            $tour->matchings()->save($match);
            $match->save();
            $match = new Matching();
            $match->teamA = -1;
            $match->teamB = -1;
            $match->goalA = -1;
            $match->goalB = -1;
            $match->round()->associate(Round::find(3));
            $tour->matchings()->save($match);
            $match->save();
            $match = new Matching();
            $match->teamA = -1;
            $match->teamB = -1;
            $match->goalA = -1;
            $match->goalB = -1;
            $match->round()->associate(Round::find(3));
            $tour->matchings()->save($match);
            $match->save();
            $match = new Matching();
            $match->teamA = -1;
            $match->teamB = -1;
            $match->goalA = -1;
            $match->goalB = -1;
            $match->round()->associate(Round::find(4));
            $tour->matchings()->save($match);
            $match->save();
            $match = new Matching();
            $match->teamA = -1;
            $match->teamB = -1;
            $match->goalA = -1;
            $match->goalB = -1;
            $match->round()->associate(Round::find(4));
            $tour->matchings()->save($match);
            $match->save();
            $match = new Matching();
            $match->teamA = -1;
            $match->teamB = -1;
            $match->goalA = -1;
            $match->goalB = -1;
            $match->round()->associate(Round::find(5));
            $tour->matchings()->save($match);
            $match->save();
        }else if($roundstartAt==3){
            $match = new Matching();
            $match->teamA = -1;
            $match->teamB = -1;
            $match->goalA = -1;
            $match->goalB = -1;
            $match->round()->associate(Round::find(4));
            $tour->matchings()->save($match);
            $match->save();
            $match = new Matching();
            $match->teamA = -1;
            $match->teamB = -1;
            $match->goalA = -1;
            $match->goalB = -1;
            $match->round()->associate(Round::find(4));
            $tour->matchings()->save($match);
            $match->save();
            $match = new Matching();
            $match->teamA = -1;
            $match->teamB = -1;
            $match->goalA = -1;
            $match->goalB = -1;
            $match->round()->associate(Round::find(5));
            $tour->matchings()->save($match);
            $match->save();
        }else if($roundstartAt==4){
            $match = new Matching();
            $match->teamA = -1;
            $match->teamB = -1;
            $match->goalA = -1;
            $match->goalB = -1;
            $match->round()->associate(Round::find(5));
            $tour->matchings()->save($match);
            $match->save();
        }

        return Redirect::action('Tournament\TournamentController@tournament', array('tour_id' => $tour->id));
    }
    public function editTournament(Request $request){
        $tur= Tournament::find($request->tour_id);
        //für Gruppe
        if($tur->modus_id==1){
            //for tournaments with groups
            if(count($tur->groupCards) > 0 ){
                if($tur->status == 0){
                    return view('inapp/editGroupPick',['tour'=>$tur]);
                }else{
                    return Redirect::action('Tournament\TournamentController@tournament', array('tour_id' => $tur->id));
                }
            }
        }

        //für Gruppe
        if($tur->modus_id==2){
            if($tur->status == 0) {
                return view('inapp/editGroupPick', ['tour' => $tur]);
            }else{
                return Redirect::action('Tournament\TournamentController@tournament', array('tour_id' => $tur->id));
            }
        }
        //für KO Turniere
        if($tur->modus_id==3){
            if($tur->status <= 0){
                if(count($tur->matchings)==0){
                    $user = User::find(\Auth::user()->id);
                    return view ('inapp/pickTeams',['tour'=>$tur,'user'=>$user,'friends'=>$this->giveFriendArray()]);
                }else{
                    $user = User::find(\Auth::user()->id);
                    return view ('inapp/editKOPick',['tour'=>$tur,'user'=>$user,'friends'=>$this->giveFriendArray()]);
                }
            }

            //for tournaments they finished
            if($tur->status >= 1){
                return Redirect::action('Tournament\TournamentController@tournament', array('tour_id' => $tur->id));
            }
        }

        $user = User::find(\Auth::user()->id);
        return view ('inapp/pickTeams',['tour'=>$tur,'user'=>$user,'friends'=>$this->giveFriendArray()]);
    }
    protected function newKOPick(Request $request){
        $tour= Tournament::find($request->tour_id);
        if($tour->status == 0){
            $teamArray = array();
            foreach($tour->matchings as $match){
                if($match->teamA != -1 && $match->teamB != -1){
                    array_push($teamArray,Team::find($match->teamA));
                    array_push($teamArray,Team::find($match->teamB));
                }
            }

            Matching::where('tournament_id','=',$tour->id)->delete();

            $this->makeKOMatches($tour,$teamArray);
        }
        return Redirect::action('Tournament\TournamentController@editTournament', array('tour_id' => $tour->id));
    }
    protected function startKOTournament(Request $request){
        $tour= Tournament::find($request->tour_id);
        $tour->status = 2 ;
        $tour->save();
        return Redirect::action('Tournament\TournamentController@tournament', array('tour_id' => $tour->id));
    }
    public function tournament(Request $request){
        $tour = Tournament::find($request->tour_id);

        $cards= GroupCard::where('tournament_id',$tour->id)
            ->join('statistics', 'statistics.id', '=', 'statistic_id')
            ->orderBy('statistics.points','DES')
            ->orderBy(DB::raw('ABS(statistics.goals) - ABS(statistics.owngoals)'),'DES' )
            ->orderBy('statistics.goals','DES')
            ->get();

        return view('inapp/tournament',['tour'=>$tour,'cards'=>$cards]);
    }

    public function searchUserPick(Request $request){
        $friendArray = $this->giveFriendArray();
        $user = User::find($request->input('user_id'));
        $data   = ["action"=>"teamsFromUser","teams"=>$user->teams,"position"=>$request->input('position')];
        return  \Response::json($data);
    }

    public function pickTeams(Request $request){
        $tour = Tournament::find($request->tour_id);

            if($tour->modus_id == 1){
                $userArray = array();
                for ($i = 0; $i < $tour->countUser ; $i++){
                    array_push($userArray,User::find($request[$i.'user']));
                }
                $teamArray = array();
                for ($i = 0; $i < $tour->countUser ; $i++){
                    for ($j = 0; $j < $tour->countTeamsForUser ; $j++){
                        array_push($teamArray,Team::find($request[$i.'team'.$j]));
                    }
                }
                for ($i = 0; $i < count($userArray) ; $i++){
                    if($userArray[$i]->id !== \Auth::user()->id){
                        $userArray[$i]->tournaments()->save($tour);
                    }

                }
                for ($i = 0; $i < count($teamArray) ; $i++){
                    $card = new GroupCard();
                    $card->done=false;
                    $card->groupNumber=0;
                    $stat = $this->zeroStats();
                    $card->statistic()->associate($stat);
                    $card->team()->associate($teamArray[$i]);
                    $card->tournament()->associate($tour);
                    $card->save();
                }
                $this->mixTeamsToGroups($tour);
            }
            if($tour->modus_id == 2){
            $userArray = array();
            for ($i = 0; $i < $tour->countUser ; $i++){
                array_push($userArray,User::find($request[$i.'user']));
            }
            $teamArray = array();
            for ($i = 0; $i < $tour->countUser ; $i++){
                for ($j = 0; $j < $tour->countTeamsForUser ; $j++){
                    array_push($teamArray,Team::find($request[$i.'team'.$j]));
                }
            }
            for ($i = 0; $i < count($userArray) ; $i++){
                if($userArray[$i]->id !== \Auth::user()->id){
                    $userArray[$i]->tournaments()->save($tour);
                }

            }
            for ($i = 0; $i < count($teamArray) ; $i++){
                $card = new GroupCard();
                $card->done=false;
                $card->groupNumber=1;
                $stat = $this->zeroStats();
                $card->statistic()->associate($stat);
                $card->team()->associate($teamArray[$i]);
                $card->tournament()->associate($tour);
                $card->save();
            }
            $this->getMatching($tour);
            $tour->status=1;
            $tour->save();

        }
            if($tour->modus_id == 3){
            $userArray = array();
            for ($i = 0; $i < $tour->countUser ; $i++){
                array_push($userArray,User::find($request[$i.'user']));
            }
            $teamArray = array();
            for ($i = 0; $i < $tour->countUser ; $i++){
                for ($j = 0; $j < $tour->countTeamsForUser ; $j++){
                    array_push($teamArray,Team::find($request[$i.'team'.$j]));
                }
            }
            for ($i = 0; $i < count($userArray) ; $i++){
                if($userArray[$i]->id !== \Auth::user()->id){
                    $userArray[$i]->tournaments()->save($tour);
                }

            }

            $this->makeKOMatches($tour,$teamArray);

        }

        return Redirect::action('Tournament\TournamentController@editTournament', array('tour_id' => $tour->id));
    }
    protected function makeKOMatches($tour,$teamArray){
    $countTeams=count($teamArray);
        shuffle($teamArray);
    $roundstartAt=0;
    if($countTeams<=4){
        $roundstartAt=4;
    }else if($countTeams<=8){
        $roundstartAt=3;
    }else if($countTeams<=16){
        $roundstartAt=2;
    }

    for($i = 0; $i < $countTeams; $i = $i+2){
        $match = new Matching();
        $match->teamA = $teamArray[$i]->id;
        $match->teamB = $teamArray[$i+1]->id;
        $match->goalA = -1;
        $match->goalB = -1;
        $match->round()->associate(Round::find($roundstartAt));
        $tour->matchings()->save($match);
        $match->save();
    }

    if($roundstartAt==2){
        $match = new Matching();
        $match->teamA = -1;
        $match->teamB = -1;
        $match->goalA = -1;
        $match->goalB = -1;
        $match->round()->associate(Round::find(3));
        $tour->matchings()->save($match);
        $match->save();
        $match = new Matching();
        $match->teamA = -1;
        $match->teamB = -1;
        $match->goalA = -1;
        $match->goalB = -1;
        $match->round()->associate(Round::find(3));
        $tour->matchings()->save($match);
        $match->save();
        $match = new Matching();
        $match->teamA = -1;
        $match->teamB = -1;
        $match->goalA = -1;
        $match->goalB = -1;
        $match->round()->associate(Round::find(3));
        $tour->matchings()->save($match);
        $match->save();
        $match = new Matching();
        $match->teamA = -1;
        $match->teamB = -1;
        $match->goalA = -1;
        $match->goalB = -1;
        $match->round()->associate(Round::find(3));
        $tour->matchings()->save($match);
        $match->save();
        $match = new Matching();
        $match->teamA = -1;
        $match->teamB = -1;
        $match->goalA = -1;
        $match->goalB = -1;
        $match->round()->associate(Round::find(4));
        $tour->matchings()->save($match);
        $match->save();
        $match = new Matching();
        $match->teamA = -1;
        $match->teamB = -1;
        $match->goalA = -1;
        $match->goalB = -1;
        $match->round()->associate(Round::find(4));
        $tour->matchings()->save($match);
        $match->save();
        $match = new Matching();
        $match->teamA = -1;
        $match->teamB = -1;
        $match->goalA = -1;
        $match->goalB = -1;
        $match->round()->associate(Round::find(5));
        $tour->matchings()->save($match);
        $match->save();
    }else if($roundstartAt==3){
        $match = new Matching();
        $match->teamA = -1;
        $match->teamB = -1;
        $match->goalA = -1;
        $match->goalB = -1;
        $match->round()->associate(Round::find(4));
        $tour->matchings()->save($match);
        $match->save();
        $match = new Matching();
        $match->teamA = -1;
        $match->teamB = -1;
        $match->goalA = -1;
        $match->goalB = -1;
        $match->round()->associate(Round::find(4));
        $tour->matchings()->save($match);
        $match->save();
        $match = new Matching();
        $match->teamA = -1;
        $match->teamB = -1;
        $match->goalA = -1;
        $match->goalB = -1;
        $match->round()->associate(Round::find(5));
        $tour->matchings()->save($match);
        $match->save();
    }else if($roundstartAt==4){
        $match = new Matching();
        $match->teamA = -1;
        $match->teamB = -1;
        $match->goalA = -1;
        $match->goalB = -1;
        $match->round()->associate(Round::find(5));
        $tour->matchings()->save($match);
        $match->save();
    }

    $tour->save();
}
    protected function mixTeamsToGroupNew(Request $request){
        $tour = Tournament::find($request->tour_id);
        $this->mixTeamsToGroups($tour);
        return Redirect::action('Tournament\TournamentController@editTournament', array('tour_id' => $tour->id));
    }


    protected function startTournament(Request $request){
        $tour = Tournament::find($request->tour_id);
        $this->getMatching($tour);
        $tour->status=1;
        $tour->save();
        return Redirect::action('Tournament\TournamentController@tournament', array('tour_id' => $tour->id));
    }


    protected function mixTeamsToGroups($tour){
        foreach ($tour->groupCards as $card){
            $card->groupNumber= 0;
            $card->save();
        }
        
        $countTeamsPerGroup = count($tour->groupCards)/$tour->countGroups;
        $countTeamsPerGroup= ceil($countTeamsPerGroup);

        foreach ($tour->groupCards as $card){
            $randomNumber = rand(1,$tour->countGroups);
            $numberOfMembersInGroup = count($tour->groupCards->where('groupNumber',$randomNumber));
            while($numberOfMembersInGroup >= $countTeamsPerGroup){
                $randomNumber = rand(1,$tour->countGroups);
                $numberOfMembersInGroup = count($tour->groupCards->where('groupNumber',$randomNumber));
            }
            $card->groupNumber = $randomNumber;
            $card->save();
        }
    }
    protected function endGroup(Request $request){
        $tour = Tournament::find($request->tour_id);
        $tour->status = 3;

        $card= GroupCard::where('tournament_id',$tour->id)
            ->join('statistics', 'statistics.id', '=', 'statistic_id')
            ->orderBy('statistics.points','DES')
            ->orderBy(DB::raw('ABS(statistics.goals) - ABS(statistics.owngoals)'),'DES' )
            ->orderBy('statistics.goals','DES')
            ->first();

        $tour->winner = $card->team_id;
        $tour->save();
        return redirect('/');
    }
    protected function tournamentKOFinished(Request $request){
        $tour = Tournament::find($request->tour_id);
        $tour->status =3;
        $tour->save();
        return redirect('/');
    }
    protected function giveFriendArray(){
        $user = User::find(\Auth::user()->id);
        $friends = array();
        $friends[0] = "-";
        foreach ($user->friends as $temp){
            $friends[$temp->id] = $temp->username;
        }
        $friends[$user->id] = $user->username;
        return $friends;
    }
    protected function saveMatch(Request $request){
        Validator::make($request->all(), [
            'goalA' => 'required|integer|min:0',
            'goalB' => 'required|integer|min:0',
        ])->validate();

        $match =  Matching::find($request->match_id);
        if($match->goalA==-1){
            $this->saveNewMatch($match,$request->goalA,$request->goalB);
        }else{
            $this->clearMatch($match);
            $this->saveNewMatch($match,$request->goalA,$request->goalB);
        }
        $tour = $match->tournament;
        return Redirect::action('Tournament\TournamentController@tournament', array('tour_id' => $tour->id));
    }
    protected function saveMatchKO(Request $request){

        Validator::make($request->all(), [
            'goalA' => 'required|integer|min:0',
            'goalB' => 'required|integer|min:0',
        ])->validate();

        $match =  Matching::find($request->match_id);
        if(!Team::find($match->teamA)|| !Team::find($match->teamB)){
            $tour = $match->tournament;
            return Redirect::action('Tournament\TournamentController@tournament', array('tour_id' => $tour->id));
        }
        if($request->goalA == $request->goalB) {
            $tour = $match->tournament;
            return Redirect::action('Tournament\TournamentController@tournament', array('tour_id' => $tour->id));
        }
        if($match->goalA == -1 ||$match->goalB == -1){
            $this->saveNewMatchKO($match,$request->goalA,$request->goalB);
            $this->goToNextRound($match);

        }else{
            $this->clearMatchKO($match);
            $this->saveNewMatchKO($match,$request->goalA,$request->goalB);
            $this->goToNextRound($match);
        }
        $tour = $match->tournament;

        return Redirect::action('Tournament\TournamentController@tournament', array('tour_id' => $tour->id));
    }
    protected function clearMatch($match){
        $tour = $match->tournament;
        $goalA=$match->goalA;
        $goalB=$match->goalB;

        $teamA= Team::find($match->teamA);
        $cardA = $tour->groupCards->where('team_id',$teamA->id)->first();
        $statCard = Statistic::find($cardA->statistic->id);
        $this->removePointsToStat($statCard,$goalA,$goalB);

        $teamB= Team::find($match->teamB);
        $cardB = $tour->groupCards->where('team_id',$teamB->id)->first();
        $statCard = Statistic::find($cardB->statistic->id);
        $this->removePointsToStat($statCard,$goalB,$goalA);


        if($teamA->user->id !== $teamB->user->id){
            $statCard = Statistic::find($teamA->statistic->id);
            $this->removePointsToStat($statCard,$goalA,$goalB);
            $user = $teamA->user;
            $statCard = Statistic::find($user->statistic->id);
            $this->removePointsToStat($statCard,$goalA,$goalB);

            $statCard = Statistic::find($teamB->statistic->id);
            $this->removePointsToStat($statCard,$goalB,$goalA);
            $user = $teamB->user;
            $statCard = Statistic::find($user->statistic->id);
            $this->removePointsToStat($statCard,$goalB,$goalA);
        }
    }
    protected function saveNewMatch($match,$goalA,$goalB){
        $tour = $match->tournament;

        $match->goalA = $goalA;
        $match->goalB = $goalB;
        $match->save();

        $teamA= Team::find($match->teamA);
        $teamB= Team::find($match->teamB);

        $cardA = $tour->groupCards->where('team_id',$teamA->id)->first();
        $statCard = Statistic::find($cardA->statistic->id);
        $this->givePointsToStat($statCard,$goalA,$goalB);

        $cardB = $tour->groupCards->where('team_id',$teamB->id)->first();
        $statCard = Statistic::find($cardB->statistic->id);
        $this->givePointsToStat($statCard,$goalB,$goalA);

        if($teamA->user->id != $teamB->user->id){
            $statCard = Statistic::find($teamA->statistic->id);
            $this->givePointsToStat($statCard,$goalA,$goalB);
            $user = $teamA->user;
            $statCard = Statistic::find($user->statistic->id);
            $this->givePointsToStat($statCard,$goalA,$goalB);

            $statCard = Statistic::find($teamB->statistic->id);
            $this->givePointsToStat($statCard,$goalB,$goalA);
            $user = $teamB->user;
            $statCard = Statistic::find($user->statistic->id);
            $this->givePointsToStat($statCard,$goalB,$goalA);
        }

    }
    protected function clearMatchKO($match){
        $tour = $match->tournament;
        $goalA=$match->goalA;
        $goalB=$match->goalB;

        if($match->goalA!=-1&&$match->goalB!=-1){
            $teamA= Team::find($match->teamA);
            $statCard = Statistic::find($teamA->statistic->id);
            $this->removePointsToStat($statCard,$goalA,$goalB);
            $user = $teamA->user;
            $statCard = Statistic::find($user->statistic->id);
            $this->removePointsToStat($statCard,$goalA,$goalB);

            $teamB= Team::find($match->teamB);
            $statCard = Statistic::find($teamB->statistic->id);
            $this->removePointsToStat($statCard,$goalB,$goalA);
            $user = $teamB->user;
            $statCard = Statistic::find($user->statistic->id);
            $this->removePointsToStat($statCard,$goalB,$goalA);
        }
    }
    protected function saveNewMatchKO($match,$goalA,$goalB){
        $tour = $match->tournament;
        $match->goalA = $goalA;
        $match->goalB = $goalB;
        $match->save();


        $teamA= Team::find($match->teamA);
        $teamB= Team::find($match->teamB);
        if($teamA->user->id != $teamB->user->id){
            $statCard = Statistic::find($teamA->statistic->id);
            $this->givePointsToStat($statCard,$goalA,$goalB);
            $user = $teamA->user;
            $statCard = Statistic::find($user->statistic->id);
            $this->givePointsToStat($statCard,$goalA,$goalB);

            $statCard = Statistic::find($teamB->statistic->id);
            $this->givePointsToStat($statCard,$goalB,$goalA);
            $user = $teamB->user;
            $statCard = Statistic::find($user->statistic->id);
            $this->givePointsToStat($statCard,$goalB,$goalA);
        }
    }
    protected function givePointsToStat($statCard,$goals,$owngoals){
        $statCard->goals = $statCard->goals+$goals;
        $statCard->owngoals = $statCard->owngoals+$owngoals;
        $result = $this->giveResult($goals,$owngoals);
        if($result==1){
            $statCard->points = $statCard->points+3;
            $statCard->wins = $statCard->wins+1;
        }else if($result==2){
            $statCard->points = $statCard->points+1;
            $statCard->draws = $statCard->draws+1;
        }else{
            $statCard->points = $statCard->points+0;
            $statCard->loses = $statCard->loses+1;
        }
        $statCard->totalgames = $statCard->totalgames+1;
        $statCard->save();
    }
    protected function removePointsToStat($statCard,$goals,$owngoals){
        $result = $this->giveResult($statCard->goals,$statCard->owngoals);
        if($result==1){
            $statCard->points = $statCard->points-3;
            $statCard->wins = $statCard->wins-1;
        }else if($result==2){
            $statCard->points = $statCard->points-1;
            $statCard->draws = $statCard->draws-1;
        }else{
            $statCard->points = $statCard->points-0;
            $statCard->loses = $statCard->loses-1;
        }
        $statCard->goals = $statCard->goals-$goals;
        $statCard->owngoals = $statCard->owngoals-$owngoals;
        $statCard->totalgames = $statCard->totalgames-1;
        $statCard->save();
    }
    protected function goToNextRound($match){
        $round = $match->round;
        $tour = $match->tournament;
        $matchesTemp = Matching::where('tournament_id',$tour->id)->where('round_id','>',1)->get();
        $matches=array();
        $currentArrayNumber=0;
        for($i = 0; $i < count($matchesTemp);$i++){
            $matches[$i+1]=$matchesTemp[$i];
        }
        for($i = 1; $i <= count($matches);$i++){
            if($matches[$i]->id == $match->id){
                $currentArrayNumber=$i;
            }
        }
        $matchNr= $currentArrayNumber;
        $indikator = 0;

        switch($round->id){
            case 2:
                $indikator = 8;
                break;
            case 3:
                if($matchNr <= 4)
                    $indikator = 4;
                else
                    $indikator = 8;
                break;
            case 4:
                if($matchNr <= 2)
                    $indikator = 2;
                else if($matchNr == 5 || $matchNr == 6)
                    $indikator = 4;
                else
                    $indikator = 8;
                break;
            case 5:
                if($match->goalA>$match->goalB){
                    $tour->winner=$match->teamA;
                    $tour->save();
                }
                if($match->goalA<$match->goalB){
                    $tour->winner=$match->teamB;
                    $tour->save();
                }
                return;
        }

        if($match->goalA>$match->goalB){
            $newMatchNumber = 0;
            if($matchNr % 2 == 1){
                $newMatchNumber= ($matchNr + $indikator)-(($matchNr -1)/2);
                $this->clearMatchKO($matches[$newMatchNumber]);
                $matches[$newMatchNumber]->teamA = $match->teamA;
            }else{
                $newMatchNumber= ($matchNr + $indikator)-($matchNr / 2);
                $this->clearMatchKO($matches[$newMatchNumber]);
                $matches[$newMatchNumber]->teamB = $match->teamA;
            }

            $matches[$newMatchNumber]->save();

        }
        if($match->goalA==$match->goalB){
            return 2;
        }
        if($match->goalA<$match->goalB){
            $newMatchNumber = 0;
            if($matchNr % 2 == 1){
                $newMatchNumber= ($matchNr + $indikator)-(($matchNr -1)/2);
                $this->clearMatchKO($matches[$newMatchNumber]);
                $matches[$newMatchNumber]->teamA = $match->teamB;
            }else{
                $newMatchNumber= ($matchNr + $indikator)-($matchNr / 2);
                $this->clearMatchKO($matches[$newMatchNumber]);
                $matches[$newMatchNumber]->teamB = $match->teamB;
            }
            $matches[$newMatchNumber]->save();
        }
    }
    protected function giveResult($goals,$owngoals){
        if($goals>$owngoals){
            return 1;
        }
        if($goals==$owngoals){
            return 2;
        }
        if($goals<$owngoals){
            return 3;
        }
        return 4;
    }
    protected function getMatching($tour){

        $gruppenArray = array();

        for ($i = 0; $i < $tour->countGroups ; $i++){
            $teamCountInGroup=0;
            foreach ($tour->groupCards as $card){
                if($card->groupNumber-1==$i){
                    $gruppenArray[$i][$teamCountInGroup]=$card;
                    $teamCountInGroup=$teamCountInGroup+1;
                }
            }
        }

        for ($groupNumber = 0; $groupNumber < $tour->countGroups ; $groupNumber++){

            if(count($gruppenArray[$groupNumber])%2 == 1){
                $a = count($gruppenArray[$groupNumber])-1;
                $n = (count($gruppenArray[$groupNumber])-1) / 2;

                for($i = 0; $i < count($gruppenArray[$groupNumber]); $i++){
                    for($k = 0; $k <$n; $k++){
                        $this->makeMatch($gruppenArray[$groupNumber][$k], $gruppenArray[$groupNumber][$a - $k], $tour);
                    }
                    for($l = 0; $l < count($gruppenArray[$groupNumber])-1; $l++){
                        $temp = $gruppenArray[$groupNumber][$l];
                        $gruppenArray[$groupNumber][$l] = $gruppenArray[$groupNumber][$l+1];
                        $gruppenArray[$groupNumber][$l+1] = $temp;
                    }
                }
            } else {
                $a = count($gruppenArray[$groupNumber]) - 1;
                $n = count($gruppenArray[$groupNumber]) / 2;

                for ($i = 0; $i < count($gruppenArray[$groupNumber]) - 1; $i++) {
                    for ($k = 0; $k < $n; $k++) {
                        $this->makeMatch($gruppenArray[$groupNumber][$k], $gruppenArray[$groupNumber][$a - $k], $tour);
                    }
                    for ($l = 1; $l < count($gruppenArray[$groupNumber]) - 1; $l++) {
                        $temp = $gruppenArray[$groupNumber][$l];
                        $gruppenArray[$groupNumber][$l] = $gruppenArray[$groupNumber][$l + 1];
                        $gruppenArray[$groupNumber][$l + 1] = $temp;
                    }
                }
            }
        }
        if($tour->modus->id==2){
            for ($groupNumber = 0; $groupNumber < $tour->countGroups ; $groupNumber++){

                if(count($gruppenArray[$groupNumber])%2 == 1){
                    $a = count($gruppenArray[$groupNumber])-1;
                    $n = (count($gruppenArray[$groupNumber])-1) / 2;

                    for($i = 0; $i < count($gruppenArray[$groupNumber]); $i++){
                        for($k = 0; $k <$n; $k++){
                            $this->makeMatch( $gruppenArray[$groupNumber][$a - $k],$gruppenArray[$groupNumber][$k], $tour);
                        }
                        for($l = 0; $l < count($gruppenArray[$groupNumber])-1; $l++){
                            $temp = $gruppenArray[$groupNumber][$l];
                            $gruppenArray[$groupNumber][$l] = $gruppenArray[$groupNumber][$l+1];
                            $gruppenArray[$groupNumber][$l+1] = $temp;
                        }
                    }
                } else {
                    $a = count($gruppenArray[$groupNumber]) - 1;
                    $n = count($gruppenArray[$groupNumber]) / 2;

                    for ($i = 0; $i < count($gruppenArray[$groupNumber]) - 1; $i++) {
                        for ($k = 0; $k < $n; $k++) {
                            $this->makeMatch($gruppenArray[$groupNumber][$a - $k],$gruppenArray[$groupNumber][$k],  $tour);
                        }
                        for ($l = 1; $l < count($gruppenArray[$groupNumber]) - 1; $l++) {
                            $temp = $gruppenArray[$groupNumber][$l];
                            $gruppenArray[$groupNumber][$l] = $gruppenArray[$groupNumber][$l + 1];
                            $gruppenArray[$groupNumber][$l + 1] = $temp;
                        }
                    }
                }
            }
        }
        return Redirect::action('Tournament\TournamentController@tournament', array('tour_id' => $tour->id));
    }
    protected function makeMatch($cardA,$cardB,$tour){
            $match = new Matching();
            $match->teamA = $cardA->team->id;
            $match->teamB = $cardB->team->id;
            $match->goalA = -1;
            $match->goalB = -1;
            $match->round()->associate(Round::find(1));
            $tour->matchings()->save($match);
            $match->save();
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