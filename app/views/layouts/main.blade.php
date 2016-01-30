<!DOCTYPE html>
<html lang="en-us">
  <head>
    <meta charset="utf-8">
    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->

    <title> 
      @section('title') 
      @show 
    </title>

    {{ HTML::style('assets/css/bootstrap.min.css') }}
    {{ HTML::style('assets/css/font-awesome.min.css') }}
    {{ HTML::style('assets/css/smartadmin-production.min.css') }}
    {{ HTML::style('assets/css/smartadmin-skins.min.css') }}
    {{ HTML::style('assets/css/demo.min.css') }}
    {{ HTML::style('assets/css/custom.css') }}
    {{ HTML::style('assets/css/daterangepicker-bs3.css') }}

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
  <body class="">
    <!-- possible classes: minified, fixed-ribbon, fixed-header, fixed-width-->

    <!-- HEADER -->
    <header id="header">
      <div id="logo-group">

        <!-- PLACE YOUR LOGO HERE -->
        <span id="logo"> 
         <p class="logo">Pacisific Casino Hotel</p>
         <!-- <img src="{{asset('assets/img/estateadmin.png')}}" alt="Estate Admin"> -->
        </span>
        <!-- END LOGO PLACEHOLDER -->

        <!-- Note: The activity badge color changes when clicked and resets the number to 0
        Suggestion: You may want to set a flag when this happens to tick off all checked messages / notifications -->
        <!--
        <span id="activity" class="activity-dropdown"> 
          <i class="fa fa-user"></i> 
          <b class="badge"> 21 </b> 
        </span>
        -->
        <!-- AJAX-DROPDOWN : control this dropdown height, look and feel from the LESS variable file -->
        <!--
        <div class="ajax-dropdown">

          <div class="btn-group btn-group-justified" data-toggle="buttons">
            <label class="btn btn-default">
              <input type="radio" name="activity" id="http://localhost:8000/assets/ajax/notify/notifications.html">
              Msgs (14) </label>
            <label class="btn btn-default">
              <input type="radio" name="activity" id="http://localhost:8000/assets/ajax/notify/notifications.html">
              notify (3) </label>
            <label class="btn btn-default">
              <input type="radio" name="activity" id="http://localhost:8000/assets/ajax/notify/tasks.html">
              Tasks (4) </label>
          </div>

          <div class="ajax-notifications custom-scroll">

            <div class="alert alert-transparent">
              <h4>Click a button to show messages here</h4>
              This blank page message helps protect your privacy, or you can show the first message here automatically.
            </div>

            <i class="fa fa-lock fa-4x fa-border"></i>

          </div>
        -->
          <!-- end notification content -->

          <!-- footer: refresh area -->
          <!--
          <span> Last updated on: 12/12/2013 9:43AM
            <button type="button" data-loading-text="<i class='fa fa-refresh fa-spin'></i> Loading..." class="btn btn-xs btn-default pull-right">
              <i class="fa fa-refresh"></i>
            </button> 
          </span>
        -->
          <!-- end footer -->

        <!-- </div> -->
        <!-- END AJAX-DROPDOWN -->
      <!-- </div> -->
      <!-- projects dropdown -->
      <!--
      <div class="project-context hidden-xs">

        <span class="label">Webtool</span>
        <span class="project-selector dropdown-toggle" data-toggle="dropdown">Recent Features <i class="fa fa-angle-down"></i></span>
      -->
        <!-- Suggestion: populate this list with fetch and push technique -->
      <!--
        <ul class="dropdown-menu">
          <li>
            <a href="javascript:void(0);">User Management</a>
          </li>
          <li>
            <a href="javascript:void(0);">Group Management</a>
          </li>
          <li>
            <a href="javascript:void(0);">Role Management</a>
          </li>
          <li class="divider"></li>
          <li>
            <a href="javascript:void(0);"><i class="fa fa-power-off"></i> Clear</a>
          </li>
        </ul>
      -->
        <!-- end dropdown-menu-->

      </div>
      <!-- end projects dropdown -->

      <!-- pulled right: nav area -->
      <div class="pull-right">
        
        <!-- collapse menu button -->
        <div id="hide-menu" class="btn-header pull-right">
          <span> <a href="javascript:void(0);" data-action="toggleMenu" title="Collapse Menu"><i class="fa fa-reorder"></i></a> </span>
        </div>
        <!-- end collapse menu -->
        
        <!-- #MOBILE -->
        <!-- Top menu profile link : this shows only when top menu is active -->
        <ul id="mobile-profile-img" class="header-dropdown-list hidden-xs padding-5">
          <li class="">
            <a href="#" class="dropdown-toggle no-margin userdropdown" data-toggle="dropdown"> 
              <img src="{{asset('assets/img/avatars/1.png')}}" alt="{{{ Auth::user()->fullname }}}" class="online" />  
            </a>
            <ul class="dropdown-menu pull-right">
              <li>
                <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0"><i class="fa fa-cog"></i> Setting</a>
              </li>
              <li class="divider"></li>
              <li>
                <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0"> <i class="fa fa-user"></i> <u>P</u>rofile</a>
              </li>
              <li class="divider"></li>
              <li>
                <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0" data-action="toggleShortcut"><i class="fa fa-arrow-down"></i> <u>S</u>hortcut</a>
              </li>
              <li class="divider"></li>
              <li>
                <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0" data-action="launchFullscreen"><i class="fa fa-arrows-alt"></i> Full <u>S</u>creen</a>
              </li>
              <li class="divider"></li>
              <li>
                <a href="{{{ URL::action('user.logout') }}}" class="padding-10 padding-top-5 padding-bottom-5" data-action="userLogout"><i class="fa fa-sign-out fa-lg"></i> <strong><u>L</u>ogout</strong></a>
              </li>
            </ul>
          </li>
        </ul>

        <!-- logout button -->
        <div id="logout" class="btn-header transparent pull-right">
          <span> <a href="{{{ URL::action('user.logout') }}}" title="Sign Out" data-action="userLogout" data-logout-msg="You can improve your security further after logging out by closing this opened browser"><i class="fa fa-sign-out"></i></a> </span>
        </div>
        <!-- end logout button -->

        <!-- search mobile button (this is hidden till mobile view port) -->
        <div id="search-mobile" class="btn-header transparent pull-right">
          <span> <a href="javascript:void(0)" title="Search"><i class="fa fa-search"></i></a> </span>
        </div>
        <!-- end search mobile button -->

        <!-- input: search field -->
        <!-- <form action="search.html" class="header-search pull-right">
          <input id="search-fld"  type="text" name="param" placeholder="Find reports and more" data-autocomplete='[
          "ActionScript",
          "AppleScript",
          "Asp",
          "BASIC",
          "C",
          "C++",
          "Clojure",
          "COBOL",
          "ColdFusion",
          "Erlang",
          "Fortran",
          "Groovy",
          "Haskell",
          "Java",
          "JavaScript",
          "Lisp",
          "Perl",
          "PHP",
          "Python",
          "Ruby",
          "Scala",
          "Scheme"]'>
          <button type="submit">
            <i class="fa fa-search"></i>
          </button>
          <a href="javascript:void(0);" id="cancel-search-js" title="Cancel Search"><i class="fa fa-times"></i></a>
        </form> -->
        <!-- end input: search field -->

      </div>
      <!-- end pulled right: nav area -->

    </header>
    <!-- END HEADER -->

    <!-- Left panel : Navigation area -->
    <!-- Note: This width of the aside area can be adjusted through LESS variables -->
    <aside id="left-panel">

      <!-- User info -->
      <div class="login-info">
        <span> <!-- User image size is adjusted inside CSS, it should stay as it --> 
          
          <a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
            <img src="{{asset('assets/img/avatars/1.png')}}" alt="{{{ Auth::user()->fullname }}}" class="online" /> 
            <span>
              {{{ Auth::user()->fullname }}}
            </span>
            <i class="fa fa-angle-down"></i>
          </a> 
          
        </span>
      </div>
      <!-- end user info -->

      <!-- NAVIGATION : This navigation is also responsive

      To make this navigation dynamic please make sure to link the node
      (the reference to the nav > ul) after page load. Or the navigation
      will not initialize.
      -->
      <nav>@include('layouts.nav')</nav>
      
      <span class="minifyme" data-action="minifyMenu"> 
        <i class="fa fa-arrow-circle-left hit"></i> 
      </span>

    </aside>
    <!-- END NAVIGATION -->

    <!-- MAIN PANEL -->
    <div id="main" role="main">

      <!-- RIBBON -->
      <div id="ribbon">

        <span class="ribbon-button-alignment"> 
          <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true">
            <i class="fa fa-refresh"></i>
          </span> 
        </span>
        @if(Route::currentRouteName() == 'dashboard')
          {{ Breadcrumbs::render() }}
        @elseif(Route::currentRouteName() == 'denied')
          {{ Breadcrumbs::render() }}
        @else
         {{ Breadcrumbs::render('page',Route::currentRouteName()) }}
        @endif  
        <!-- You can also add more buttons to the
        ribbon for further usability

        Example below:

        <span class="ribbon-button-alignment pull-right">
        <span id="search" class="btn btn-ribbon hidden-xs" data-title="search"><i class="fa-grid"></i> Change Grid</span>
        <span id="add" class="btn btn-ribbon hidden-xs" data-title="add"><i class="fa-plus"></i> Add</span>
        <span id="search" class="btn btn-ribbon" data-title="search"><i class="fa-search"></i> <span class="hidden-mobile">Search</span></span>
        </span> -->

      </div>
      <!-- END RIBBON -->

     
      <!-- Content -->
      @yield('content')
      <!-- ./ content -->

    </div>
    <!-- END MAIN PANEL -->

    <!-- PAGE FOOTER -->
    <div class="page-footer">
      <div class="row">
        <div class="col-xs-12 col-sm-6">
          <span class="txt-color-white">Pacific Casino Hotel © 2015</span>
        </div>

        <div class="col-xs-6 col-sm-6 text-right hidden-xs">
          <div class="txt-color-white inline-block">
            <i class="txt-color-blueLight hidden-mobile">Last account activity <i class="fa fa-clock-o"></i> <strong>52 mins ago &nbsp;</strong> </i>
          </div>
        </div>
      </div>
    </div>
    <!-- END PAGE FOOTER -->

    <!-- SHORTCUT AREA : With large tiles (activated via clicking user name tag)
    Note: These tiles are completely responsive,
    you can add as many as you like
    -->
    <div id="shortcut">
      <ul>
        <li>
          <a href="{{ URL::action('user.profile') }}" class="jarvismetro-tile big-cubes @if (Route::currentRouteName() == 'user.profile') selected @endif bg-color-pinkDark"> <span class="iconbox"> <i class="fa fa-user fa-4x"></i> <span>My Profile</span> </span> </a>
        </li>
      </ul>
    </div>
    <!-- END SHORTCUT AREA -->

    <!--================================================== -->

    <!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
    <script data-pace-options='{ "restartOnRequestAfter": true }' src="{{asset('assets/js/plugin/pace/pace.min.js') }}"></script>

    <!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <script>
      if (!window.jQuery) {
        document.write('<script src="js/libs/jquery-2.0.2.min.js"><\/script>');
      }
    </script>

    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script>
      if (!window.jQuery.ui) {
        document.write('<script src="js/libs/jquery-ui-1.10.3.min.js"><\/script>');
      }
    </script>

    <!-- JS TOUCH : include this plugin for mobile drag / drop touch events
    <script src="js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script> -->

    {{ HTML::script('assets/js/plugin/pace/pace.min.js') }}
    <!-- BOOTSTRAP JS -->
    {{ HTML::script('assets/js/bootstrap/bootstrap.min.js') }}  
    <!-- CUSTOM NOTIFICATION -->
    {{ HTML::script('assets/js/notification/SmartNotification.min.js') }}  
    <!-- JARVIS WIDGETS -->
    {{ HTML::script('assets/js/smartwidgets/jarvis.widget.min.js') }}  
    <!-- EASY PIE CHARTS -->
    {{ HTML::script('assets/js/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js') }}  
    <!-- SPARKLINES -->
    {{ HTML::script('assets/js/plugin/sparkline/jquery.sparkline.min.js') }}  
    <!-- JQUERY VALIDATE -->
    {{ HTML::script('assets/js/plugin/jquery-validate/jquery.validate.min.js') }}  
    <!-- JQUERY MASKED INPUT -->
    {{ HTML::script('assets/js/plugin/masked-input/jquery.maskedinput.min.js') }}  
    <!-- JQUERY SELECT2 INPUT -->
    {{ HTML::script('assets/js/plugin/select2/select2.min.js') }}  
    <!-- JQUERY UI + Bootstrap Slider -->
    {{ HTML::script('assets/js/plugin/bootstrap-slider/bootstrap-slider.min.js') }}  
    <!-- browser msie issue fix -->
    {{ HTML::script('assets/js/plugin/msie-fix/jquery.mb.browser.min.js') }}  
    <!-- FastClick: For mobile devices -->
    {{ HTML::script('assets/js/plugin/fastclick/fastclick.min.js') }}  

    <!--[if IE 8]>

    <h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>

    <![endif]-->

    <!-- Demo purpose only -->
    <!-- {{ HTML::script('assets/js/demo.min.js') }}  -->

    <!-- MAIN APP JS FILE -->
    {{ HTML::script('assets/js/app.min.js') }}  
    
    <!-- PAGE RELATED PLUGIN(S) -->
    
    <!-- Flot Chart Plugin: Flot Engine, Flot Resizer, Flot Tooltip -->
    {{ HTML::script('assets/js/plugin/flot/jquery.flot.cust.min.js') }}  
    {{ HTML::script('assets/js/plugin/flot/jquery.flot.resize.min.js') }}  
    {{ HTML::script('assets/js/plugin/flot/jquery.flot.tooltip.min.js') }}  
    
    <!-- Vector Maps Plugin: Vectormap engine, Vectormap language -->
    {{ HTML::script('assets/js/plugin/vectormap/jquery-jvectormap-1.2.2.min.js') }}  
    {{ HTML::script('assets/js/plugin/vectormap/jquery-jvectormap-world-mill-en.js') }}  
    
    <!-- Full Calendar -->
    {{ HTML::script('assets/js/plugin/fullcalendar/jquery.fullcalendar.min.js') }}  

    <!-- PAGE RELATED PLUGIN(S) -->
    {{ HTML::script('assets/js/plugin/datatables/jquery.dataTables.min.js') }}  
    {{ HTML::script('assets/js/plugin/datatables/dataTables.colVis.min.js') }}  
    {{ HTML::script('assets/js/plugin/datatables/dataTables.tableTools.min.js') }}  
    {{ HTML::script('assets/js/plugin/datatables/dataTables.bootstrap.min.js') }} 
    {{ HTML::script('assets/js/plugin/datatable-responsive/datatables.responsive.min.js') }} 
    {{ HTML::script('assets/js/custom.js') }}
    {{ HTML::script('assets/js/plugin/bootstrap-tags/bootstrap-tagsinput.min.js') }}
    {{ HTML::script('assets/js/plugin/maxlength/bootstrap-maxlength.min.js') }}  
    {{ HTML::script('assets/js/moment.min.js') }}
    {{ HTML::script('assets/js/daterangepicker.js') }}
    {{ HTML::script('assets/js/autoNumeric.js') }}
    {{ HTML::script('assets/js/plugin/knob/jquery.knob.min.js') }}

    {{ HTML::script('assets/js/libs/pointsys.js'); }}
    @yield('scripts')
  </body>

</html>