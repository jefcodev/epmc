<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>@yield('title','EPMC')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN PLUGIN CSS -->
    <link href="{{ asset('back/assets/plugins/pace/pace-theme-flash.css') }}" rel="stylesheet" type="text/css" media="screen" />
    <link href="{{ asset('back/assets/plugins/bootstrapv3/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('back/assets/plugins/bootstrapv3/css/bootstrap-theme.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('back/assets/plugins/animate.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('back/assets/plugins/jquery-scrollbar/jquery.scrollbar.css') }}" rel="stylesheet" type="text/css" />

    <!-- Sweetalert Css -->
    <link href="{{ asset('back/assets/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet" />

    <!-- END PLUGIN CSS -->
    <!-- BEGIN CORE CSS FRAMEWORK -->
    <link href="{{ asset('back/webarch/css/webarch.css') }}" rel="stylesheet" type="text/css" />
    @yield('css')
    <!-- END CORE CSS FRAMEWORK -->
  </head>
  <!-- END HEAD -->
  <!-- BEGIN BODY -->
  <body class="error-body no-top">
    <!-- BEGIN HEADER -->

    @yield('content')
     
    <!-- END CONTAINER -->
    <!-- END CONTAINER -->
    <script src="{{ asset('back/assets/plugins/pace/pace.min.js' ) }}" type="text/javascript"></script>
    <!-- BEGIN JS DEPENDECENCIES-->
    <script src="{{ asset('back/assets/plugins/jquery/jquery-1.11.3.min.js' ) }}" type="text/javascript"></script>
    <script src="{{ asset('back/assets/plugins/bootstrapv3/js/bootstrap.min.js' ) }}" type="text/javascript"></script>
    <script src="{{ asset('back/assets/plugins/jquery-block-ui/jqueryblockui.min.js' ) }}" type="text/javascript"></script>
    <script src="{{ asset('back/assets/plugins/jquery-unveil/jquery.unveil.min.js' ) }}" type="text/javascript"></script>
    <script src="{{ asset('back/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js' ) }}" type="text/javascript"></script>
    <script src="{{ asset('back/assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js' ) }}" type="text/javascript"></script>
    <script src="{{ asset('back/assets/plugins/jquery-validation/js/jquery.validate.min.js' ) }}" type="text/javascript"></script>
    <script src="{{ asset('back/assets/plugins/bootstrap-select2/select2.min.js' ) }}" type="text/javascript"></script>
        <!-- SweetAlert Plugin Js -->
    <script src="{{ asset('back/assets/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <!-- END CORE JS DEPENDECENCIES-->
    <!-- BEGIN CORE TEMPLATE JS -->
    <script src="{{ asset('back/webarch/js/webarch.js') }}" type="text/javascript"></script>
    <script src="{{ asset('back/assets/js/chat.js') }}" type="text/javascript"></script>
    @yield('js')
    <!-- END CORE TEMPLATE JS -->
  </body>
</html>