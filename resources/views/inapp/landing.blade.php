@if(Auth::user()->teams->count()==0)
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <a href="<?php echo URL::to('/myTeams')?>">
                <div class="col-md-12 text-center">
                    <div class="alert alert-info">
                        Lege zuerst Teams an
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endif
<div class="row">
    <div class="col-md-3">
        <div class="panel panel-success"  id="landingScreen">
            <div class="panel-heading">
                <h2 class="text-center">
                    User: {!! $user->username !!}
                </h2>
            </div>
            <div class="panel-body">
                <br>
                <div class="table-responsive">
                    <table class="table table-hover" >
                        <thead>
                            <tr>
                                <td>
                                    Spiele:
                                </td>
                                <td>
                                    {!! $user->statistic->totalgames !!}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Siege:
                                </td>
                                <td>
                                    {!! $user->statistic->wins !!}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Niederlagen:
                                </td>
                                <td>
                                    {!! $user->statistic->loses !!}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Unentschieden:
                                </td>
                                <td>
                                    {!! $user->statistic->draws !!}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Tore:
                                </td>
                                <td>
                                    {!! $user->statistic->goals !!}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Gegentore:
                                </td>
                                <td>
                                    {!! $user->statistic->owngoals !!}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Differenz:
                                </td>
                                <td>
                                    {!! $user->statistic->goals-$user->statistic->owngoals !!}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Anzahl Teams:
                                </td>
                                <td>
                                    {!! $user->teams->count() !!}
                                </td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        <div class="panel panel-success goto">
            <div class="panel-heading">
                <h2 class="text-center">
                    Meine Teams
                </h2>
            </div>
            <div class="panel-body">
                <a href="<?php echo URL::to('/myTeams')?>">
                    <div class="text-center">
                        <span class="fa fa-users fa-5x" aria-hidden="true"></span>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="panel panel-success"  id="landingScreen">
            <div class="panel-heading">
                <h2 class="text-center">
                    Laufende Turniere (von {!! $user->username !!})
                </h2>
            </div>
            <div class="panel-body">
                <br>
                    <div class="table-responsive">
                        <table class="table table-hover" >
                            <thead>
                                <th>
                                    Name des Turniers
                                </th>
                                <th>
                                    Modus
                                </th>
                                <th>
                                    Anzahl der Teilnehmer
                                </th>
                                <th>
                                    Anzahl der Teams pro user
                                </th>
                                <th>
                                    Gruppen Anzahl
                                </th>
                                <th>
                                    Besitzer
                                </th>
                            </thead>
                            <tbody>
                            @foreach($user->tournaments->where('status','!=',3)->sortByDesc('id') as $tour)
                                <tr>
                                    <td>
                                        {!! $tour->name !!}
                                    </td>
                                    <td>
                                        {!! $tour->modus->name !!}
                                    </td>
                                    <td>
                                        {!! $tour->countUser !!}
                                    </td>
                                    <td>
                                        {!! $tour->countTeamsForUser !!}
                                    </td>
                                    <td>
                                        {!! $tour->countGroups !!}
                                    </td>
                                    <td>
                                        {!! \App\User::find($tour->owner)->username !!}
                                    </td>
                                    <td>
                                        {!! Form::open(array('url' => '/editTournament')) !!}
                                        {!! Form::hidden('tour_id', $tour->id) !!}
                                        {!! Form::button('<i class="fa fa-pencil-square"></i>', ['type' => 'submit', 'class' => 'btn btn-success btn-md center-block', 'style' => '', 'id' => ''] ) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>


        <div class="panel panel-success goto">
            <div class="panel-heading">
                <h2 class="text-center">
                    Neues Turnier
                </h2>
            </div>
            <div class="panel-body">
                @if(Auth::user()->friends->count()==0)
                    <p>
                        Du brauchst erst Freunde, um ein Turnier zu erstellen.<br>
                        Füge Freunde mit Hilfe eines Freundeschlüssel hinzu.<br>
                        Deinen eigenen Freundesschlüssel findest in den Profil-Einstellungen in der Navigation.
                    </p>
                    @else
                <a href="<?php echo URL::to('/createTournament')?>">
                <div class="text-center">
                    <span class="fa fa-plus fa-5x" aria-hidden="true"></span>
                </div>
                    </a>
                @endif
            </div>
        </div>

    </div>
    <div class="col-md-4">
        <div class="panel panel-success"  id="landingScreen">
            <div class="panel-heading">
                <h2 class="text-center">
                    Meine Freunde
                </h2>
            </div>
            <div class="panel-body">
                {!! Html::ul($errors->all(), array('class'=>'alert alert-danger errors')) !!}
                {!! Form::open(array('url' => 'searchFriends','class'=>'form')) !!}
                <br>
                {!! Form::label('freundesschluessel', 'Freundesschlüssel zum Eintragen und Bearbeiten in Turnieren') !!}
                {!! Form::text('freundesschluessel', null, array('class' => 'form-control','placeholder'=>'Gib hier den Freundeschlüssel ein')) !!}
                <br>
                {!! Form::submit('suchen' , array('class' => 'btn btn-success btn-lg')) !!}
                {!! Form::close() !!}
                <hr>
                <div class="table-responsive">
                    <table class="table table-hover" >
                        <tbody>
                        @foreach($user->friends as $friend)
                            <tr>
                                <td>
                                    {!! $friend->username !!}
                                </td>
                                <td>
                                    {!! Form::open(array('url' => '/deleteFriend')) !!}
                                    {!! Form::hidden('friend_id', $friend->id) !!}
                                    {!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs center-block', 'style' => '', 'id' => ''] ) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="panel panel-success"  id="landingScreen">
            <div class="panel-heading">
                <h2 class="text-center">
                    Vergangene Turniere
                </h2>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover" >
                        <thead>
                            <th>
                                Name des Turniers
                            </th>
                            <th>
                                Anzahl der Teilnehmer
                            </th>
                            <th>
                                Gewinner
                            </th>
                            <th>
                                Sieger-Team
                            </th>
                        </thead>
                        <tbody>
                        @foreach($user->tournaments->where('status',3)->sortByDesc('created_at') as $tour)
                        <tr>
                            <td>
                                {!! $tour->name !!}
                            </td>
                            <td>
                                {!! $tour->countUser !!}
                            </td>
                            <td>
                                {!! \App\Team::find($tour->winner)->user->username !!}
                            </td>
                            <td>
                                {!! \App\Team::find($tour->winner)->name !!}
                            </td>
                            <td>
                                {!! Form::open(array('url' => '/editTournament')) !!}
                                {!! Form::hidden('tour_id', $tour->id) !!}
                                {!! Form::button('<i class="fa fa-eye"></i>', ['type' => 'submit', 'class' => 'btn btn-success btn-md center-block', 'style' => '', 'id' => ''] ) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>
</div>
