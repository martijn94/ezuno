<?php
	$user_data = Session::get('oneauth');
	//var_dump($user_data);
	$photo = $user_data['info']['image'];
	$name = $user_data['info']['name'];
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<link rel="shortcut icon" href="favicon.ico">

	<!-- Include bootstrap Assets -->
	<link rel="stylesheet" href="/css/bootstrap.css">
	<!-- <link rel="stylesheet" href="/css/bootstrap-styled.css"> -->
	<link rel="stylesheet" href="/css/wysiwyg.css">
	<link rel="stylesheet" href="/css/style.css">
	<link rel="stylesheet" href="/css/tagmanager.css">
	<link rel="stylesheet" href="/css/graphs/visualize-light.css">
	<link rel="stylesheet" href="/css/graphs/visualize.css">

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
						<a href="http://www.ezuno.nl">
							<img src="/img/logo.png" alt="Ezuno!" />
						</a>
					</div>
   		 			<ul class="nav">
   		 		 		<li><a href="/" title="" class="active"><img src="/images/icons/mainnav/dashboard.png" alt="" /><br/><span>Dashboard</span></a></li>
			            <li><a href="/vragen/overzicht" title=""><img src="/images/icons/mainnav/ui.png" alt="" /><br/><span>Helpen</span></a>
			            </li>
			            <li><a href="/vragen/stellen"><img src="/images/icons/mainnav/forms.png" alt="" /><br/><span>Hulp vragen</span></a>

			            </li>
			            <li><a href="/informatie/overons" title=""><img src="/images/icons/mainnav/other.png" alt="" /><br/><span>Over ons</span></a></li>
			            <li><a href="/informatie/help" title=""><img src="/images/icons/mainnav/messages.png" alt="" /><br/><span>Help/FAQ</span></a></li>
			   		 </ul>
   				</div>
   			</div>
		</header>
		<div id="mainWrapper2">
			<div class="container-fluid">
				<div class="row-fluid">
						<div id="sidebar">
							<div style="width:100%;height:100%;position:relative;">
							<div id="userInfo">
								<h3 class="profileName"><?php echo $name; ?></h3>
								<img src="<?php echo $photo; ?>" alt="Ezuno!" class="avatar"/>

								<ul id="userOptions">
									<li><a href="/gebruiker/profiel"><img src="/images/icons/usernav/profile.png" alt="" /><br/>Mijn profiel</a></li>
									<li><a href="/gebruiker/loguit"><img src="/images/icons/usernav/logout.png" alt="" /><br/>Log uit</a></li>
								</ul>
							</div>
							<footer>
								<p style="margin:0 auto;">&copy; {{date('Y')}} Ezuno.<br /> All rights reserved.</p>
							</footer>
						</div>
					</div>
						<div id="content">
							<div class="pageTop">
								<h3 class="pageTitle">@yield('title')</h3>
							</div>
							@yield('content')
							<div class="clr"></div>

						</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>