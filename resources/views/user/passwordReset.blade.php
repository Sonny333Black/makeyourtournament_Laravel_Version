@extends('app')

@section('content')

    <div class="row">
        <div class="col-md-3">

        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default" id="landingScreen">
                        <div class="panel-body">
                                {!! Html::ul($errors->all(), array('class'=>'alert alert-danger errors')) !!}
                                {!! Form::open(array('url' => '/user/resetPasswordAction')) !!}
                                {!! Form::label('email', 'Geben Sie hier Ihre E-Mail-Adresse ein:') !!}
                                {!! Form::email('email', null, array('class' => 'form-control','placeholder' => 'E-Mail')) !!}
                                <br>
                                {!! Form::button('<i class="fa fa-envelope"></i> Passwort Zurücksetzen', ['type' => 'submit', 'class' => 'btn btn-success center-block', 'style' => '', 'id' => ''] ) !!}
                                {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">

        </div>
    </div>

@endsection