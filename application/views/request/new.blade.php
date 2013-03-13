@layout('layout')

@section('title')
Nieuwe request
@endsection

@section('content')

<div class="hero-unit">
<p>Afspraak request maken</p>
{{ Form::Open('request/new') }}
<p>{{ Form::label('title', 'Title') }}</p>
<p>{{ Form::text('title') }}</p>

<p>{{ Form::label('detail', 'Detail') }}</p>
<p>{{ Form::text('detail') }}</p>

<p>{{ Form::label('datum', 'Datum') }}</p>
<p>{{ Form::text('datum') }}</p>

<p>{{ Form::submit('Afspraak maken', array('class' => 'btn btn-primary btn-large')) }}</p>
{{ Form::Close()}}
</div>

@endsection