@layout('layout')

@section('title')
Help / FAQ
@endsection

@section('content')
<div class="container">
    <h3>Algemeen</h3>
    <div class="accordion" id="accordion2">
        <div class="accordion-group">
            <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseZero">
                    Wat is Ezuno?
                </a>
            </div>
            <div id="collapseZero" class="accordion-body collapse">
                <div class="accordion-inner">
                    Ezuno is een platform waar studenten elkaar kunnen helpen d.m.v. videochat, dit platform wordt uitgedragen vanuit de Hogeschool van Rotterdam.
                </div>
            </div>
        </div>
        <div class="accordion-group">
            <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                    Waarom moet ik op Ezuno registreren met Google?
                </a>
            </div>
            <div id="collapseOne" class="accordion-body collapse">
                <div class="accordion-inner">
                    Omdat er op Ezuno gebruik wordt gemaakt van Google Hangouts is het nodig dat je verbonden bent via Google. Voor jou brengt dit eigenlijk alleen maar voordelen. Zo hoef je nooit een wachtwoord in te voeren.
                </div>
            </div>
        </div>
        <div class="accordion-group">
            <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                    Welke gegevens gebruiken jullie van mijn Google account?
                </a>
            </div>
            <div id="collapseTwo" class="accordion-body collapse">
                <div class="accordion-inner">
                    Wij hebben geen toegang tot gegevens die niet openbaar zijn, in principe gebruiken wij alleen je email, naam en foto.
                </div>
            </div>
        </div>
        <h3>Profiel</h3>
        <div class="accordion-group">
            <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
                    Hoe verander ik mijn foto.
                </a>
            </div>
            <div id="collapseThree" class="accordion-body collapse">
                <div class="accordion-inner">
                    Je foto verander je via Google, wij updaten die dan vanzelf voor je. <a class="editLink" target="_blank" href="http://support.google.com/plus/bin/answer.py?hl=en&amp;answer=1057172">Klik hier voor de instructies.</a>
                </div>
            </div>
        </div>
        <h3>Hulp vragen</h3>
        <h3>Hulp geven</h3>
        <div class="accordion-group">
            <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFour">
                    Hoe weten jullie welke vragen relevant voor mij zijn ?
                </a>
            </div>
            <div id="collapseFour" class="accordion-body collapse">
                <div class="accordion-inner">
                    Aan de hand van de skills die jij hebt aangegeven creeeren wij via een berekening de relevanste vragen. Door zelf zoek parameters in te voeren kun je dit natuurlijk beinvloeden om andere vragen te zien.
                </div>
            </div>
        </div>
        <h3>Hangouts</h3>
        <div class="accordion-group">
            <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFive">
                    Wat is Google Hangout?
                </a>
            </div>
            <div id="collapseFive" class="accordion-body collapse">
                <div class="accordion-inner">
                    Google Hangout is het nieuwe videoplatform van Google, hiermee kun je in je browser een videochat voeren.
                </div>
            </div>
        </div>
        <div class="accordion-group">
            <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseSix">
                    Wat heb ik nodig voor Google Hangout
                </a>
            </div>
            <div id="collapseSix" class="accordion-body collapse">
                <div class="accordion-inner">
                    Voor Google hangout is in principe alleen een nieuwere browser nodig, wel is een plug in nodig. Deze plug-in wordt autmatisch bij je eerste Hangout geinstelleerd.
                </div>
            </div>
        </div>
    </div>
</div>

@endsection