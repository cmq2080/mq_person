<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="/plugins/bootstrap-3.3.7-dist/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="/css/index/init.css" />
		<link rel="stylesheet" type="text/css" href="/css/index/common.css" />
		<title>@yield('title')</title>
		@section('style')
		@show
		
		<script type="text/javascript" src="/js/jquery-2.1.4.min.js"></script>
		<script type="text/javascript" src="/plugins/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
		@section('script')
		@show
		
	</head>

	<body>
		<div class="_header">
			<div class="header">
				<nav class="navbar navbar-default navbar-inverse">
					<div class="container-fluid">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						        <span class="sr-only">Toggle navigation</span>
						        <span class="icon-bar"></span>
						        <span class="icon-bar"></span>
						        <span class="icon-bar"></span>
							</button>
					    </div>
						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav">
								<li>
									<a href="{{url('index/index/index')}}">首页</a>
								</li>
								<li>
									<a href="{{url('index/project/index')}}">项目作品</a>
								</li>
								<li>
									<a href="{{url('index/leave-message/index')}}">给我留言</a>
								</li>
								<li>
									<a href="{{url('index/story/index')}}">故事墙<span class="label label-danger">HOT</span></a>
								</li>
							</ul>
							<ul class="nav navbar-nav navbar-right">
								<li>
									<a href="{{url('resource/index/index')}}">资源</a>
								</li>
								<li>
									<a href="{{url('tool/index/index')}}">工具</a>
								</li>
							</ul>
						</div>
						<!-- /.navbar-collapse -->
					</div>
					<!-- /.container-fluid -->
				</nav>
			</div>
		</div>
		<div class="_banner">
			<div class="banner">
				@section('banner')
				@show
			</div>
		</div>
		@section('contact')
		@show
		<div class="_content">
			<div class="content">
				@section('content')
				@show
			</div>
		</div>
	</body>

</html>