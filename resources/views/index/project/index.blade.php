@extends('index.base')

@section('title', '项目作品')

@section('style')
@endsection

@section('script')
@endsection

@section('banner')
<div class="jumbotron">
	<h1>项目作品</h1>
	<h3><small></small></h3>
</div>
@endsection

@section('content')
<ul>
	@foreach($projects as $project)
	<li>
		<div class="panel panel-info">
			<div class="panel-heading">
				<h2 class="panel-title">{{$project->name}}</h2>
			</div>
			<div class="panel-body">
				<p class="date"><span>{{$project->start_on}}</span> ~ <span>{{$project->end_on}}</span></p>
				<div class="desc">
					{{$project->description}}
				</div>
				<div id="img">
					<!--<img src="assets/images/1421224516.png"/>
					<img src="assets/images/1421224516.png"/>
					<img src="assets/images/1421224516.png"/>-->
				</div>
			</div>
		</div>
	</li>
	@endforeach
</ul>
@endsection
