@layout('layout')

@section('title')
Bericht
@endsection

@section('content')
<div class="container">
	<div class="hero-unit">
		<h2>{{$title}}</h2>

		{{$message}}

	</div>
</div>
@endsection