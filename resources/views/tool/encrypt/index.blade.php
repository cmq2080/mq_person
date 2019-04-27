@extends('tool.base')

@section('title', '工具-加密解密')

@section('style')
<style type="text/css">
	.form-group.result{margin-left:2rem;}
	.form-group.result label{color:#ff0000;}
</style>
@endsection

@section('script')
<script type="text/javascript">
	function commit() {
		var string=$("input[name='string']").val().trim();
		var type=$("select[name='type']").val();
		$.ajax({
			type:"POST",
			url:"{{url($c.'/encrypt')}}",
			async:false,
			data:{
			    "string":string,
				"type":type,
				"_token":"{{csrf_token()}}"
			},
			success:function (res) {
			    $(".result label").html(res);
            },
			error:function (e) {
				alert("网络错误");
            }
		});
    }
</script>
@endsection

@section('banner')
@endsection

@section('content')
<div class="form-inline">
	<div>
		<h2>加密</h2>
		<div class="form-group">
			<label for="">原文</label>
			<input type="text" class="form-control" name="string" value="">
		</div>
		<div class="form-group">
			<label for="">加密方式</label>
			<select class="form-control" name="type" id="">
				<option value="md5" selected>md5</option>
				<option value="sha1">sha1</option>
			</select>
		</div>
		<div class="form-group">
			<button type="button" class="btn btn-primary" onclick="commit()">加密</button>
		</div>
		<div class="form-group result">
			<label for="">------</label>
		</div>
	</div>
</div>
@endsection

