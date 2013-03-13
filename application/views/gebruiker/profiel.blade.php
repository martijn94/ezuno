@layout('layout')

@section('title')
Profiel
@endsection

@section('content')
    @if($type == 'self')
    {{HTML::link('gebruiker/bewerk', 'Profiel bewerken', array('class' => 'btn btn-info bewerk'))}}
    @endif
    @if (isset($alert))
    <div class="alert alert-success" style="width:90%; margin:0 auto;">
    Uw gegevens zijn aangepast! <button type="button" data-dismiss="alert" class="close">x</a>
    </div>
    @endif
    <div id="leftProfile">
        <div id="shortInfo">
            <div class="hero-unit">
                <h3>Algemene gegevens</h3>
                <table>
                    <tr>
                        <td>
                            <div class="profileImage">
                                <img src="@if($user->foto != "") {{$user->foto}} @else http://www.ezuno.nl/images/nophotoplaceholder.jpg @endif" alt="profielfoto" class="avatar2"/>
                            </div>
                        </td>
                        <td>
                            <div class="profileDetails">
                                <p><strong>Naam:</strong> {{$user->naam}}</p>
                                <p><strong>Studie:</strong> {{Education::where_id($user->studie)->first()->name}}</p>
                                <p><strong>Studentnummer:</strong> {{$user->studentid}}<br />
                                </p>
                            </div>
                        </td>
                    </tr>
                </table>
                <div class="clr"></div>
            </div>
        </div>
        <div id="skillBlock">
            <div class="hero-unit">
                <h3>Skills</h3>
                @if($user->skills != "")
                @foreach(explode(',', $user->skills) as $skill)
                    <p><label>{{Ezuno\Section::where_id($skill)->first()->name}}</label></p>
                @endforeach
                @endif
            </div>
        </div>
    </div>
    <div id="rightProfile">
        <div id="basicInfo">
            <div class="hero-unit">
                <h3>Overige gegevens</h3>
                <p><strong>Leeftijd:</strong> {{$user->leeftijd}} @if($user->leeftijd != "")jaar @endif</p>
                <p><strong>Persoonlijk email:</strong> <a href="mailto:{{$user->persmail}}">{{$user->persmail}}</a></p>
                <p><strong>Website:</strong> <a href="{{$user->website}}" target="_blank">{{$user->website}}</a></p>
                <p><strong>Registratie datum:</strong> {{date("d-m-Y", strtotime($user->created_at))}}</p>
                <a href="{{$user->google}}"  style="width:110px;display:inline-block;" target="_blank"><img src="/images/icons/social/google.png" class="socialButton" alt="Google icon" /></a>
                @if($user->linkedin != "")
                <a href="{{$user->linkedin}}" style="width:110px;display:inline-block;" target="_blank"><img src="/images/icons/social/linkedin.png" class="socialButton" alt="LinkedIn icon" /></a>
                @endif
                @if($user->linkedin != "")
                <a href="{{$user->facebook}}" style="width:110px;display:inline-block;" target="_blank"><img src="/images/icons/social/facebook.png" class="socialButton" alt="Facebook icon" /></a>
                @endif
                @if($user->linkedin != "")
                <a href="{{$user->twitter}}"  style="width:110px;display:inline-block;" target="_blank"><img src="/images/icons/social/twitter.png" class="socialButton" alt="Twitter icon" /></a>
                @endif
            </div>
        </div>
    </div>
@endsection