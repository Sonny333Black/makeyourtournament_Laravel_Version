@extends('app')

@section('content')
    @if (Session::has('msg'))
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="alert alert-info">{{ Session::get('msg') }}</div>
            </div>
        </div>
    @endif
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
                        Bearbeite Turnier - {!! $tour->name !!}
                    </h3>
                </div>
                <div class="panel-body">
                        <div class="row">
                                <div class="col-md-4">

                                </div>
                            <div class="col-md-4">
                                {!! Form::open(array('url' => 'newKOPick')) !!}
                                {!! Form::hidden('tour_id', $tour->id) !!}
                                {!! Form::button('Neu Auslosen', ['type' => 'submit', 'class' => 'btn btn-success center', 'style' => '', 'id' => ''] ) !!}
                                {!! Form::close() !!}
                            </div>

                            <div class="col-md-4">
                                {!! Form::open(array('url' => 'startKOTournament')) !!}
                                {!! Form::hidden('tour_id', $tour->id) !!}
                                {!! Form::button('<i class="fa fa-play"></i> Turnier starten', ['type' => 'submit', 'class' => 'btn btn-success center btn-lg', 'style' => '', 'id' => ''] ) !!}
                                {!! Form::close() !!}

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
@endsection