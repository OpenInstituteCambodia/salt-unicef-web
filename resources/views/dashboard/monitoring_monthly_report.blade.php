@extends('layouts.master')
@section('content')
    <section>
        <div class="blank">
            <!--To show white background over the gray background-->
            <div class="blank-page">
                <h3 align="center"><strong>{{ trans('allstr.monitoring_report')}}</strong></h3><hr>
                <div class="clearfix"></div>
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
                        <button class="btn btn-outline-info pull-right" name="monitor_submit_btn" id="monitor_submit_btn" style="margin-right: 0.5em;">
                            <i class="fa fa-search fa-lg" aria-hidden="true"></i>
                            {{ trans('allstr.show_result') }}
                        </button>
                    </div>
                </div>
                <div class="clearfix"></div>
                <!-- show report result --->
                <hr>
                <table class='table table-striped responsive' id='monitor_measurement_tbl' cellspacing='0' width='100%'>
                    <thead>
                    <tr>
                        <th class='text-center'> {{ trans('allstr.no') }} </th>
                        <th class='text-center'> {{ trans('allstr.facility_name') }} </th>
                        <th class='text-center'> {{ trans('allstr.number_of_inspections') }} </th>
                        <th class='text-center'> {{ trans('allstr.%_of_samples_within_0_15ppm') }} </th>
                        <th class='text-center'> {{ trans('allstr.%_of_samples_within_15_30ppm') }} </th>
                        <th class='text-center'> {{ trans('allstr.%_of_samples_within_30_60ppm') }} </th>
                        <th class='text-center'> {{ trans('allstr.%_of_samples_over_60ppm') }} </th>
                        <th class='text-center'> {{ trans('allstr.warning_received') }} </th>
                    </tr>
                    </thead>
                </table>
            </div><!-- ./class blank-page -->
        </div><!-- ./class blank -->



        @push('script')
            {{--<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.standalone.min.css" rel="stylesheet">--}}
            {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>--}}
            <script>
                $(function() {
                    // global csrf token variable
                    var token = "{{ csrf_token() }}";

                    $('#monitor_measurement_tbl').DataTable({
                        deferRender:    true,
                        scroller:       true
                    });


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

                    /* Submit Report */
                    $(document).on('click', '#monitor_submit_btn', function() {
                        var start_date_val = $('#startdatepicker').val();
                        console.log('start' + start_date_val);
                        var end_date_val = $('#enddatepicker').val();
                        console.log('end' + end_date_val);
                        $('#monitor_measurement_tbl').DataTable( {
                            destroy: true,
                            "ajax": {
                                type: "POST",
                                url: "{{ route('inspectionreport') }}",
                                data: {_token: token, start_date: start_date_val, end_date: end_date_val},
                                cache: false,
                                dataSrc: 'data'
                            },
                            "columns": [
                                { "data": "No" },
                                { "data": "facility_name" },
                                { "data": "number_inspection" },
                                { "data": "percentage_of_samples_0_15ppm" },
                                { "data": "percentage_of_samples_15_30ppm" },
                                { "data": "percentage_of_samples_30_60ppm" },
                                { "data": "percentage_of_samples_over_60ppm" },
                                { "data": "total_warning" }
                            ],
                            deferRender:    true,
                            scroller:       true
                        } );
//                    }
                        $("#monitor_measurement_tbl").show();
                        return false;
                    });


                });

            </script>
        @endpush

    </section>
@endsection