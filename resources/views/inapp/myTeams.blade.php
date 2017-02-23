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
            <div class="col-md-1">
            </div>
            <div class="col-md-10">
                <div class="panel panel-success"  id="landingScreen">
                    <div class="panel-heading">
                        <h2 class="text-center">
                            {!! Form::open(array('url' => '/')) !!}
                            {!! Form::button('<i class="fa fa-arrow-left"></i>', ['type' => 'submit', 'class' => 'btn btn-danger pull-left', 'style' => '', 'id' => ''] ) !!}
                            {!! Form::close() !!}
                            Meine Teams
                        </h2>
                    </div>
                    <div class="panel-body">

                {!! Html::ul($errors->all(), array('class'=>'alert alert-danger errors')) !!}
                <div class="table-responsive registertable">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Team-Name</th>
                            <th>Turniersiege</th>
                            <th>Spiele</th>
                            <th>Siege</th>
                            <th>Niederlagen</th>
                            <th>Unendschieden</th>
                            <th>Tore</th>
                            <th>Gegentore</th>
                            <th>Differenz</th>
                            <th>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=0 ?>
                        @foreach($user->teams as $team)
                            <tr>
                                <td>
                                    {!! $team->name !!}
                                </td>
                                <td>
                                    {!! \App\Tournament::where('winner',$team->id)->count() !!}
                                </td>
                                <td>
                                    {!! $team->statistic->totalgames !!}
                                </td>
                                <td>
                                    {!! $team->statistic->wins !!}
                                </td>
                                <td>
                                    {!! $team->statistic->loses !!}
                                </td>
                                <td>
                                    {!! $team->statistic->draws !!}
                                </td>
                                <td>
                                    {!! $team->statistic->goals !!}
                                </td>
                                <td>
                                    {!! $team->statistic->owngoals !!}
                                </td>
                                <td>
                                    {!! $team->statistic->goals-$team->statistic->owngoals !!}
                                </td>
                            </tr>
                            @endforeach
                        <tr>
                            {!! Form::open(array('url' => '/addTeam')) !!}
                            <td>
                                {!! Form::text('name', null, array('class' => 'form-control','placeholder'=>'neues Team')) !!}
                            </td>
                            <td>
                                0
                            </td>
                            <td>
                                0
                            </td>
                            <td>
                                0
                            </td>
                            <td>
                                0
                            </td>
                            <td>
                                0
                            </td>
                            <td>
                                0
                            </td>
                            <td>
                                0
                            </td>
                            <td>
                                0
                            </td>
                            <td>
                                {!! Form::button('<i class="fa fa-pencil-square"></i> hinzufügen', ['type' => 'submit', 'class' => 'btn btn-success btn-md center-block', 'style' => '', 'id' => ''] ) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>

                        </tbody>
                    </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-1">
            </div>
    </div>

@endsection