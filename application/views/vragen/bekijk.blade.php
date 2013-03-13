@layout('layout')

@section('title')
Vraag - {{$question->title}}
@endsection

@section('content')
{{HTML::link('vragen/overzicht', 'Terug', array('class' => 'btn btn-primary bewerk'))}}
@if (isset($alert))
    <div class="alert alert-success" style="width:81.9%; margin:0 0 10px 46px;">
    Wijziging succesvol! Deze vraag staat nu als beantwoord. <button type="button" data-dismiss="alert" class="close">x</a>
    </div>
@endif
<div style="width:80%;float:right;padding-right:17%;padding-top:5px;">
    <div class="modalLeft">
        <p style="font-size:16px;font-weight:bold;padding-top:15px;"><?php echo isset($user->naam) ? $user->naam : ''; ?></p>
        <img src={{$user->foto}} class="avatar3" alt="avatar"/>
        <p><strong>Studie:</strong><br />
        {{Education::where_id($user->studie)->first()->name}}</p>
        <p><a href="/gebruiker/bekijk/{{$user->id}}" class="btn btn-info btn-small">Profiel</a></p>
        <div class="modal-footer" style="padding:7px 10px 0;">
            <p style="font-size:16px; float:left;"><img src="/images/icons/question.png" alt="Vragen" style="height:15px;width:auto;margin-top:-2px;"/> {{$amount}}</p>
            <p style="font-size:16px;float:right;"><img src="/images/icons/Check-icon.png" alt="Beantwoord" style="height:15px;width:auto;margin-top:-2px;"/> {{$answered}}</p>
            <div class="clr"></div>
        </div>
    </div>
    <div class="modal" style="position:relative; margin:0px 0px 5px 200px; left:0px;top:0px;border-radius:0px;box-shadow:0 0;z-index:10;width:90%;">
        <div class="modal-header">
            <h4>{{$question->title}}</h4>
            @if($current_user->id == $question->userid)
                @if($current_answer == 0)
                {{ Form::open(); }}
                {{Form::submit('Mijn vraag is beantwoord', array('class' => 'btn btn-success btn-small beantwoord'))}}
                @else
                <button type="button" class="btn btn-success btn-small beantwoord disabled" disabled="disabled">Vraag staat als beantwoord</button>
                @endif
            @endif
        </div>
        <div class="modal-body" style="min-height:232px;">
            <p>{{$question->question}}</p>
        </div>
        <div class="modal-footer">
            <span class="pull-left">{{date('d-m-Y H:i', strtotime($question->created_at))}}</span>
            <div class="modal-tags">
                @if($question->tags != NULL)
                Labels:
                @endif
                <?php
                    $tags = explode(',',$question->tags);
                    foreach($tags as $tag){
                        echo '<span class="label label-info tag">';
                        echo $tag;
                        echo '</span>';
                    }
                ?>
            </div>
        </div>
    </div>
</div>
@endsection