<html>
<head>
    <meta charset=utf-8 />
    <title></title>
    <link rel="stylesheet" type="text/css" media="screen" href="css/master.css" />
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    <style>
        .header{
            width: 600px;
            height:80px;
        }

        img{
            margin-top:20px;
            margin-left:10px;
        }

        .content{

            width:580px;
            text-align: left;
            font-family: helvetica;
            padding-top:20px;
            padding-bottom:20px;
            padding-left:20px;
        }

        .footer{
            width:590px;
            height:23px;
            color:#fff;
            padding-top:7px;
            padding-left:10px;
        }
</style>
</head>

<body>
    <div class="header" style="background-color:#313131;">
        <img src="http://www.ezuno.nl/img/logo.png" height="40" width="180"/>
    </div>

    <div class="content" style="background-color:#F2F2F2;">

        Beste {{$user->naam}},<br /><br />

        <strong>Welkom bij Ezuno!</strong><br /><br />

        U bent bijna geregistreerd bij Ezuno.<br /><br />

        <a href="http://www.ezuno.nl/registreer/activeer/{{$user->code}}"><img src="http://www.ezuno.nl/img/button.png" height="44" width="540" /></a><br />

        <p>Uw activatie code is: <code style="background-color: #F7F7F9;
            border: 1px solid #E1E1E8;
            color: #DD1144;
            padding: 2px 4px;
            white-space: nowrap;
            ">{{$user->code}}</code></p>
        <p>En plak de volgende link in uw browser: <br /> <code style="background-color: #F7F7F9;
            border: 1px solid #E1E1E8;
            color: #DD1144;
            padding: 2px 4px;
            white-space: nowrap;
            ">http://www.ezuno.nl/registreer/activeer/{{$user->code}}</code></p>

        <p>Groeten,</p>

        <p>Het team van Ezuno</p>
    </div>
    <div class="footer" style="background-color:#313131; color:white;">&copy; 2013 Ezuno. All rights reserved.</div>
</body>
</html>