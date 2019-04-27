@extends('resource.base')

@section('title', 'PDF书库')

@section('style')
@endsection

@section('script')
<script type="text/javascript">
	function commit(){
		var content=$.trim($("textarea[name='content']").val());
		if(content.length==0){
			$("#error1").fadeIn();return;
		}
		$("form").submit();
	}
</script>
@endsection

@section('banner')
<div class="jumbotron">
	<h1>PDF书库</h1>
	<h3><small>海量的PDF图书</small></h3>
</div>
@endsection

@section('content')
<div class="share" style="text-align: center;margin-bottom: 2em;">
	<a href="{{$pdfUrl}}" class="btn btn-primary btn-lg" target="_blank">点此进入</a>
</div>
@endsection