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

            <form class="lockscreen animated flipInY">
                @include('notifications')
                <div class="logo">
                    <h1 class="semi-bold"><img src="{{asset('assets/img/logo-o.png')}}" alt="" /> Player Redeem Points</h1>
                </div>
                <div>
                    <img src="{{asset('assets/img/chips.png')}}" alt="" width="130" height="104"/>
                    <div>
                        <h1><i class="fa fa-credit-card fa-3x text-muted air air-top-right hidden-mobile"></i><strong><small>Redemption process</small></strong></h1>

                        <p class="text-muted">1. Place the <strong>"Card"</strong> in the <strong>Card Reader</strong></p>
                        <p class="text-muted">2. Press <strong>"Redeem Points"</strong> Button</p>

                        <div class="input-group">
                            
                            <div class="input-group-btn">
                           <button  data-rfid="{{ $url_rfid }}" type="button" class="btn btn-danger btn-block redeem_points">
                           <i class="fa fa-gift"></i> Redeem Points</button>
                            </div>
                        </div>
                    </div>

                </div>
                <p class="font-xs margin-top-5">
                    Copyright Rapnx Solution Inc. 2016.
                </p>
            </form>

        </div>

        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="modalRedeemLabel"></h4>
                    </div>
                        <div class="modal-body">
                            <div class="alert alert-info alert-block">
                                <h4 class="alert-heading" id="player_points"></h4>
                            </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <form id="points-redeem-form" class="smart-form" method="POST" action="">
                                        {{ Form::token() }}
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                        
                                        <label class="input" id="playerPointsRedeem">
                                            <input class="form-control player_points_redeem" type="text" id="points_redeemed" name="points">
                                        </label>
                                        
                                        <input type="hidden" id="confirm_points" name="confirm_points">
                                        <input type="hidden" id="player_id" name="player_id">
                                    </div>
                                    <div class="note note-error"></div>
                                </div>
                            </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default"  data-dismiss="modal">
                                    Cancel
                                </button>
                                <button type="button" class="btn btn-primary confirm_redemption">
                                    Confirm Points Redemptions
                                </button>
                            </form>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

        <!--================================================== -->  

        <!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->

        <!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script> if (!window.jQuery) { document.write('<script src="js/libs/jquery-2.1.1.min.js"><\/script>');} </script>

        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
        <script> if (!window.jQuery.ui) { document.write('<script src="js/libs/jquery-ui-1.10.3.min.js"><\/script>');} </script>

        {{ HTML::script('assets/js/plugin/pace/pace.min.js') }}
        {{ HTML::script('assets/js/bootstrap/bootstrap.min.js') }}
        {{ HTML::script('assets/js/plugin/jquery-validate/jquery.validate.min.js') }}
        {{ HTML::script('assets/js/plugin/masked-input/jquery.maskedinput.min.js') }}
        {{ HTML::script('assets/js/notification/SmartNotification.min.js') }}  
        {{ HTML::script('assets/js/smartwidgets/jarvis.widget.min.js') }}  
        {{ HTML::script('assets/js/app.min.js') }}
        {{ HTML::script('assets/js/autoNumeric.js') }}
        {{ HTML::script('assets/js/libs/pointsys.js') }}

    </body>
</html>