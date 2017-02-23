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
        @if (Auth::guest())
            <div class="col-md-3">
                @include('static/loginlayout')
            </div>
            <div class="col-md-6">
                @include('static/landing')
            </div>
            <div class="col-md-3">
                @include('static/goto/register')
            @else
            <div class="col-md-12">
                @include('inapp/landing');
            </div>
        @endif
    </div>
@endsection