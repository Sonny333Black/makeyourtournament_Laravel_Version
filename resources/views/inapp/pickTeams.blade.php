@extends('app')

@section('content')
    @if (Session::has('msg'))
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="alert alert-info">{{ Session::get('msg') }}</div>
            </div>
        </div>
    @endif
@if($tour->owner == Auth::id())
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h2 class="text-center">
                        {!! Form::open(array('url' => '/')) !!}
                        {!! Form::button('<i class="fa fa-arrow-left"></i>', ['type' => 'submit', 'class' => 'btn btn-danger pull-left', 'style' => '', 'id' => ''] ) !!}
                        {!! Form::close() !!}
                        Users und Teams eingeben
                    </h2>
                </div>
                <div class="panel-body">

                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div id="info-flash" class="alert alert-success">Tragen Sie bitte ihre Freunde und Teams ein</div>
                        </div>
                    </div>

                    {!! Html::ul($errors->all(), array('class'=>'alert alert-danger errors')) !!}
                    {!! Form::open(array('url' => 'pickTeams','class'=>'form')) !!}
                    <input type="hidden" id="countTeamsPerUser" value="{!! $tour->countTeamsForUser !!}">
                    @for ($i = 0; $i < $tour->countUser; $i++)

                        <div class="col-md-3">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h3 class="text-center userFields">
                                        {!! Form::select($i.'user', $friends, null,array('class' => 'form-control','id'=>$i.'user')) !!}
                                    </h3>
                                </div>
                                <div class="panel-body">
                                    <p id="{!! $i."teamField" !!}">
                                        Erst den User oben auswählen.
                                    </p>
                                </div>
                            </div>
                        </div>

                    @endfor
                    {!! Form::hidden('tour_id', $tour->id) !!}
                    {!! Form::submit('Teams festlegen' , array('class' => 'btn btn-success btn-lg center-block','style'=>'display:none', 'id'=>'pickTeams')) !!}
                    {!! Form::close() !!}
                    <button id="checkButton" class="btn btn-success btn-lg center-block">
                        check
                    </button>

                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
@endif
@endsection
{!! Html::script('/js/pickTeams.js') !!}