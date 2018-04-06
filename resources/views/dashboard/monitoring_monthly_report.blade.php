@extends('layouts.master')
@section('content')
    <section>
        <div class="blank">
            <!--To show white background over the gray background-->
            <div class="blank-page">
                <div class="row">
                    <div class="col-md-6">
                        <label for="startdatepicker">{{ trans('allstr.start_date') }}</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control datepicker" id="startdatepicker" placeholder="YYYY-MM-DD" autocomplete='off'>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="enddatepicker">{{ trans('allstr.end_date') }}</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control datepicker" id="enddatepicker" placeholder="YYYY-MM-DD" autocomplete='off'>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-5 col-md-offset-7 ">
                        <button class='btn btn-outline-danger pull-right' id="btn_cancel" >
                            <i class='fa fa-refresh fa-lg' aria-hidden='true'></i>
                            {{trans('allstr.cancel')}}
                        </button>
                        <button class="btn btn-outline-info pull-right" name="" id="edit_user_btn" style="margin-right: 0.5em;">
                            <i class="fa fa-search fa-lg" aria-hidden="true"></i>
                            {{ trans('allstr.show_result') }}
                        </button>
                    </div>
                </div>

            </div><!-- ./class blank-page -->
        </div><!-- ./class blank -->



        @push('script')
            {{--<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.standalone.min.css" rel="stylesheet">--}}
            {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>--}}
            <script>
                $(function() {
                    // $('#datepicker').datepicker();

                    $('#startdatepicker').datepicker({
                        format: 'yyyy-mm-dd',
                        //todayHighlight: true,
                        autoclose: true,
                    });
                    $('#enddatepicker').datepicker({
                        format: 'yyyy-mm-dd',
                        //todayHighlight: true,
                        autoclose: true,
                    });

                    // Cancel & Reload
                    $(document).on('click', "#btn_cancel", function(){
                        location.reload();
                    });

                });

            </script>
        @endpush

    </section>
@endsection