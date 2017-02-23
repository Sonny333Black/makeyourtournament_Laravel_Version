@extends('app')

@section('content')
    @if (Session::has('msg'))
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="alert alert-info">{{ Session::get('msg') }}</div>
            </div>
        </div>
    @endif


    @if($tour->status == 1)
        @include('inapp/tournamentViews/tournamentGroup')
    @endif

    @if($tour->status == 2)
        @include('inapp/tournamentViews/tournamentKO')
    @endif

    @if($tour->status == 3)
        @if($tour->modus_id == 3)
            @include('inapp/tournamentViews/tournamentKO')
        @endif
        @if($tour->modus_id == 1 || $tour->modus_id == 2)
            @include('inapp/tournamentViews/tournamentGroup')
        @endif

    @endif




@endsection