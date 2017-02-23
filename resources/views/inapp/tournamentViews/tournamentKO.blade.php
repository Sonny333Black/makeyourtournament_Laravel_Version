@if($tour->owner == Auth::id() && $tour->status != 3)
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="text-center">
                        {!! Form::open(array('url' => '/')) !!}
                        {!! Form::button('<i class="fa fa-arrow-left"></i>', ['type' => 'submit', 'class' => 'btn btn-danger pull-left', 'style' => '', 'id' => ''] ) !!}
                        {!! Form::close() !!}
                        Turnier Übersicht KO-Phase - {!! $tour->name !!}
                    </h3>
                </div>
                <div class="panel-body">
                    @if($tour->status !=3)
                            <div class="row">
                        @if($tour->winner!=0)
                            <div class="col-md-8 text-center">
                                <h3 style="color: black">
                                <?php
                                    echo 'Sieger : '. \App\Team::find($tour->winner)->name;
                                ?>
                                </h3>
                                </div>
                            @else
                            <div class="col-md-4">
                                Gespielte Spiele: {!! count($tour->matchings->where('goalA','!=', -1)->where('round_id','>',1)) !!}
                            </div>
                            <div class="col-md-4">
                                noch zu spielende Spiele: {!! count($tour->matchings->where('goalA','=', -1)->where('round_id','>',1)) !!}
                            </div>
                        @endif
                        <div class="col-md-4">
                            @if(count($tour->matchings->where('goalA','!=', -1))==count($tour->matchings))
                                @if($tour->modus->id = 1)
                                    {!! Form::open(array('url' => 'tournamentKOFinished')) !!}
                                    {!! Form::hidden('tour_id', $tour->id) !!}
                                    {!! Form::button('<i class="fa fa-trophy"></i> Turnier Beenden', ['type' => 'submit', 'class' => 'btn btn-success center', 'style' => '', 'id' => ''] ) !!}
                                    {!! Form::close() !!}
                                @endif
                            @endif
                        </div>
                    </div>
                        @else
                        <div class="row">
                            <div class="col-md-12 text-center">
                                    <h3 style="color: black">
                                        <?php
                                        echo 'Sieger : '. \App\Team::find($tour->winner)->name;
                                        ?>
                                    </h3>
                                </div>
                            </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
@endif
@if($tour->status == 3 && $tour->modus_id == 3)
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="text-center">
                        {!! Form::open(array('url' => '/')) !!}
                        {!! Form::button('<i class="fa fa-arrow-left"></i>', ['type' => 'submit', 'class' => 'btn btn-danger pull-left', 'style' => '', 'id' => ''] ) !!}
                        {!! Form::close() !!}
                        Turnier Übersicht - {!! $tour->name !!}
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-1">
                        </div>
                        <div class="col-md-10 text-center">
                            <h3 style="color: black">
                                <?php
                                $team= \App\Team::find($tour->winner);
                                echo 'Gewinner: ' . $team->user->username . '<br> Team: '.$team->name;
                                ?>
                            </h3>
                        </div>
                        <div class="col-md-1">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
@endif
<?php

    $gamesInKO = count($tour->matchings->where('round_id','>',1));
    $countKOPanels=0;
    if($gamesInKO==15){
        $countKOPanels = 4;
    }
    if($gamesInKO==7){
        $countKOPanels = 3;
    }
    if($gamesInKO==3){
        $countKOPanels = 2;
    }
    if($gamesInKO==1){
        $countKOPanels = 1;
    }


?>
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        @for($i = 0; $i < $countKOPanels;$i++)
            <div class="col-md-6">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="text-center">
                            <?php
                            if($i == 0){
                                if($gamesInKO==15){
                                    echo 'Paarungen für Achtelfinale';
                                }
                                if($gamesInKO==7){
                                    echo 'Paarungen für Viertelfinale';
                                }
                                if($gamesInKO==3){
                                    echo 'Paarungen für Halbfinale';
                                }
                                if($gamesInKO==1){
                                    echo 'Paarungen für Finale';
                                }
                            }
                            if($i == 1){
                                if($gamesInKO==15){
                                    echo 'Paarungen für Viertelfinale';
                                }
                                if($gamesInKO==7){
                                    echo 'Paarungen für Halbfinale';
                                }
                                if($gamesInKO==3){
                                    echo 'Paarungen für Finale';
                                }
                            }
                            if($i == 2){
                                if($gamesInKO==15){
                                    echo 'Paarungen für Halbfinale';
                                }
                                if($gamesInKO==7){
                                    echo 'Paarungen für Finale';
                                }
                            }
                            if($i == 3){
                                if($gamesInKO==15){
                                    echo 'Paarungen für Finale';
                                }
                            }
                            ?>
                        </h3>
                    </div>
                    <div class="panel-body">

                        <div class="table-responsive">
                            <table class="table table-hover" >
                                <thead>
                                <th>
                                    Heim
                                </th>
                                <th>

                                </th>
                                <th>

                                </th>
                                <th>

                                </th>
                                <th>
                                    Auswärts
                                </th>
                                </thead>
                                @if($i == 0)
                                    @if($gamesInKO==15)
                                        @foreach($tour->matchings->where('round_id','=',2) as $match)
                                            @include('inapp/tournamentViews/showMatchesKO')
                                        @endforeach
                                    @endif
                                    @if($gamesInKO==7)
                                        @foreach($tour->matchings->where('round_id','=',3) as $match)
                                            @include('inapp/tournamentViews/showMatchesKO')
                                        @endforeach
                                    @endif
                                    @if($gamesInKO==3)
                                        @foreach($tour->matchings->where('round_id','=',4) as $match)
                                            @include('inapp/tournamentViews/showMatchesKO')
                                        @endforeach
                                    @endif
                                    @if($gamesInKO==1)
                                        @foreach($tour->matchings->where('round_id','=',5) as $match)
                                            @include('inapp/tournamentViews/showMatchesKO')
                                        @endforeach
                                    @endif
                                @endif
                                @if($i == 1)
                                    @if($gamesInKO==15)
                                        @foreach($tour->matchings->where('round_id','=',3) as $match)
                                            @include('inapp/tournamentViews/showMatchesKO')
                                        @endforeach
                                    @endif
                                    @if($gamesInKO==7)
                                        @foreach($tour->matchings->where('round_id','=',4) as $match)
                                            @include('inapp/tournamentViews/showMatchesKO')
                                        @endforeach
                                    @endif
                                    @if($gamesInKO==3)
                                        @foreach($tour->matchings->where('round_id','=',5) as $match)
                                            @include('inapp/tournamentViews/showMatchesKO')
                                        @endforeach
                                    @endif
                                @endif
                                @if($i == 2)
                                    @if($gamesInKO==15)
                                        @foreach($tour->matchings->where('round_id','=',4) as $match)
                                            @include('inapp/tournamentViews/showMatchesKO')
                                        @endforeach
                                    @endif
                                    @if($gamesInKO==7)
                                        @foreach($tour->matchings->where('round_id','=',5) as $match)
                                            @include('inapp/tournamentViews/showMatchesKO')
                                        @endforeach
                                    @endif
                                @endif
                                @if($i == 3)
                                    @if($gamesInKO==15)
                                        @foreach($tour->matchings->where('round_id','=',5) as $match)
                                            @include('inapp/tournamentViews/showMatchesKO')
                                        @endforeach
                                    @endif
                                @endif

                            </table>
                        </div>
                    </div>
                </div>

            </div>
    @endfor
    </div>

    <div class="col-md-1"></div>
</div>