
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-success" id="loginMaske">
            <div class="panel-heading">
                <h2>
                    Sind Sie schon eingeloggt?
                </h2>
            </div>
            <div class="panel-body">
                {!! Html::ul($errors->all(), array('class'=>'alert alert-danger errors')) !!}
                {!! Form::open(array('url' => 'login','class'=>'form')) !!}
                <br>
                {!! Form::label('username', 'E-Mail-Adresse oder Benutzername') !!}
                {!! Form::text('username', null, array('class' => 'form-control','placeholder' => 'E-Mail oder Benutzername')) !!}
                <br>
                {!! Form::label('password', 'Passwort') !!}
                {!! Form::password('password', array('class' => 'form-control')) !!}
                <br>
                {!! Form::submit('Login' , array('class' => 'btn btn-success')) !!}
                {!! Form::close() !!}

                <div class="alert alert-success" role="alert" style="font-size: 0.8em; margin-top: 2%; ">
                    Passwort vergessen? <a href="<?php echo URL::to('/user/passwordReset')?>" class="alert-link"><br>Hier können Sie es zurücksetzen.</a>
                </div>


            </div>
        </div>
    </div>
</div>