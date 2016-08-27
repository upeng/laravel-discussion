@extends('layouts.app')
@section('content')
    @include('editor::head')
    <div class="container col-md-6 col-md-offset-3">
        <form action="/discussions" method="post">
        {{ csrf_field() }}
            <div class="form-group">
                <label for="title">标题</label>
                <input type="text" name="title" class="form-control" >
                @if ($errors->has('title'))
                {{$errors->first('title')}}
                @endif
            </div>
            <div class="form-group">
                <div class="editor">
                    <textarea name="body" class="form-control" id="myEditor"></textarea>
                    @if ($errors->has('body'))
                    {{$errors->first('body')}}
                    @endif
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-primary form-control">发布</button>
            </div>
        </form>
    </div>
@stop