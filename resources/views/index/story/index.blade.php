@extends('index.base')

@section('title', '故事墙')

@section('style')
<style type="text/css">
	#add-story{display: none;}
</style>
@endsection

@section('script')
<script type="text/javascript">
	function share(){
		$("#add-story").slideDown();
	}
	
	function cancel(){
		$("#add-story").slideUp();
		// $("#add-story textarea[name='content']").val("");
		$("#error1").hide();
	}
	
	function commit(){
		var content=$.trim($("textarea[name='content']").val());
		if(content.length==0){
			$("#error1").slideDown();
			return;
		}
		$.ajax({
			type:"post",
			url:"{{url($c.'/add')}}",
			dataType:"json",
			async:true,
			data:{
				"content":content,
				"_token":"{{csrf_token()}}"
			},
			success:function(res){
				alert(res.msg);
				if(res.stat==0){
					location.href=location.href;
				}
			},
			error:function(e){
				alert("网络错误");
			}
		});
	}
</script>
@endsection

@section('banner')
<div class="jumbotron">
	<h1>故事墙</h1>
	<h3><small>他们的故事，你的故事……</small></h3>
</div>
@endsection

@section('content')
<div class="share" style="text-align: center;margin-bottom: 2em;">
	<a href="javascript:share();" class="btn btn-primary btn-lg">分享你的故事</a>
</div>
<div id="add-story" class="panel panel-default">
	<div class="panel-body">
		<div class="form-group">
			<div >
				<textarea class="form-control" style="outline: #000000;" name="content" rows="10" cols=""></textarea>
				<div class="alert alert-danger" id="error1" style="display: none;" role="alert">留言不能为空</div>
			</div>
		</div>
		<div class="form-group">
			<div>
				<input type="button" class="btn btn-primary" value="分享" onclick="commit();"/>
				<input type="button" class="btn btn-danger" value="取消" onclick="cancel();"/>
			</div>
		</div>
	</div>
</div>
<div class="container" style="user-select: none;">
	@foreach($stories as $story)
	<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
		<img src="/images/index/story/{{$story->id}}.png"/>
	</div>
	@endforeach
</div>
@endsection

