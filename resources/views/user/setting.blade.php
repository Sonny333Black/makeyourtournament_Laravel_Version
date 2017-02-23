@extends('app')

@section('content')

<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<div class="panel panel-success">
			<div class="panel-heading">
				<h3 class="text-center">
					{!! Form::open(array('url' => '/')) !!}
					{!! Form::button('<i class="fa fa-arrow-left"></i>', ['type' => 'submit', 'class' => 'btn btn-danger pull-left', 'style' => '', 'id' => ''] ) !!}
					{!! Form::close() !!}
					Angemeldet als {{Auth::user()->username}} - Status:
				</h3>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-hover" >
						<thead>
						<tr>
							<td>
								{!! Html::ul($errors->all(), array('class'=>'alert alert-danger errors')) !!}
								{!! Form::open(array('url' => 'userUpdate','class'=>'form')) !!}
								<br>
								{!! Form::label('username', 'Username') !!}
								{!! Form::text('username', $user->username, array('class' => 'form-control')) !!}
								<br>
								{!! Form::label('email', 'E-Mail-Adresse') !!}
								{!! Form::text('email', $user->email, array('class' => 'form-control')) !!}
								<br>
								{!! Form::label('friend_key', 'Freundesschlüssel: ') !!}
								{!! $user->friend_key !!}
								<br>
								{!! Form::submit('Updaten', array('class' => 'btn btn-primary pull-left')) !!}
								{!! Form::close() !!}
								<br>
								{!! Form::open(array('url' => '/passwordChange')) !!}
								{!! Form::button('<i class="fa fa-pencil"></i> Passwort ändern', ['type' => 'submit', 'class' => 'btn btn-warning pull-right', 'style' => '', 'id' => ''] ) !!}
								{!! Form::close() !!}
							</td>
						</tr>
						</thead>
					</table>
					<hr>
					{!! Form::open(array('url' => 'showDeleteUser')) !!}
					{!! Form::button('<i class="fa fa-trash-o"></i> Account löschen', ['type' => 'submit', 'class' => 'btn btn-danger center-block', 'style' => '', 'id' => ''] ) !!}
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3"></div>
</div>

@stop
