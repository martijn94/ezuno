<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<link rel="shortcut icon" href="favicon.ico">

	<!-- Include bootstrap Assets -->
	<link rel="stylesheet" href="/css/bootstrap.css">
	<link rel="stylesheet" href="/css/style.css">
	<link rel="stylesheet" href="/css/tagmanager.css">

	<script type="text/javascript" src="/js/jquery.js"></script>
	<script type="text/javascript" src="/js/bootstrap.js"></script>
	<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>


	<!-- Add meta viewport for responsive web -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Ezuno | @yield('title')</title>

</head>
<body>
	<div id="wrapper">
		<header class="row-fluid">
			<div class="navbar navbar-fixed-top custom_nav">
				<div class="navbar-inner">
					<div class="logo">
						<a href="/">
							<img src="/img/logo.png" alt="Ezuno!" />
						</a>
					</div>
   		 			<ul class="nav">
   		 		 		<li><a href="/gebruiker/login" title="" class="active"><img src="/images/icons/mainnav/dashboard.png" alt="" /><br/><span>Log in</span></a></li>
			            <li><a href="/registreer" title=""><img src="/images/icons/mainnav/ui.png" alt="" /><br/><span>Registreren</span></a>
			            </li>
			            <li><a href="/informatie/overons" title=""><img src="/images/icons/mainnav/other.png" alt="" /><br/><span>Over ons</span></a></li>
			            <li><a href="#" title=""><img src="/images/icons/mainnav/messages.png" alt="" /><br/><span>Help/FAQ</span></a></li>
			   		 </ul>
   				</div>
   			</div>
		</header>
		<div id="mainWrapper">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span12">
						<div id="content">
							@yield('content')
						</div>
					</div>
				</div>
			</div>
			<footer class="row-fluid">
				<p>&copy; {{date('Y')}} Ezuno. All rights reserved.</p>
			</footer>
		</div>
	</div>
</body>
</html>
