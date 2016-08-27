@extends('layouts.app')
@section('content')
<div class="jumbotron">
    <div class="container">
    	<a class="btn btn-danger btn-lg pull-right" href="/discussions/create" role="button"><i class="fa fa-paper-plane" aria-hidden="true"></i> 发布新帖</a>
        <h2>欢迎来到精品blog分享区</h2> 
    </div>
</div>
<div class="container">
	<div class="col-md-9" rol="main">
		@foreach($discussions as $discussion)
			<div class="media">
				<div class="media-left">
					<a class="pull-left" href="#">
						<img width="60px" class="media-object img-circle" src="{{$discussion->user->avatar}}" /> 
					</a>
				</div>
				<div class="media-body">
					<h4 class="media-heading"><a href="discussions/{{$discussion->id}}">{{$discussion->title}}</a></h4>
					{{$discussion->user->name}}
					@if (count($discussion->comment)>0)
					<span class="text text-danger">共有{{count($discussion->comment)}}条评论</span>
					@endif
				</div>	
			</div>
		@endforeach
		<!-- $discussions->render()  -->
	</div>
</div>
@stop