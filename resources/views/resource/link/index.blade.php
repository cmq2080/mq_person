@extends('resource.base')

@section('title', '链接')

@section('style')
@endsection

@section('script')
@endsection

@section('banner')
<div class="jumbotron">
	<h1>链接</h1>
	<h3><small>他山之石，可以攻玉</small></h3>
</div>
@endsection

@section('content')
<div class="list-group">
	@foreach($links as $link)
	<a href="{{$link->url}}" class="list-group-item" target="_blank">{{$link->description}}</a>
	@endforeach
	{!! $links->render() !!}
</div>
@endsection