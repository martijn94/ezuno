@layout('layoutwologin')

@section('title')
Inloggen
@endsection

@section('content')
	<div id="registrationbox">
    	<p class="regtext">Hallo, en welkom op Ezuno&#153;<br />Om Ezuno te gebruiken moet u ingelogd zijn</p>
    	<a href="{{URL::to('connect/session/google')}}" class="btn btn-large btn-primary btn-block"><i class="googleicon20"></i> Log in met google&#153;</a><br />
    	<p class="regtext">Of klik hier om te registreren</p>
    	<a href="{{URL::to('registreer')}}" class="btn btn-large btn-info btn-block">Registreren</a>
    </div>

@endsection