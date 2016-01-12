<!DOCTYPE html>
<html lang="en-us" id="lock-page">
    <head>
        <meta charset="utf-8">
        <title> Redeem Points</title>
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        
            {{ HTML::style('assets/css/bootstrap.min.css') }}
            {{ HTML::style('assets/css/font-awesome.min.css') }}
            {{ HTML::style('assets/css/smartadmin-production.min.css') }}
            {{ HTML::style('assets/css/smartadmin-skins.min.css') }}
            {{ HTML::style('assets/css/smartadmin-rtl.min.css') }}
            {{ HTML::style('assets/css/custom.css') }}
            {{ HTML::style('assets/css/demo.min.css') }}
            {{ HTML::style('assets/css/lockscreen.min.css') }}

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
    
    <body>

        <div id="main" role="main">

            <!-- MAIN CONTENT -->

            <form class="lockscreen animated flipInY" action="index.html">
                <div class="logo">
                    <h1 class="semi-bold"><img src="{{asset('assets/img/logo-o.png')}}" alt="" /> Player Redeem Points</h1>
                </div>
                <div>
                    <img src="{{asset('assets/img/chips.png')}}" alt="" width="130" height="104"/>
                    <div>
                        <h1><i class="fa fa-credit-card fa-3x text-muted air air-top-right hidden-mobile"></i><small>Redemption process</small></h1>

                        <p class="text-muted">1. Place the card in the card reader</p>
                        <p class="text-muted">2. Press "Redeem Points" button</p>

                        <div class="input-group">
                            
                            <div class="input-group-btn">
                            <a href="#" class="btn btn-primary btn-block"><i class="fa fa-gift"></i> Reedem Points</a>
                            </div>
                        </div>
                    </div>

                </div>
                <p class="font-xs margin-top-5">
                    Copyright Rapnx Solution Inc. 2014-2020.

                </p>
            </form>

        </div>

        <!--================================================== -->  

        <!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
        <script src="js/plugin/pace/pace.min.js"></script>

        <!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script> if (!window.jQuery) { document.write('<script src="js/libs/jquery-2.1.1.min.js"><\/script>');} </script>

        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
        <script> if (!window.jQuery.ui) { document.write('<script src="js/libs/jquery-ui-1.10.3.min.js"><\/script>');} </script>

        {{ HTML::script('assets/js/app.config.js') }}
        {{ HTML::script('assets/js/bootstrap/bootstrap.min.js') }}
        {{ HTML::script('assets/js/plugin/jquery-validate/jquery.validate.min.js') }}
        {{ HTML::script('assets/js/plugin/masked-input/jquery.maskedinput.min.js') }}
        {{ HTML::script('assets/js/app.min.js') }}

    </body>
</html>