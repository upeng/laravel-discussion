@extends('layouts.app')
@section('content')
    @include('editor::head')
    <div class="container col-md-6 col-md-offset-3">
        <img src="{{Auth::user()->avatar}}" class="img-circle" width="100" alt="">
        
    </div>
@stop