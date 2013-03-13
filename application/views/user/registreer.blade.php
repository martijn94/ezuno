@layout('layout')

@section('title')
Register
@endsection

@section('content')
<div class="hero-unit">
    <form>
        <a href="https://accounts.google.com/o/oauth2/auth?client_id=433174333411.apps.googleusercontent.com&scope=https://www.googleapis.com/auth/userinfo.email&redirect_uri=http://www.ezuno.nl/callback/oauth2&state=register&response_type=code&approval_prompt=force" class="btn btn-primary btn-large">Registreer met een Google account</a>
    </form>
</div>
{{ HTML::link('connect/session/google', 'Sign-in with Twitter') }}
@endsection