@layout('layout')

@section('title')
Profiel bewerken
@endsection

@section('content')
    <a href="profiel" class="btn btn-danger annuleren">Annuleren</a>
    <div id="leftProfile">
        <div id="shortInfo">
            <div class="hero-unit">
                <h3>Algemene gegevens</h3>
                <p class="text-info">Uw profiel foto is te bewerken op uw google+ pagina.
                    {{HTML::link('http://support.google.com/plus/bin/answer.py?hl=en&answer=1057172', 'Klik hier',array('target' => '_blank', 'class'=>'editLink'))}} om te zien hoe u de foto veranderd.</p>
                <div class="profileImage">
                    <img src="@if($user->foto != "") {{$user->foto}} @else http://www.ezuno.nl/images/nophotoplaceholder.jpg @endif" alt="profielfoto" class="avatar2 imageEdit"/>
                </div>
                <div class="profileDetails">
                    {{ Form::open(); }}
                    <p>{{Form::label('naam', 'Naam:', array('class' => 'profileLabel'))}} {{ Form::text('naam', $user->naam)}}</p>
                    {{Form::label('studie', 'Studie:', array('class' => 'profileLabel'))}}
                     <select name="studie" id="studie" class="input-large">
                        @foreach ($educations as $education)
                            @if ($user->studie == $education->id)
                            <option value="{{ $education->id }}" selected>{{ $education->name }}</option>
                            @else
                            <option value="{{ $education->id }}">{{ $education->name }}</option>
                            @endif
                        @endforeach
                    </select>

                    <p>{{Form::label('studentnummer', 'Studentnummer:', array('class' => 'profileLabel'))}} {{ Form::text('email', $user->studentid, array('readonly' => 'readonly'))}}</p>
                    <br /><br /><br />
                    <h3>Overige gegevens</h3>
                    <p>{{Form::label('leeftijd', 'Leeftijd:', array('class' => 'profileLabel'))}}<span class="input-append"> {{ Form::text('leeftijd', $user->leeftijd)}}<span class="add-on">jaar</span></span></p>
                    <p>{{Form::label('email', 'Persoonlijke email:', array('class' => 'profileLabel'))}} {{ Form::text('email', $user->persmail)}}</p>
                    <p>{{Form::label('website', 'Website:', array('class' => 'profileLabel'))}} {{ Form::text('website', $user->website)}}</p>
                    <p><strong>Social media</strong></p>
                    <p class="text-info">Vul de link naar uw profiel pagina in!</p>
                    <p>{{Form::label('google', 'Google:', array('class' => 'profileLabel'))}} {{ Form::text('google', $user->google, array('readonly' => 'readonly'))}}</p>
                    <p>{{Form::label('linkedin', 'LinkedIn:', array('class' => 'profileLabel'))}} {{ Form::text('linkedin', $user->linkedin)}}</p>
                    <p>{{Form::label('facebook', 'Facebook:', array('class' => 'profileLabel'))}} {{ Form::text('facebook', $user->facebook)}}</p>
                    <p>{{Form::label('twitter', 'Twitter:', array('class' => 'profileLabel'))}} {{ Form::text('twitter', $user->twitter)}}</p>
                    <p>{{Form::submit('Opslaan', array('class' => 'btn btn-success opslaan'))}}</p>
                </div>
                <div class="clr"></div>
            </div>
        </div>
    </div>
    <div id="rightProfile">
        <div id="basicInfo">
            <div class="hero-unit">
                <h3>Skills</h3>
                @foreach($sections as $section)
                <p>
                    {{Form::label($section->name, $section->name, array('class'=> 'profileLabel'))}}
                    <input type="checkbox" name="section[{{$section->id}}]" <?php if(in_array($section->id, $skills)){ echo "checked"; } ?> />
                </p>
                @endforeach
            </div>
        </div>
    </div>
@endsection