@extends('layouts.master')
@section('content')
<section>
    <div class="blank">
        <!--To show white background over the gray background-->
        <div class="blank-page">
            <!-- show report form --->
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
                    <button class="btn btn-outline-info pull-right" name="producer_submit_btn" id="producer_submit_btn" style="margin-right: 0.5em;">
                        <i class="fa fa-search fa-lg" aria-hidden="true"></i>
                        {{ trans('allstr.show_result') }}
                    </button>
                </div>
            </div>
            <div class="clearfix"></div>
            <!-- show report result --->
            <hr>
            <table class='table table-striped responsive' id='prod_measurement_tbl' cellspacing='0' width='100%'>
                <thead>
                    <tr>
                        <th class='text-center'> {{ trans('allstr.no') }} </th>
                        <th class='text-center'> {{ trans('allstr.facility_name') }} </th>
                        <th class='text-center'> {{ trans('allstr.iodized_salt_produced') }} </th>
                        <th class='text-center'> {{ trans('allstr.potassium_used') }} </th>
                        <th class='text-center'> {{ trans('allstr.total_number_days') }} </th>
                        <th class='text-center'> {{ trans('allstr.%_of_days_producing_0_15ppm') }} </th>
                        <th class='text-center'> {{ trans('allstr.%_of_days_producing_15_30ppm') }} </th>
                        <th class='text-center'> {{ trans('allstr.%_of_days_producing_30_50ppm') }} </th>
                        <th class='text-center'> {{ trans('allstr.%_of_days_producing_50_60ppm') }} </th>
                        <th class='text-center'> {{ trans('allstr.%_of_days_producing_over_60ppm') }} </th>
                        <th class='text-center'> {{ trans('allstr.ratio_iodized_salt_produced_over_potassium_used') }} </th>
                    </tr>
                </thead>
                <tbody id="tbody"></tbody>
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

                $('#prod_measurement_tbl').DataTable( {
                    deferRender:    true,
                    scroller:       true,
//                    scrollY:       true,
//                    scrollX:        true,
//                    scrollCollapse: true,
////                    paging:         false,
//                    fixedColumns:   {
//                        leftColumns: 2
//                    }
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
                    // $(location).attr("href", '/productionreportdisp');
                });

                /* Submit Report */
                $(document).on('click', '#producer_submit_btn', function() {
                    var start_date_val = $('#startdatepicker').val();
                    var end_date_val = $('#enddatepicker').val();
                    $('#prod_measurement_tbl').DataTable( {
                            destroy: true,
                            "ajax": {
                                type: "POST",
                                url: "{{ route('productionreport') }}",
                                data: {_token: token, start_date: start_date_val, end_date: end_date_val},
                                cache: false,
                                dataSrc: 'data'
                            },
                            "columns": [
                                { "data": "No" },
                                { "data": "facility_name" },
                                { "data": "iodized_salt_produced" },
                                { "data": "potassium_used" },
                                { "data": "total_number_days" },
                                { "data": "percentage_of_days_producing_0_15ppm" },
                                { "data": "percentage_of_days_producing_15_30ppm" },
                                { "data": "percentage_of_days_producing_30_50ppm" },
                                { "data": "percentage_of_days_producing_50_60ppm" },
                                { "data": "percentage_of_days_producing_over_60ppm" },
                                { "data": "ratio_iodized_salt_produced_over_potassium_used" }
                            ],

                            deferRender:    true,
                            scroller:       true,


                        } );
//                    }
                    $("#prod_measurement_tbl").show();
                    return false;
                });


            });

        </script>
    @endpush

</section>
@endsection