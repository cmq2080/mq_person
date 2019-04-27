@extends('index.base')

@section('title','个人网站')

@section('style')
<style type="text/css">
	#content-right ul li.active {
		background: #e7e7e7;
	}
</style>
@endsection

@section('script')
<script type="text/javascript">
	$(function() {
		var eles = $("#content-left h2");
		var tops = [];
		for(var i = 0; i < eles.length; i++) {
			var ele = eles[i];
			tops[i] = $(ele).offset().top - 20;
		}
		// alert($("#content-left").offset().top);

//滚动聚焦
		$(window).scroll(function() {
			var scrollTop = $(this).scrollTop();
			if(scrollTop < tops[0]) {
				$("#content-right li").removeClass("active").eq(0).addClass("active");
			} else if(scrollTop > tops[eles.length - 1]) {
				$("#content-right li").removeClass("active").eq(length - 1).addClass("active");
			} else {
				for(var i = 0; i < eles.length - 1; i++) {
					if(scrollTop > tops[i] && scrollTop < tops[i + 1]) {
						$("#content-right li").removeClass("active").eq(i).addClass("active");
					}
				}
			}
		});
	});
</script>
@endsection

@section('banner')

@endsection

@section('contact')
<div class="" style="width: 100%; background: #f5f5f5;padding: 15px 0;">
	<div class="" style="width: 1200px;margin: 0 auto;text-align: center;">
		@foreach ($contacts as $contact)
		@if($contact['url']==null)
		<!-- url为空，代表是显示联系方式，如qq，telephone等 -->
		<span>{{$contact->title}}:{{$contact->content}}</span>
		@else
		<!-- url不为空，则代表是链接联系方式 -->
		<a href="{{$contact->url}}">{{$contact->title}}</a>
		@endif
		@endforeach
	</div>
</div>
@endsection

@section('content')
<div id="content-left" style="width: 90%;position: relative;">
	@foreach($sections as $section)
	<h2 id="section_{{$section->id}}">{{$section->title}}</h2>
	{{$section->content}}
	@endforeach
</div>
<div id="content-right" style="float: right;width: 10%;">
	<ul class="nav" style="overflow: hidden;position: fixed;bottom: 30px;">
		@foreach($sections as $section)
		<li>
			<a href="#section_{{$section->id}}">{{$section->title}}</a>
		</li>
		@endforeach
	</ul>
</div>
@endsection
