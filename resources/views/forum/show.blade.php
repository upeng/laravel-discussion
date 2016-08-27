@extends('layouts.app')
@section('content')

<div class="jumbotron">
    <div class="container">
        <div class="media">
        	@if (Auth::check() && (Auth::user()->id == $discussion->user->id))
        	<a class="btn btn-danger btn-lg pull-right" href="/discussions/{{$discussion->id}}/edit" role="button">修改帖子</a>
        	@endif
			<div class="media-left">
				<a class="pull-left" href="#">
					<img width="60px" class="media-object img-circle" src="{{$discussion->user->avatar}}" /> 
				</a>
			</div>
			<div class="media-body">
				<h4 class="media-heading">{!!$discussion->title!!}</h4>
				{{$discussion->user->name}}
			</div>	
		</div>		
    </div>
</div>
@if(Session::has('flash_message'))
    <div class="alert alert-success {{ Session::has('flash_message_important') ? 'alert-important' : '' }}">
        @if(Session::has('flash_message_important'))
            <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&times;</button>
        @endif
        {{ session('flash_message') }}
    </div>
@endif
<div class="container">
	<div class="col-md-9" rol="main">
		<div class="blog-post">
            <h2 class="blog-post-title">{!!$discussion->title!!}</h2>
            <p class="blog-post-meta">{{$discussion->created_at}} &nbsp {{$discussion->user->name}}</p>
            <p>{!!$discussion->body!!}</p>
			
			@if (count($discussion->comment)>1)
			<strong>评论列表</strong>
			@endif

			@foreach($discussion->comment as $comment)
			<div class="comment-list">
                <div class="comment-content avatar">
                    <img src="{{$comment->user->avatar}}" alt="" class="img-circle" width="64px">
                </div>
                <div class="comment-content">
                    <p>
                        <strong>{{$comment->user->name}}</strong>  at
                        <span class="text comment-time">{{$comment->created_at}}</span>
                    </p>
                    <p>{{$comment->content}}</p>
                </div>				
			</div>
			@endforeach
            
          </div>
	</div>
</div>

<div class="container">
	<div class="container col-md-9">
        @if (Auth::check())
        <form action="/comments" method="post">
            <div class="form-group">
                <textarea name="content" class="form-control"  rows="4"></textarea>
            </div>

            @if($errors->has('content'))
             <span class="text text-danger">
             	{{$errors->first('content')}}
             </span>
            @endif
            
            {{ csrf_field() }}
            
            <input type="hidden" name="discussion_id" value="{{$discussion->id}}">
            <div class="form-group">
                <button class="btn btn-success pull-right">发表评论</button>
            </div>
        </form>
        @else
        <a href="/login" class="btn btn-success btn-block">登录参与评论</a>
        @endif
    </div>
</div>
@stop
