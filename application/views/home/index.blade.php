@layout('layout')

@section('title')
Dashboard
@endsection

@section('content')
<div class="leftFloat">
    <div class="dashBlock">
        <div class="hero-unit">
            <h3>Vragen</h3>
                @if($count3 != 0)
                <div class="dashQuestion2">
                    <div class="questionTitle2">Titel</div>
                    <div class="questionAnwered2">Beantwoord</div>
                </div>
                @endif
                @forelse($sorted_questions as $sorted_question)
                <div class="dashQuestion">
                    <div class="questionTitle">
                        <a href="/vragen/bekijk/{{$sorted_question->id}}">
                            {{$sorted_question->title}}
                        </a>
                    </div>
                    <div class="questionAnwered">
                        @if($sorted_question->answered != 0)
                        <img src="images/icons/Check-icon.png" alt="Beantwoord" style="height:20px;width:auto;"/>
                        @else
                        <img src="images/icons/delete-icon.png" alt="Niet beantwoord" style="height:20px;width:auto;"/>
                        @endif
                    </div>
                </div>
                @empty
                Nog geen vragen gesteld.
                @endforelse
        </div>
    </div>
    <div class="dashBlock">
        <div class="hero-unit">
            <h3>Mijn vragen</h3>
                @if($count != 0)
                <div class="dashQuestion2">
                    <div class="questionTitle2">Titel</div>
                    <div class="questionAnwered2">Beantwoord</div>
                </div>
                @endif
                @forelse($questions as $question)
                <div class="dashQuestion">
                    <div class="questionTitle">
                        <a href="/vragen/bekijk/{{$question->id}}">
                            {{$question->title}}
                        </a>
                    </div>
                    <div class="questionAnwered">
                        @if($question->answered != 0)
                        <img src="images/icons/Check-icon.png" alt="Beantwoord" style="height:20px;width:auto;"/>
                        @else
                        <img src="images/icons/delete-icon.png" alt="Niet beantwoord" style="height:20px;width:auto;"/>
                        @endif
                    </div>
                </div>
                @empty
                Nog geen vragen gesteld.
                @endforelse

            </div>
    </div>
</div>
<div class="rightFloat">
<div class="dashBlock">
    <div class="hero-unit">
<h3>Aantal beantwoorde vragen</h3>
<table style="display:none;">

    <thead>
        <tr>
            <td></td>
            <th scope="col">Augustus</th>
            <th scope="col">September</th>
            <th scope="col">Oktober</th>
            <th scope="col">November</th>
            <th scope="col">December</th>
            <th scope="col">Januari</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">Gebruiker</th>
            <td>{{$answered}}</td>
            <td>{{$answered}}</td>
            <td>{{$answered}}</td>
            <td>{{$answered}}</td>
            <td>{{$answered}}</td>
            <td>{{$answered}}</td>
        </tr>
        <tr>
            <th scope="row">Gemiddelde gebruiker</th>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>3</td>
        </tr>

    </tbody>
</table>
</div>
</div>

<div class="dashBlock">
    <div class="hero-unit">
<h3>Aantal gevraagde vragen</h3>
<table style="display:none;">

    <thead>
        <tr>
            <td></td>
            <th scope="col">Augustus</th>
            <th scope="col">September</th>
            <th scope="col">Oktober</th>
            <th scope="col">November</th>
            <th scope="col">December</th>
            <th scope="col">Januari</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">Gebruiker</th>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>{{$count}}</td>
        </tr>
        <tr>
            <th scope="row">Gemiddelde gebruiker</th>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>5</td>
        </tr>

    </tbody>
</table>
</div>
</div>
</div>

<script type="text/javascript" src="http://filamentgroup.github.com/EnhanceJS/enhance.js"></script>
<script type="text/javascript" src="/js/excanvas.js"></script>
<script type="text/javascript" src="/js/visualize.jQuery.js"></script>
<script type="text/javascript">
    $(function(){
        $('table').visualize({type: 'bar', width: '420px'});
    });
</script>

@endsection