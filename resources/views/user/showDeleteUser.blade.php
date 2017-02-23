@extends('app')

@section('title') Ameland
@stop

@section('content')

    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
        <div class="panel panel-success">
            <div class="panel-heading"><h3> Account löschen</h3></div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover" >
                        <thead>
                        <tr>
                            <td>
                                <p>
                                    Wenn Sie Ihren Account unwiderruflich löschen, kann dieser nicht wiederhergestellt werden.
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>

                                {!! Form::open(array('url' => '/deleteUser')) !!}
                                {!! Form::button('<i class="fa fa-trash-o"></i> Account unwiderruflich löschen', ['type' => 'submit', 'class' => 'btn btn-danger pull-left', 'style' => '', 'id' => ''] ) !!}
                                {!! Form::close() !!}

                                {!! Form::open(array('url' => '/settings')) !!}
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