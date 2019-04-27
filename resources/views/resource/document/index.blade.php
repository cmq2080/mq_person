@extends('resource.base')

@section('title', '文档')

@section('style')
<style type="text/css">
	.list-group .list-group-item{cursor: pointer;user-select: none;-ms-user-select: none;font-weight: bold;}
</style>
@endsection

@section('script')
<script type="application/javascript">

</script>
@endsection

@section('banner')
<div class="jumbotron">
	<h1>文档</h1>
	<h3><small>好文档，大家一起分享……</small></h3>
</div>
@endsection

@section('content')
<ul class="list-group">
	@foreach($documents as $document)
	<li class="list-group-item" style="background: #{{$bgColors[$document->type->id]}}" onclick="downloadDoc({{$document->id}});">{{$document->doc_name}}</li>
	@endforeach
</ul>
@endsection
