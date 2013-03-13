@layout('layout')

@section('title')
User
@endsection

@section('content')

<div class="hero-unit">
    <p>Je moet ingelogd zijn om deze pagina te zien!</p>
    {{HTML::link_to_route('user.login', 'Login', array(),array('class' => 'btn btn-primary btn-large btn'))}}
    {{HTML::link_to_route('user.register', 'Create an account', array(), array('class' => 'btn btn-large btn-info'))}}
</div>

@endsection