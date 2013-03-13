@layout('layoutwologin')

@section('title')
Registreren
@endsection

@section('content')
    <div id="registrationbox">
        <p class="regtext">Om gebruik te maken van Ezuno&#153; is het nodig om je student nummer te valideren<br />Voer deze en je volledige naam hier onder in</p><br />
        <form class="form-horizontal" action='stap2' method="POST">
            <fieldset>
                <div id="registrationleft">
                    <img src="@if($user->foto != "") {{$user->foto}} @else http://www.ezuno.nl/images/nophotoplaceholder.jpg @endif" alt="profielfoto" class="avatar"/>
                </div>
                <div id="registrationright">
                    <div class="control-group @if ($errors->has('studnr')) error @endif">
                        <label class="control-label" for="studnr">Student Nummer</label>
                        <div class="controls">
                            <div class="input-append">
                                <input type="text" id="studnr" name="studnr" placeholder="0123456" @if (isset($studnr)) value="{{$studnr}}" @endif; class="input-large" />
                                <span class="add-on">@hr.nl</span>
                            </div>
                            @if ($errors->has('studnr'))
                                {{ $errors->first('studnr', '<br /><span class="help-inline">:message</span>') }}
                            @endif
                        </div>
                    </div>

                    <div class="control-group @if ($errors->has('naam')) error @endif">
                        <label class="control-label" for="naam">Naam</label>
                        <div class="controls">
                            <input type="text" id="naam" name="naam" placeholder="" @if (isset($naam)) value="{{$naam}}" @endif class="input-large" />
                            @if ($errors->has('naam'))
                                {{ $errors->first('naam', '<br /><span class="help-inline">:message</span>') }}
                            @endif
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="studie">Studie</label>
                        <div class="controls">
                            <select name="studie" id="studie" class="input-large">
                                @foreach ($educations as $education)
                                    <option value="{{ $education->id }}">{{ $education->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <button class="btn btn-large btn-info btn-block">Valideren</button>

            </fieldset>
        </form>
    </div>
@endsection