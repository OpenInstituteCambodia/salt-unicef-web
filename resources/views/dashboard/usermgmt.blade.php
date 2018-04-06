@extends('layouts.master')
@section('content')
    <div class="blank">
        <!--To show white background over the gray background-->
        <div class="blank-page">
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-outline-primary" id="add_new_user_trigger">
                        <i class="fa fa-plus fa-lg" aria-hidden="true"></i>
                        {{ trans('allstr.add_user') }}
                    </button>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table responsive" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">{{ trans('allstr.name') }}</th>
                                <th class="text-center">{{ trans('allstr.user_email') }}</th>
                                <th class="text-center">{{ trans('allstr.user_role') }}</th>
                                <th class="text-center">{{ trans('allstr.facility_name') }}</th>
                                <th class="text-center">{{ trans('allstr.action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($all_users))
                                <?php $i=0; ?>
                                @foreach ($all_users as $each_user)
                                    <?php
                                    $i=$i+1;
                                    // if($i%2!=0) echo "<tr class='table-warning'>";
                                    // else echo "<tr>";
                                    ?>
                                    <tr>
                                        <td class="text-center"> {{ $i }} </td>
                                        <td> {{ $each_user->name }} </td>
                                        <td> {{ $each_user->email }} </td>
                                        <td>
                                            @if ($each_user->role == 1) {{ trans('allstr.admin') }}
                                            @elseif ($each_user->role == 2) {{ trans('allstr.producer') }}
                                            @else {{ trans('allstr.monitor') }}
                                            @endif
                                        </td>
                                        <td>
                                            @if(!empty($each_user->facility_id)) {{ $each_user->facility_name }}
                                            @endif
                                        </td>
                                        <td>
                                            <!-- Edit Sensor Trigger Record Button -->
                                            <button class="btn btn-outline-success" name="{{ $each_user->id }}" id="edit_user_btn">
                                                <i class="fa fa-pencil fa-lg" aria-hidden="true"></i>
                                                {{ trans('allstr.edit') }}
                                            </button>
                                            <!-- Delete Sensor Trigger Record Button -->
                                            <button class="btn btn-outline-danger" name="{{ $each_user->id }}" id="delete_user_btn">
                                                <i class="fa fa-trash-o fa-lg" aria-hidden="true"></i>
                                                {{ trans('allstr.delete') }}
                                            </button>
                                        </td>
                                    </tr>

                                    {{--@if (App::getLocale()=='km')--}}
                                    {{--<option value="{{ $item->PROCODE }}">{{ $item->PROVINCE_KH }}</option>--}}
                                    {{--@else--}}
                                    {{--<option value="{{ $item->PROCODE }}">{{ $item->PROVINCE }}</option>--}}
                                    {{--@endif--}}
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div><!-- ./class blank-page -->
    </div><!-- ./class blank -->

    <!-- Add New User Modal -->
    <div class="modal fade" id="modal_add_new_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title text-primary"> {{ trans('allstr.add_user') }} </span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="fa fa-times-circle-o fa-lg text-red"></span>
                    </button>
                </div>
                <form>
                <div class='modal-body'>
                    <div class="form-group">
                        <label for="name" class="col-md-4">{{ trans('allstr.name') }}</label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus autocomplete='off'>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group">
                        <label for="email" class="col-md-4">{{ trans('allstr.user_email') }}</label>
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete='off'>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group">
                        <label for="password" class="col-md-4">{{ trans('allstr.password') }}</label>
                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" id="pwd" required>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    {{--<div class="form-group">--}}
                        {{--<label for="password-confirm" class="col-md-4">{{ trans('allstr.password_confirm') }}</label>--}}
                        {{--<div class="col-md-6">--}}
                            {{--<input id="password-confirm" type="password" class="form-control" name="password_confirmation" id="pwd_confirm" required>--}}
                        {{--</div>--}}
                        {{--<br><span id="message" class="help-block">dfdsfdsf</span>--}}
                    {{--</div>--}}
                    {{--<div class="clearfix"></div>--}}

                    <div class="form-group">
                        <label for="role-option" class="col-md-4">{{ trans('allstr.user_role') }}</label>
                        <div class="col-md-6 styled-select">
                            <select id="role_selected" autocomplete='off'>
                                <option value="0" selected>{{ trans('allstr.select_user_option') }}</option>
                                <option value="1">{{ trans('allstr.admin') }}</option>
                                <option value="2">{{ trans('allstr.producer') }}</option>
                                <option value="3">{{ trans('allstr.monitor') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="form-group" id="div_select_facility">
                        <label for="facility-option" class="col-md-4">{{ trans('allstr.facility') }}</label>
                        <div class="col-md-6 styled-select">
                            <select id="facility_selected" autocomplete='off'>
                                <option value="0" selected>{{ trans('allstr.select_facility_option') }}</option>
                                @foreach($facilities as $facility)
                                    <option value="{{ $facility->id }}">{{ $facility->facility_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                </div><!-- /.modal-body -->
                <div class='modal-footer'>
                    <button class='btn btn-outline-danger' data-dismiss='modal' id="add_new_user_cancel">
                        <i class='fa fa-refresh fa-lg' aria-hidden='true'></i>
                        {{trans('allstr.cancel')}}
                    </button>
                    <button class='btn btn-outline-primary' id="add_new_user_save">
                        <i class='fa fa-floppy-o fa-lg' aria-hidden='true'></i>
                        {{ trans('allstr.save')  }}
                    </button>
                </div><!-- /.modal-footer -->
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Show confirm delete dialog -->
    <div class="modal fade" id="modal_delete_user" data-backdrop="static" tabindex="-1" role="dialog">
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

    <!-- Edit User Info Modal -->
    <div class="modal fade" id="modal_edit_user" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">{{ trans('allstr.modal_edit_user') }}</h4>
                </div>
                <span id='user_info_detail'>
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

                /* ------ Add/Save new User -----*/
                $("#div_select_facility").hide();

                // if role = producer then show facility select option
                $(document).on('change', "#role_selected", function(){
                //$("#role_selected").change(function(){
                    if($(this).val() == 2){
                        $("#div_select_facility").show();
                    }
                    else{
                        // reset selected option
                        $('#facility_selected').prop('selectedIndex',0);
                        // hide facility div
                        $("#div_select_facility").hide();
                    }
                });

                /* Show Add New User Modal */
                $(document).on('click', "#add_new_user_trigger", function(){
                //$("#add_new_user_trigger").click(function(){
                    $('#modal_add_new_user').modal('show');
                    return false;
                });

                // Cancel to save new user
                $(document).on('click', "#add_new_user_cancel", function(){
                // $("#add_new_user_cancel").click(function() {
                    location.reload();

                });

                /* Save New User */
                $(document).on('click', "#add_new_user_save", function(){
                //$("#add_new_user_save").click(function() {
                    var txtName = $('#name').val();
                    var txtEmail = $('#email').val();
                    var txtPassword = $('#password').val();
                    var roleOption = $('#role_selected').val();
                    var facOption = $('#facility_selected').val();

                    // post data to server using ajax
                    $.ajax({
                        type: "POST",
                        url: "{{ url('/addnewuser') }}",
                        data: {_token: token, name: txtName, email: txtEmail, pwd: txtPassword, role: roleOption, facil: facOption},
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
                /* ------ ./Add/Save new User -----*/

                /* ---- Soft Delete User Info ---- */
                $(document).on('click', '#delete_user_btn', function(){
                    var btn_delete_val = $(this).attr('name');
                    $('#modal_delete_user').modal('show');
                    $('#btn_delete_yes').click(function(e){
                        $.ajax({
                            type: "POST",
                            url: "{{ url('/deleteuser') }}",
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
                /* ---- ./Soft Delete User Info ---- */

                /* ---- Display Edit data & Save Edit data ----- */
                $(document).on('click', '#edit_user_btn', function(){
                    var btn_val = $(this).attr('name');
                    $.ajax({
                        type: "POST",
                        url: "{{ url('/userinfo') }}",
                        data: {_token: token, id: btn_val},
                        cache: false,
                        success: function(result)
                        {
                            $("#user_info_detail").html(result).show();
                            $('#modal_edit_user').modal('show');
                        }
                    });
                    return false;
                });

                /* Save Edited user data */
                $(document).on('click', '#save_change_btn', function() {
                    var txtName = $('#edit_name').val();
                    var txtEmail = $('#edit_email').val();
                    //var txtPassword = $('#password').val();
                    var roleOption = $('#role_selected_edit').val();
                    var txt_id = $('#save_change_btn').attr('name');
                    var facOption = $('#facility_selected_edit').val();
                    if(typeof facOption == 'undefined'){
                        facOption = "";
                    }

                    // post data to server using ajax
                    $.ajax({
                        type: "POST",
                        url: "{{ url('/saveuserdata') }}",
                        //data: {_token: token, name: txtName, email: txtEmail, pwd: txtPassword, role: roleOption, facil: facOption, sid:txt_id},
                        data: {_token: token, name: txtName, email: txtEmail, role: roleOption, facil: facOption, sid:txt_id},
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
