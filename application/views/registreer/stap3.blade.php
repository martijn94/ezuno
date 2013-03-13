@layout('layoutwologin')

@section('title')
Activeren
@endsection

@section('content')
    <div id="registrationbox">
        <p class="regtext">Account activatie</p>
        <form class="form-horizontal" action='' method="POST">
            <fieldset>

                <div class="control-group">
                    <label class="control-label" for="studnr">Student Nummer</label>
                    <div class="controls">
                        <div class="input-append">
                            <input disabled type="text" id="studnr" name="studnr" value="{{$user->studentid}}" class="input-large" />
                            <span class="add-on">@hr.nl</span>
                        </div>
                    </div>
                </div>

                <div class="control-group @if ($errors->has('code')) error @endif">
                    <label class="control-label" for="code">Activatie code</label>
                    <div class="controls">
                        <input type="text" id="code" name="code" value="{{ $code }}" class="input-large" />
                        @if ($errors->has('code'))
                            {{ $errors->first('code', '<br /><span class="help-inline">:message</span>') }}
                        @endif
                    </div>
                </div>


                <button class="btn btn-large btn-info btn-block">Activeer mijn account</button>

            </fieldset>
        </form>
    </div>
@endsection