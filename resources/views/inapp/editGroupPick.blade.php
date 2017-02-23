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
        @if($tour->owner == Auth::id())
        <div class="col-md-8">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h2 class="text-center">
                        {!! Form::open(array('url' => '/')) !!}
                        {!! Form::button('<i class="fa fa-arrow-left"></i>', ['type' => 'submit', 'class' => 'btn btn-danger pull-left', 'style' => '', 'id' => ''] ) !!}
                        {!! Form::close() !!}
                        Gruppen Auslosung
                    </h2>
                </div>
                <div class="panel-body">
                    <input type="hidden" id="countTeamsPerUser" value="{!! $tour->countUser !!}">
                    @for ($i = 0; $i < $tour->countGroups; $i++)

                        <div class="col-md-3">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h3 class="text-center">
                                        Gruppe {!! $i+1 !!}
                                    </h3>
                                </div>
                                <div class="panel-body">
                                    <?php $count = 0 ?>
                                    @foreach($tour->groupCards as $card)
                                        @if($card->groupNumber === $i+1)
                                                <?php $count++ ?>
                                            <h4>
                                                {!! $count. ". " .$card->team->name.' ('.$card->team->user->username.')'!!}
                                            </h4>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endfor
                    {!! Html::ul($errors->all(), array('class'=>'alert alert-danger errors')) !!}
                    {!! Form::open(array('url' => 'mixTeamsToGroupNew','class'=>'form')) !!}
                    {!! Form::hidden('tour_id', $tour->id) !!}
                    {!! Form::submit('Zufällig' , array('class' => 'btn btn-success btn-lg center-block','style'=>'display:block')) !!}
                    {!! Form::close() !!}
                    <br>
                    {!! Form::open(array('url' => '/startTournament')) !!}
                    {!! Form::hidden('tour_id', $tour->id) !!}
                    {!! Form::submit('Turnierplan erstellen' , array('class' => 'btn btn-success btn-lg center-block','style'=>'display:block')) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        @endif
        <div class="col-md-2"></div>
    </div>

@endsection
{!! Html::script('/js/pickTeams.js') !!}