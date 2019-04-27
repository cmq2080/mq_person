@extends('tool.base')

@section('title', '工具-二维码')

@section('style')
@endsection

@section('script')
<script type="text/javascript">
	function commit() {
		var url=$("textarea[name='url']").val().trim();
		if(url.length==0){
		    alert("原文不能为空");
            $("textarea[name='url']").focus();
            return;
		}
		$.ajax({
			type:"POST",
			url:"{{url($c.'/mk-qrcode')}}",
			async:false,
			data:{
			    "url":url,
				"_token":"{{csrf_token()}}"
			},
			success:function (res) {
			    $(".result").html(res);
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
<div>
	<div>
		<h2>二维码</h2>
		<div class="form-group">
			<label for="">原文</label>
			<textarea class="form-control" name="url" style="height: 10rem;"></textarea>
		</div>
		<div class="form-group">
			<button type="button" class="btn btn-primary" onclick="commit()">生成二维码</button>
		</div>
	</div>
	<div>
		<div class="form-group">
			<label for="">结果</label>
			<div class="result" style="text-align:center;"></div>
		</div>
	</div>
</div>
@endsection

