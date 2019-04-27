@extends('resource.base')

@section('title', '资源')

@section('style')
<style type="text/css">
	.content div{width: 33%;float: left;font-size: 40px;text-align: center;padding: 1em 0;cursor: pointer;}
</style>
@endsection

@section('script')
<script type="text/javascript">
	$(function(){
		$(".content div").on("click", function(){
			var id=$(this).attr("id");
			location.href="/resource/"+id+"/index";
		});
	});
</script>
@endsection

@section('banner')
<div class="jumbotron">
	<h1>资源</h1>
</div>
@endsection

@section('content')
<!-- <div style="background: #deffcc;" id="pdf">
	PDF书库
</div> -->
<div style="background: #6fe1f6;" id="document">
	文档
</div>
<div style="background: #b1cba4;" id="link">
	链接
</div>
@endsection