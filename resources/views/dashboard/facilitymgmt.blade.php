@extends('layouts.master')
@section('content')

    <div class="blank">
        <!--To show white background over the gray background-->
        <div class="blank-page">
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-outline-primary" id="add_new_faci_trigger">
                        <i class="fa fa-plus fa-lg" aria-hidden="true"></i>
                        {{ trans('allstr.add_facility') }}
                    </button>
                    <hr>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class='table table-striped responsive' id='facil_mgmt_tbl' cellspacing='0' width='100%'>
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">{{ trans('allstr.facility_ref_id') }}</th>
                                <th class="text-center">{{ trans('allstr.name') }}</th>
                                <th class="text-center">{{ trans('allstr.lat') }}</th>
                                <th class="text-center">{{ trans('allstr.long') }}</th>
                                <th class="text-center">{{ trans('allstr.action') }}</th>
                            </tr>
                            </thead>
                            <tbody id="tbody">
                            @if(!empty($all_facilities))
                                <?php $i=0; ?>
                                @foreach ($all_facilities as $each_facility)
                                    <?php
                                    $i=$i+1;
                                    ?>
                                    <tr>
                                        <td class="text-center"> {{ $i }} </td>
                                        <td> {{ $each_facility->facility_ref_id  }} </td>
                                        <td> {{ $each_facility->facility_name }} </td>
                                        <td> {{ $each_facility->Latitude }} </td>
                                        <td> {{ $each_facility->Longitude }} </td>

                                        <td>
                                            <!-- Edit Sensor Trigger Record Button -->
                                            <button class="btn btn-outline-success" name="{{ $each_facility->id }}" id="edit_faci_btn">
                                                <i class="fa fa-pencil fa-lg" aria-hidden="true"></i>
                                                {{ trans('allstr.edit') }}
                                            </button>
                                            <!-- Delete Sensor Trigger Record Button -->
                                            <button class="btn btn-outline-danger" name="{{ $each_facility->id }}" id="delete_faci_btn">
                                                <i class="fa fa-trash-o fa-lg" aria-hidden="true"></i>
                                                {{ trans('allstr.delete') }}
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div><!-- ./class blank-page -->
    </div><!-- ./class blank -->

    <!-- Add New Facility Modal -->
    <div class="modal fade" id="modal_add_new_faci" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title text-primary"> {{ trans('allstr.add_facility') }} </span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="fa fa-times-circle-o fa-lg text-red"></span>
                    </button>
                </div>
                <form>
                    <div class='modal-body'>
                        <div class="form-group">
                            <label for="faci_ref_id" class="col-md-4">{{ trans('allstr.facility_ref_id') }}<i class="text-red">*</i></label>
                            <div class="col-md-6">
                                <input id="faci_ref_id" type="text" class="form-control" name="faci_ref_id" autofocus autocomplete='off'>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group">
                            <label for="faci_name" class="col-md-4">{{ trans('allstr.name') }}<i class="text-red">*</i></label>
                            <div class="col-md-6">
                                <input id="faci_name" type="text" class="form-control" name="faci_name" required autocomplete='off'>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group">
                            <label for="faci_latitude" class="col-md-4">{{ trans('allstr.lat') }}</label>
                            <div class="col-md-6">
                                <input id="faci_latitude" type="text" class="form-control" name="faci_latitude"  autocomplete='off'>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group">
                            <label for="faci_longitude" class="col-md-4">{{ trans('allstr.long') }}</label>
                            <div class="col-md-6">
                                <input id="faci_longitude" type="text" class="form-control" name="faci_longitude"  autocomplete='off'>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                    </div><!-- /.modal-body -->
                    <div class='modal-footer'>
                        <button class='btn btn-outline-danger' data-dismiss='modal' id="add_new_faci_cancel">
                            <i class='fa fa-refresh fa-lg' aria-hidden='true'></i>
                            {{trans('allstr.cancel')}}
                        </button>
                        <button class='btn btn-outline-primary' id="add_new_faci_save">
                            <i class='fa fa-floppy-o fa-lg' aria-hidden='true'></i>
                            {{ trans('allstr.save')  }}
                        </button>
                    </div><!-- /.modal-footer -->
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Show confirm delete dialog -->
    <div class="modal fade" id="modal_delete_faci" data-backdrop="static" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title"><b>{{ trans('allstr.dialog_confirm') }}</b></h3>
                </div>
                <div class="modal-body">
                    <h4>
                        {{ trans('allstr.action_confirm_question') }} <br /><br />
                        {{ trans('allstr.action_confirm_yes') }} <br />
                        {{ trans('allstr.action_confirm_no') }} <br /><br />
                    </h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-info" data-dismiss='modal'>
                        <i class="fa fa-refresh fa-lg" aria-hidden="true"></i>
                        {{ trans('allstr.cancel') }} </button>
                    <button type="button" class="btn btn-outline-danger" id="btn_delete_yes">
                        <i class="fa fa-trash-o fa-lg" aria-hidden="true"></i>
                        {{ trans('allstr.delete') }}</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Edit Facility Info Modal -->
    <div class="modal fade" id="modal_edit_faci" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">{{ trans('allstr.modal_edit_faci') }}</h4>
                </div>
                <span id='faci_info_detail'>
                    {{ csrf_field() }}
                </span>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    @push('script')
        <script src="{!! URL::asset('vendors/custom/custom.js') !!}"></script>
        <script>
            $(function()
            {
                // global csrf token variable
                var token = "{{ csrf_token() }}";

                /* Initial Data table */
                $('#facil_mgmt_tbl').DataTable( {
                    deferRender:    true,
                    scroller:       true,
                } );

                /* ------ Add/Save new Facility -----*/
                /* Show Add New Facility Modal */
                $(document).on('click', "#add_new_faci_trigger", function(){
                    //$("#add_new_user_trigger").click(function(){
                    $('#modal_add_new_faci').modal('show');
                    return false;
                });

                // Cancel the add new Facility form
                $(document).on('click', "#add_new_faci_cancel", function(){
                    // $("#add_new_user_cancel").click(function() {
                    location.reload();

                });

                /* Save New Facility */
                $(document).on('click', "#add_new_faci_save", function(){
                    //$("#add_new_user_save").click(function() {
                    var txtFaciRef = $('#faci_ref_id').val();
                    var txtFaciName = $('#faci_name').val();
                    var txtFaciLat = $('#faci_latitude').val();
                    var txtFaciLong = $('#faci_longitude').val();

                    // post data to server using ajax
                    $.ajax({
                        type: "POST",
                        url: "{{ url('/addnewfaci') }}",
                        data: {_token: token, faciRef: txtFaciRef, faciName: txtFaciName, faciLat: txtFaciLat, faciLong: txtFaciLong},
                        cache: false,
                        success: function(result)
                        {
                            location.reload();
                        },
                        error: function(e)
                        {
                            console.log(e);
                        }
                    });
                    return false;
                });
                /* ------ ./Add/Save new Facility -----*/

                /* ---- Soft Delete Facility Info ---- */
                $(document).on('click', '#delete_faci_btn', function(){
                    var btn_delete_val = $(this).attr('name');
                    $('#modal_delete_faci').modal('show');
                    $('#btn_delete_yes').click(function(e){
                        $.ajax({
                            type: "POST",
                            url: "{{ url('/deletefaci') }}",
                            data: {_token: token, delete_val: btn_delete_val},
                            cache: false,
                            success: function()
                            {
                                location.reload();
                            }
                        });
                        return false;
                    });
                    return false;
                });
                /* ---- ./Delete Sensor Info ---- */

                /* ---- Display Edit data & Save Edit data ----- */
                $(document).on('click', '#edit_faci_btn', function(){
                    var btn_val = $(this).attr('name');
                    $.ajax({
                        type: "POST",
                        url: "{{ url('/faciinfo') }}",
                        data: {_token: token, id: btn_val},
                        cache: false,
                        success: function(result)
                        {
                            $("#faci_info_detail").html(result).show();
                            $('#modal_edit_faci').modal('show');
                        }
                    });
                    return false;
                });

                /* Save Edited Facility data */
                $(document).on('click', '#save_faci_btn', function() {
                    var txtFaciRef = $('#edit_faci_ref_id').val();
                    var txtFaciName = $('#edit_faci_name').val();
                    var txtFaciLat = $('#edit_faci_lat').val();
                    var txtFaciLong = $('#edit_faci_long').val();
                    var txt_id = $('#save_faci_btn').attr('name');

                    // post data to server using ajax
                    $.ajax({
                        type: "POST",
                        url: "{{ url('/savefacidata') }}",
                        data: {_token: token, faciRef: txtFaciRef, faciName: txtFaciName, faciLat: txtFaciLat, faciLong: txtFaciLong, fid:txt_id},
                        cache: false,
                        success: function(result)
                        {
                            location.reload();
                        },
                        error: function(e)
                        {
                            console.log(e);
                        }
                    });
                    return false;
                });
                /* ---- ./Display Edit data & Save Edit data ----- */

            });

        </script>
    @endpush

@endsection