@layout('layoutwologin')

@section('title')
Registreren
@endsection

@section('content')
	<div id="registrationbox">
    	<p class="regtext">Het koppelen van je Google&#153; account is gelukt!</p><br />
    	<a href="{{URL::to('registreer/stap2')}}" class="btn btn-large btn-info btn-block">Door naar stap 2</a>
    </div>

@endsection