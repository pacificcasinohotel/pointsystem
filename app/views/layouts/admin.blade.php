<html lang="en-us" id="extr-page">
	<head>
		<meta charset="utf-8">
		<title>Pacific Casino Hotel</title>

		{{ HTML::style('assets/css/bootstrap.min.css') }}
    	{{ HTML::style('assets/css/font-awesome.min.css') }}
    	{{ HTML::style('assets/css/smartadmin-production.min.css') }}
    	{{ HTML::style('assets/css/smartadmin-skins.min.css') }}
    	{{ HTML::style('assets/css/demo.min.css') }}

		<!-- #FAVICONS -->

		<link rel="shortcut icon" href="{{ asset('assets/img/favicon/casino.ico') }}" type="image/x-icon">
		<link rel="icon" href="{{ asset('assets/img/favicon/casino.ico') }}" type="image/x-icon">

		<!-- #GOOGLE FONT -->
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

		<link rel="apple-touch-icon" href="{{ asset('assets/img/splash/sptouch-icon-iphone.png') }}">
		<link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/splash/img/splash/touch-icon-ipad.png')}}">
		<link rel="apple-touch-icon" sizes="120x120" href="{{asset('assets/img/splash/img/splash/touch-icon-iphone-retina.png')}}">
		<link rel="apple-touch-icon" sizes="152x152" href="{{asset('assets/img/splash/touch-icon-ipad-retina.png')}}">
		
		<!-- iOS web-app metas : hides Safari UI Components and Changes Status Bar Appearance -->
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		
		<!-- Startup image for web apps -->
		<link rel="apple-touch-startup-image" href="{{asset('assets/img/splash/ipad-landscape.png')}}" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
		<link rel="apple-touch-startup-image" href="{{asset('assets/img/splash/ipad-portrait.png')}}" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
		<link rel="apple-touch-startup-image" href="{{asset('assets/img/img/splash/iphone.png')}}" media="screen and (max-device-width: 320px)">

	</head>
	
	<body class="animated fadeIn">

		<header id="header">

			<div id="logo-group">
				<!-- <a class="navbar-brand" href="#">Dashboard </a> -->
				<span id="logo" style="position:relative;top:-77px">{{ HTML::image('/assets/img/logo.png',"Align Commerce") }}</span> 	
			</div>	
			
		</header>

		<div id="main" role="main">

		<!-- Content -->
        	@yield('content')
       	<!-- ./ content -->
		</div>

		<!--================================================== -->	

		<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
		
		{{ HTML::script('assets/js/plugin/pace/pace.min.js'); }}


	    <!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
	    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script> if (!window.jQuery) { document.write('<script src="assets/js/libs/jquery-2.0.2.min.js"><\/script>');} </script>

	    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
		<script> if (!window.jQuery.ui) { document.write('<script src="assets/js/libs/jquery-ui-1.10.3.min.js"><\/script>');} </script>
		

		<!-- JS TOUCH : include this plugin for mobile drag / drop touch events 		
		<script src="js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script> -->

		<!-- BOOTSTRAP JS -->
		{{ HTML::script('assets/js/bootstrap/bootstrap.min.js') }}		

		<!-- JQUERY VALIDATE -->
		{{ HTML::script('assets/js/plugin/jquery-validate/jquery.validate.min.js') }}

		<!-- JQUERY MASKED INPUT -->
		{{ HTML::script('assets/js/plugin/masked-input/jquery.maskedinput.min.js') }}
	
		<!--[if IE 8]>
			
			<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>
			
		<![endif]-->

		<!-- MAIN APP JS FILE -->
		{{ HTML::script('assets/js/app.min.js') }}

		<script type="text/javascript">

			$(function() {
				// Validation
				$("#login-form").validate({
					// Rules for form validation
					rules : {
						username : {
							required : true
						},
						password : {
							minlength : 0,
							maxlength : 20
						}
					},

					// Messages for form validation
					messages : {
						email : {
							required : 'Please enter your email address / username',
							email : 'Please enter a VALID email address / username'
						},
						password : {
							required : 'Please enter your password'
						}
					},

					// Do not change code below
					errorPlacement : function(error, element) {
						error.insertAfter(element.parent());
					}
				});
			});
		</script>

	</body>
</html>