@extends('app')

@section('title') Ameland
@stop

@section('content')

    <div class="row">
        <div class="col-md-3"></div>
<div class="col-md-6">
    <div class="panel panel-success">
        <div class="panel-heading"><h3> Passwort ändern</h3></div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-hover" >
                    <thead>
                    <tr>
                        <td>
                            {!! Html::ul($errors->all(), array('class'=>'alert alert-danger errors')) !!}
                            {!! Form::open(array('url' => 'pwChangeConfirm','class'=>'form')) !!}
                            <br>
                            <h1>
                            <span class="label label-default">
                                {{Auth::user()->username}}
                            </span>
                            </h1>
                            <br>
                            {!! Form::label('oldPassword', 'Altes Passwort') !!}
                            {!! Form::password('oldPassword', array('class' => 'form-control')) !!}
                            <br>
                            {!! Form::label('password', 'Neues Passwort') !!}
                            {!! Form::password('password', array('class' => 'form-control')) !!}
                            <br>
                            {!! Form::label('password_confirmation','Neues Passwort bestätigen',['class'=>'control-label']) !!}
                            {!! Form::password('password_confirmation',['class'=>'form-control']) !!}
                            <br>
                            <br>
                            {!! Form::submit('Ändern', array('class' => 'btn btn-primary pull-left')) !!}
                            {!! Form::close() !!}

                            {!! Form::open(array('url' => 'settings')) !!}
                            {!! Form::button(' Abbrechen', ['type' => 'submit', 'class' => 'btn btn-warning pull-right', 'style' => '', 'id' => ''] ) !!}
                            {!! Form::close() !!}

                        </td>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
        <div class="col-md-3"></div>
    </div>
@stop