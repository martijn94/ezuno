<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>{{ Config::get('administrator::administrator.title') }}</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">

	<!--styles -->
	{{ Asset::container('container')->styles() }}

	<!-- Soporte para IE6-8 de elementos HTML5 -->
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<!-- favicon and touch icons -->
	<link rel="shortcut icon" href="favicon.ico">
</head>
<body>
	<div class="row-fluid">
		<div id="wrapper">

			@include('administrator::partials.header')

			{{ $content }}

			@include('administrator::partials.footer')
		</div>
	</div>

	<!-- JavaScript placed at the end of the document so the pages load faster -->
	{{ Asset::container('container')->scripts() }}
	<script type="text/javascript">
	$(function() {
		$('#content').insertAfter('<div class="clr"></div>');
		 //$('#content').insertBefore('#sidebar');
	});
	</script>
</body>
</html>