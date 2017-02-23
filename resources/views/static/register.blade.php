@extends('app')

@section('content')
    @if (Session::has('msg'))
        <div class="alert alert-info">{{ Session::get('msg') }}</div>
    @endif

    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h1>Registrierung</h1>
                </div>
                <div class="panel-body">
                    {!! Html::ul($errors->all(), array('class'=>'alert alert-danger errors')) !!}
                    {!! Form::open(array('url' => 'register','class'=>'form')) !!}
                    <br>
                    {!! Form::label('username', 'Username') !!}
                    {!! Form::text('username', null, array('class' => 'form-control','placeholder' => 'Benutzername')) !!}
                    <br>
                    {!! Form::label('email', 'E-Mail-Adresse') !!}
                    {!! Form::text('email', null, array('class' => 'form-control','placeholder' => 'email@email.com')) !!}
                    <br>
                    {!! Form::label('password', 'Passwort') !!}
                    {!! Form::password('password', array('class' => 'form-control')) !!}
                    <br>
                    {!! Form::label('password_confirmation','Passwort bestätigen',['class'=>'control-label']) !!}
                    {!! Form::password('password_confirmation',['class'=>'form-control']) !!}
                    <br>
                    {!! app('captcha')->display() !!}
                    <div class="g-recaptcha" data-sitekey="6LcN2RMUAAAAADlkBrS_xmKPhqzU8VsIzCADv1QG"></div>
                    {!! Form::submit('Registrieren' , array('class' => 'btn btn-success btn-lg')) !!}
                    {!! Form::close() !!}
                    <br>
                </div>
            </div>
        </div>
        <div class="col-md-3">
        </div>
    </div>
@endsection