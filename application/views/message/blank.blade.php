@layout('layout')

@section('title')
Bericht
@endsection


@section('content')
<div class="container">
	<div class="hero-unit">
		<h2>{{$title}}</h2>

		@if($message !== null)
		<div class="alert {{ $blockType }}">
			@if($closeButton !== null && $closeButton !== false) <button type="button" class="close" data-dismiss="alert">×</button> @endif
			{{ $message; }}
		</div>
		@endif

		@if($goback === true)
		<a href="javascript:void();" onclick="javascript:history.back(-1);" class="btn btn-info btn-large">Go back</a>
		@endif
	</div>
</div>
@endsection