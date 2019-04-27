@extends('index.base')

@section('title', '给我留言')

@section('style')
@endsection

@section('script')
<script type="text/javascript">
	function commit(){
		var content=$.trim($("textarea[name='content']").val());
		var from=$.trim($("input[name='from']").val());
		if(content.length==0){
			$("#error1").slideDown();
			return;
		}
		$("form").submit();
	}
	
	function cancel(){
		$("textarea[name='content']").val("");
		$("input[name='from']").val("");
		$("#error1").hide();
	}
</script>
@endsection

@section('banner')
<div class="jumbotron">
	<h1>给我留言</h1>
	<h3><small></small></h3>
</div>
@endsection

@section('content')
<form class="form-horizontal" action="{{url($c.'/add')}}" method="post">
	<div class="form-group">
		<label class="col-sm-1 control-label">内容</label>
		<div class="col-sm-11">
			<textarea class="form-control" style="outline: #000000;" name="content" rows="10" cols=""></textarea>
			<div class="alert alert-danger" id="error1" style="display: none;" role="alert">留言不能为空</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-1 control-label">署名</label>
		<div class="col-sm-11">
			<input class="form-control" type="text" name="from" id="" value="" />
			{!! csrf_field() !!}
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-1">
			<input type="button" class="btn btn-primary" value="提交留言" onclick="commit();"/>
			<input type="button" class="btn btn-danger" value="取消" onclick="cancel();"/>
		</div>
	</div>
</form>
@endsection
