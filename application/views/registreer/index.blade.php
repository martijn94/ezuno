@layout('layoutwologin')

@section('title')
Registreren
@endsection

@section('content')
	<div id="registrationbox">
    	<p class="regtext">Hallo, en welkom op Ezuno&#153;<br />Om Ezuno te gebruiken moet u zich registreren via Google&#153;</p><br />
    	<a href="{{URL::to('connect/session/google')}}" class="btn btn-large btn-primary btn-block"><i class="googleicon20"></i> Registreer met Google</a>
    </div>

@endsection