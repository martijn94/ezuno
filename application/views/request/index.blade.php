@layout('layout')

@section('title')
Requests
@endsection

@section('content')

<div class="hero-unit">
	{{HTML::link_to_route('request.new', 'Nieuwe request', array(), array('class' => 'btn btn-large btn-info'))}}
    <p>Requests:</p>
    @foreach ($requests as $request)         
            <h1>{{ $request->title }}</h1>
            <p>{{ $request->detail }}</p>
            <span class="badge badge-success">Posted {{$request->updated_at}}</span>
            <br /> <br />       
    @endforeach
</div>

@endsection