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
                        Turnier Übersicht Gruppenphase - {!! $tour->name !!}
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            Gespielte Spiele: {!! count($tour->matchings->where('goalA','!=', -1)) !!}
                        </div>
                        <div class="col-md-4">
                            noch zu spielende Spiele: {!! count($tour->matchings->where('goalA','=', -1)) !!}
                        </div>
                        <div class="col-md-4">
                            @if(count($tour->matchings->where('goalA','!=', -1))==count($tour->matchings))
                                @if($tour->modus->id == 1)
                                    {!! Form::open(array('url' => 'fromGroupToKO')) !!}
                                    {!! Form::hidden('tour_id', $tour->id) !!}
                                    {!! Form::button('<i class="fa fa-trophy"></i> Zur Endrunde', ['type' => 'submit', 'class' => 'btn btn-success center', 'style' => '', 'id' => ''] ) !!}
                                    {!! Form::close() !!}
                                @endif
                                @if($tour->modus->id == 2)
                                    {!! Form::open(array('url' => 'endGroup')) !!}
                                    {!! Form::hidden('tour_id', $tour->id) !!}
                                    {!! Form::button('<i class="fa fa-trophy"></i> Liga Beenden und Sieger ermittlen', ['type' => 'submit', 'class' => 'btn btn-success center', 'style' => '', 'id' => ''] ) !!}
                                    {!! Form::close() !!}
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
@endif
@if($tour->status == 3)
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
@if($tour->modus_id == 1)
        @include('inapp/tournamentViews/moreThanOneGroup')
    @else
        @include('inapp/tournamentViews/oneGroup')
@endif

