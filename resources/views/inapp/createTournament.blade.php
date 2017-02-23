@extends('app')

@section('content')
    @if (Session::has('msg'))
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="alert alert-info">{{ Session::get('msg') }}</div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            {!! Html::ul($errors->all(), array('class'=>'alert alert-danger errors col-md-12')) !!}
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h2 class="text-center">
                        {!! Form::open(array('url' => '/')) !!}
                        {!! Form::button('<i class="fa fa-arrow-left"></i>', ['type' => 'submit', 'class' => 'btn btn-danger pull-left', 'style' => '', 'id' => ''] ) !!}
                        {!! Form::close() !!}
                        neues Turnier erstellen
                    </h2>
                </div>
                <div class="panel-body">
                    <div class="container">
                        {!! Form::open(array('url' => 'createTournament','class'=>'form-horizontal')) !!}
                        <div class="form-group">
                            {!! Form::label('turniername', 'Turnier Name',['class'=>'control-label col-sm-2']) !!}
                            <div class="col-sm-6">
                                {!! Form::text('turniername', null, array('class' => 'form-control','placeholder' => 'Turniername')) !!}
                            </div>
                        </div>
                        <div class="form-group" id="showModus">
                            <?php
                            $mod = array();
                            $i=1;
                            foreach ($modus as $temp){
                                $mod[$i] = $temp->name;
                                $i++;
                            }
                            ?>

                            {!! Form::label('modus', 'Modus',['class'=>'control-label col-sm-2']) !!}
                            <div class="col-sm-6">
                                {!! Form::select('modus', $mod,['class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group" id="showAnzahlGruppen" >
                            {!! Form::label('anzahlGruppen', 'Anzahl der Gruppen',['class'=>'control-label col-sm-2']) !!}
                            <div class="col-sm-6">
                                {!! Form::select('anzahlGruppen', array('2' => '2', '4' => '4', '8'=>'8')) !!}
                            </div>
                        </div>
                        <div class="form-group" id="showAnzahlSpieler" >
                            {!! Form::label('anzahlSpieler','Anzahl Spieler',['class'=>'control-label col-sm-2']) !!}
                            <div class="col-sm-6" id="showAnzahlSpielerField">

                            </div>
                        </div>
                        <div class="form-group" id="showTeamsProSpieler">
                            {!! Form::label('teamsProSpieler','Manschaften pro Spieler',['class'=>'control-label col-sm-2','min'=>2,'max'=>32]) !!}
                            <div class="col-sm-6" id="showTeamsProSpielerField">

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-8">
                                {!! Form::submit('erstellen' , array('class' => 'btn btn-success btn-lg center-block')) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>

@endsection
{!! Html::script('/js/createTournament.js') !!}