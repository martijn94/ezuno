@layout('layout')

@section('title')
Register
@endsection

@section('content')

<div class="hero-unit">
<p>Register an account</p>
{{ Form::Open('user/register') }}
<p>{{ Form::label('email', 'Email') }}</p>
<p>{{ Form::text('email') }}</p>

<p>{{ Form::label('name', 'Name') }}</p>
<p>{{ Form::text('name') }}</p>

<p>{{ Form::label('studentid', 'Student id') }}</p>
<p>{{ Form::text('studentid') }}</p>

<p>{{ Form::label('password', 'Password') }}</p>
<p>{{ Form::password('password') }}</p>

<p>{{ Form::label('password', 'Password') }}</p>
<p>{{ Form::password('password2') }}</p>

<p>{{ Form::submit('Register', array('class' => 'btn btn-primary btn-large')) }}</p>
{{ Form::Close()}}
</div>

@endsection