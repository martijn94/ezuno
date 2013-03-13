@layout('layout')

@section('title')
Vragen - Overzicht
@endsection

@section('content')
<div class="container" style="background-color: #eee;">
    <div class="btn-group filter-button btn-block">
        <a class="btn dropdown-toggle filter-heading btn-small" data-toggle="dropdown" href="#">Filteren <span class="caret"></span></a>
    </div>
    <form class="form-horizontal filters" style="display: none;">
        <div class="control-group">
            <label class="control-label" for="studie">Studie:</label>
            <div class="controls">
                <select name="studie" id="studie" class="input-xxxlarge">
                    @foreach ($educations as $education)
                        <option value="{{ $education->id }}" @if($education->id == $selected_education) selected="selected" @endif>{{ $education->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="section">Rubriek:</label>
            <div class="controls">
                <select name="section" id="section" class="input-xxxlarge">
                    @foreach ($sections as $section)
                        <option value="{{ $section->id }}" @if($section->id == $selected_section) selected="selected" @endif>{{ $section->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="date">Datum:</label>
            <div class="controls">
                <select name="date" id="date" class="input-xxxlarge">
                    <option value="desc">Oudste eerst</option>
                    <option value="asc">Nieuwste eerst</option>
                </select>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="keywords">Trefwoorden</label>
            <div class="controls">
                <input type="text" name="keywords" class="input-xxxlarge" id="keywords" />
            </div>
        </div>
        <button class="btn btn-large btn-info btn-block">Zoeken</button>
    </form>
</div>
<div class="container" style="background-color: #eee;">
    <h3>Resultaten</h3>

    @forelse($questions as $question)
    <div class="modal" style="position:relative; margin:0px 0px 5px 0px; left:0px;top:0px; border-radius:0px;box-shadow:0 0;z-index:10;width:100%;">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" data-target="#modal" aria-hidden="true" rel="popover" data-original-title="Deze vraag niet meer zien?" data-content="Klik om deze vraag te verbergen.">&times;</button>
            <h4>{{$question->title}}</h4>
            <p><a class="helper" data-original-title="Gekozen opleiding">{{Education::where_id($question->education)->first()->name}}</a> -
                <a class="helper" data-original-title="Gekozen rubriek">{{Ezuno\Section::where_id($question->section)->first()->name}}</a> -
                <a class="helper" data-original-title="Tijd &amp; Datum van stellen">{{date('d-m-Y H:i', strtotime($question->created_at))}}</a></p>
        </div>
        <div class="modal-body">
            <?php
                $var   = strip_tags(substr($question->question, 0, 250));
                $space = strrpos($var, ' ');
            ?>
            <p>{{substr($var,0 , $space)}}&hellip;</p>
            @if($question->tags != NULL)
                @endif
                <?php
                    $tags = explode(',',$question->tags);
                    foreach($tags as $tag){
                        echo '<span class="label label-info tag">'.$tag.'</span>';
                    }
                ?>
        </div>
        <div class="modal-footer">
            <a href="/vragen/bekijk/{{$question->id}}" class="btn btn-primary">Bekijk vraag</a>
        </div>
    </div>
    @empty
    <p>Er zijn geen resultaten gevonden.</p>
    @endforelse
</div>
<script type="text/javascript">
$(function(){
    $('.helper').tooltip({placement: 'bottom'});
    $('.close').popover({trigger: 'hover', placement: 'left'});
    $('.close').on('click', function(e){
        e.preventDefault();
        $(this).parent().parent().slideUp(200);
    });

    var state = 0;
    $('.filter-heading').on('click', function(e) {
        if(state % 2 == 1) {
            $('.filters').stop(true,true).slideUp(500);
            $('.filter-button').removeClass('dropup');
        }
        else {
            $('.filters').stop(true,true).slideDown(500);
            $('.filter-button').addClass('dropup');
        }

        state++;
    });
});
</script>
@endsection