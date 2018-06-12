<!DOCTYPE html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="keyword" content="html5, css, bootstrap, property, real-estate theme , bootstrap template">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> {{ trans('allstr.salt') }} </title>
    <script type="application/x-javascript">
        addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); }
    </script>
    <!-- CSS -->
    <link href="{{ URL::asset('vendors/minimalAdmin/css/bootstrap.min.css') }}" rel='stylesheet' type='text/css' />
    <!-- Custom Theme files -->
    <link href="{{ URL::asset('vendors/minimalAdmin/css/style.css') }}" rel='stylesheet' type='text/css' />
    <link href="{{ URL::asset('vendors/minimalAdmin/css/font-awesome.css') }}" rel="stylesheet">

    <!-- JS -->
    <script src="{{ URL::asset('vendors/minimalAdmin/js/jquery.min.js') }}"> </script>
    <script src="{{ URL::asset('vendors/minimalAdmin/js/bootstrap.min.js') }}"> </script>

    <!-- Mainly scripts -->
    <script src="{{ URL::asset('vendors/minimalAdmin/js/jquery.metisMenu.js') }}"></script>
    <script src="{{ URL::asset('vendors/minimalAdmin/js/jquery.slimscroll.min.js') }}"></script>
    <!-- Custom and plugin javascript -->
    <link href="{{ URL::asset('vendors/minimalAdmin/css/custom.css') }}" rel="stylesheet">
    <script src="{{ URL::asset('vendors/minimalAdmin/js/custom.js') }}"></script>
    <script src="{{ URL::asset('vendors/minimalAdmin/js/screenfull.js') }}"></script>
    <script src="{{ URL::asset('vendors/minimalAdmin/js/screenfull.js') }}"></script>
    <!-- my custom CSS & JS style -->

    <!-- datetime picker ---->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.standalone.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>

    <!-- DataTable ---->
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    <link href="{{ URL::asset('vendors/custom/custom.css') }}" rel="stylesheet">
    {{--<script src="{{ URL::asset('vendors/custom/custom.js') }}"></script>--}}

    @push('script')
    <script>
        $(function () {
            $('#supported').text('Supported/allowed: ' + !!screenfull.enabled);

            if (!screenfull.enabled) {
                return false;
            }
            $('#toggle').click(function () {
                screenfull.toggle($('#container')[0]);
            });
        });
    </script>
    @endpush

    </head>
    <body>
    <div id="wrapper">
        <!-- header and navigation -->
        @include('layouts.header_nav')

        <!-- body content -->
        <div id="page-wrapper" class="gray-bg dashbard-1" style="margin-top: 50px">
            <div class="content-main">
                @yield('content')
            </div>
            <div class="clearfix"></div>
        </div>

        <!-- footer -->
        @include('layouts.footer')
    </div>

    @stack('script')
    </body>

</html>
