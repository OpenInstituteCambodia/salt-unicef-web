<!DOCTYPE html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="keyword" content="html5, css, bootstrap, property, real-estate theme , bootstrap template">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title> Salt </title>
        <!-- Bootstrap -->
        {{--<link href="{{ URL::asset('vendors/bootstrap4.0/css/bootstrap.min.css') }}" rel="stylesheet">--}}

        <!-- Bootstrap Core CSS -->
        <link href="{{URL::asset('vendors/ElaAdmin/css/lib/bootstrap/bootstrap.min.css')}}" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="{{URL::asset('vendors/ElaAdmin/css/lib/calendar2/semantic.ui.min.css')}}" rel="stylesheet">
        <link href="{{URL::asset('vendors/ElaAdmin/css/lib/calendar2/pignose.calendar.min.css')}}" rel="stylesheet">
        <link href="{{URL::asset('vendors/ElaAdmin/css/lib/owl.carousel.min.css')}}" rel="stylesheet">
        <link href="{{URL::asset('vendors/ElaAdmin/css/lib/owl.theme.default.min.css')}}" rel="stylesheet">
        <link href="{{URL::asset('vendors/ElaAdmin/css/helper.css')}}" rel="stylesheet">
        <link href="{{URL::asset('vendors/ElaAdmin/css/style.css')}}" rel="stylesheet">

        <link href="{{ URL::asset('vendors/custom-css/custom.css') }}" rel="stylesheet">

    </head>
    <body>
        @include('layouts.header')
        @include('layouts.navigation')

        @yield('content')
        <!-- footer content -->
        @include('layouts.footer')
        <!-- /footer content -->

        <!-- All Jquery -->
        <script src="{{ URL::asset('vendors/ElaAdmin/js/lib/jquery/jquery.min.js')}}"></script>
        <!-- Bootstrap tether Core JavaScript -->
        <script src="{{ URL::asset('vendors/ElaAdmin/js/lib/bootstrap/js/popper.min.js')}}"></script>
        <script src="{{ URL::asset('vendors/ElaAdmin/js/lib/bootstrap/js/bootstrap.min.js')}}"></script>
        <!-- slimscrollbar scrollbar JavaScript -->
        <script src="{{ URL::asset('vendors/ElaAdmin/js/lib/metismenu/jquery.slimscroll.js')}}"></script>

        <!--Menu sidebar -->
        <script src="{{ URL::asset('vendors/ElaAdmin/js/sidebarmenu.js')}}"></script>
        <!--stickey kit -->
        <script src="{{ URL::asset('vendors/ElaAdmin/js/lib/sticky-kit-master/dist/sticky-kit.min.js')}}"></script>

        <!-- Amchart -->
        {{--<script src="{{ URL::asset('vendors/ElaAdmin/js/lib/morris-chart/raphael-min.js')}}"></script>--}}
        {{--<script src="{{ URL::asset('vendors/ElaAdmin/js/lib/morris-chart/morris.js')}}"></script>--}}
        {{--<script src="{{ URL::asset('vendors/ElaAdmin/js/lib/morris-chart/dashboard1-init.js')}}"></script>--}}
        <script src="{{ URL::asset('vendors/ElaAdmin/js/lib/calendar-2/moment.latest.min.js')}}"></script>
        <!-- scripit init-->
        <script src="{{ URL::asset('vendors/ElaAdmin/js/lib/calendar-2/semantic.ui.min.js')}}"></script>

        <!-- scripit init-->
        <script src="{{ URL::asset('vendors/ElaAdmin/js/lib/calendar-2/prism.min.js')}}"></script>

        <!-- scripit init-->
        <script src="{{ URL::asset('vendors/ElaAdmin/js/lib/calendar-2/pignose.calendar.min.js')}}"></script>

        <!-- scripit init-->
        <script src="{{ URL::asset('vendors/ElaAdmin/js/lib/calendar-2/pignose.init.js')}}"></script>
        <script src="{{ URL::asset('vendors/ElaAdmin/js/lib/owl-carousel/owl.carousel.min.js')}}"></script>
        <script src="{{ URL::asset('vendors/ElaAdmin/js/lib/owl-carousel/owl.carousel-init.js')}}"></script>
        <script src="{{ URL::asset('vendors/ElaAdmin/js/scripts.js')}}"></script>

        <!-- scripit init-->
        <script src="{{ URL::asset('vendors/ElaAdmin/js/custom.min.js')}}"></script>

        @stack('script')
    </body>

</html>
