@layout('layout')

@section('title')
Login
@endsection

@section('content')
   
<div class="hero-unit">
    {{ Form::open('user/log_in') }}
        <h2>Login</h2>

        <!-- check for login errors flash var -->
        @if (Session::has('login_errors'))
            {{ Alert::error("Username or password incorrect.") }}
        @endif
        <!-- username field -->
        <p>{{ Form::label('email', 'Email') }}</p>
        <p>{{ Form::text('email') }}</p>
        <!-- password field -->
        <p>{{ Form::label('password', 'Password') }}</p>
        <p>{{ Form::password('password') }}</p>
        <!-- submit button -->
        <p>
            {{ Form::submit('Login', array('class' => 'btn btn-primary btn-large')) }}
            {{HTML::link_to_route('user.register', 'Create an account.', array(), array('class' => 'btn btn-large btn-info'))}}
        </p>
    {{ Form::close() }}
</div>
@endsection