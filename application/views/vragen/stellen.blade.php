@layout('layout')

@section('title')
Vragen - Stellen
@endsection

@section('content')
<form class="form-horizontal" method="POST">
    <fieldset>
        <div class="control-group">
            <label class="control-label" for="studie">Studie</label>
            <div class="controls">
                <select name="studie" id="studie" class="input-large">
                    <option value="0">Maak een keuze</option>
                    @foreach ($educations as $education)
                        <option value="{{ $education->id }}">{{ $education->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="control-group @if ($errors->has('section')) error @endif">
            <label class="control-label" for="section">Rubriek*</label>
            <div class="controls">
                <select name="section" id="section" class="input-large">
                    <option value="0">Maak een keuze</option>
                    @foreach ($sections as $section)
                        <option value="{{ $section->id }}">{{ $section->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="control-group @if ($errors->has('titel')) error @endif">
            <label class="control-label" for="inputVraagOmschrijving">Vraag Omschrijving*</label>
            <div class="controls">
                <input type="text" name="titel" @if (isset($title)) value="{{$title}}" @endif id="inputVraagOmschrijving" placeholder="Omschrijving van de vraag." class="input-xxxlarge" />
                @if ($errors->has('titel'))
                    {{ $errors->first('titel', '<span class="help-inline">:message</span>') }}
                @endif
            </div>
        </div>

        <div class="control-group @if ($errors->has('vraag')) error @endif">
            <label class="control-label" for="inputVraag">Vraag*</label>
            <div class="controls">
                <textarea placeholder="Stel hier je vraag" name="vraag" id="inputVraag" cols="50" rows="10" class="ckeditor">@if (isset($question)){{$question}}@endif</textarea>
                @if ($errors->has('vraag'))
                    {{ $errors->first('vraag', '<br /><span class="help-inline">:message</span>') }}
                @endif
            </div>
        </div>

        <div class="control-group @if ($errors->has('hidden-tags')) error @endif">
            <label class="control-label" for="inputLabel">Labels</label>
            <div class="controls">
                <input type="hidden" name="error-tags" id="error-tags" value="@if (isset($hiddentags)) {{$hiddentags}} @endif" />
                <input type="text" name="tags" id="inputLabel" class="tagManager" @if (isset($tags)) value="{{$tags}}" @endif placeholder="Labels schijden met een comma" class="input-xxxlarge" />
                @if ($errors->has('hidden-tags'))
                    {{ $errors->first('hidden-tags', '<br /><span class="help-inline">:message</span>') }}
                @endif
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Vraag Stellen</button>
            <button type="button" class="btn">Annuleren</button>
        </div>
    </fieldset>
</form>
<script type="text/javascript" src="/js/tagmanager.js"></script>
<script type="text/javascript">
jQuery(".tagManager").tagsManager({
    preventSubmitOnEnter: true,
    CapitalizeFirstLetter: false,
    typeahead: true,
    delimeters: [44, 188, 13],
    backspace: [8],
    typeaheadSource: ["Pisa", "Rome", "Milan", "Florence", "New York", "Paris", "Berlin", "London", "Madrid"],
    blinkBGColor_1: '#FF6600',
    blinkBGColor_2: '#000000',
});
$(function(){
    var tags = jQuery("#error-tags").val();
    $.each(tags.split(','), function(index, value) {
        if($.trim(value) != '') {
            jQuery(".tagManager").tagsManager('pushTag', value);
        }
    });
});
</script>
@endsection