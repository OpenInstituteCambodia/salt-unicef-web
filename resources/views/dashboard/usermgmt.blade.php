@extends('layouts.master')
@section('content')
    <div class="blank">
        <!--To show white background over the gray background-->
        <div class="blank-page">
            <h3 align="center"><strong>{{ trans('allstr.user_mgmt')}}</strong></h3><hr>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-outline-primary pull-right" id="add_new_user_trigger">
                        <i class="fa fa-plus fa-lg" aria-hidden="true"></i>
                        {{ trans('allstr.add_user') }}
                    </button>
                    <div class="clearfix"></div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class='table table-striped responsive' id='user_mgmt_tbl' cellspacing='0' width='100%'>
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
                            <tbody id="tbody">
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
                                        <td align="center">
                                            <!-- Edit User Record Button -->
                                            <button class="btn btn-outline-success" name="{{ $each_user->id }}" id="edit_user_btn">
                                                <i class="fa fa-pencil fa-lg" aria-hidden="true"></i>
                                                {{ trans('allstr.edit') }}
                                            </button>
                                            <!-- Reset Password Record Button -->
                                            {{--<button class="btn btn-outline-info" name="{{ $each_user->id }}" id="reset_pwd_btn">--}}
                                                {{--<i class="fa fa-cog fa-lg" aria-hidden="true"></i>--}}
                                                {{--{{ trans('allstr.reset_password') }}--}}
                                            {{--</button>--}}
                                            <button class="btn btn-outline-info" data-id="{{ $each_user->id }}" name="{{ $each_user->id }}" id="reset_pwd_btn">
                                                <i class="fa fa-cog fa-lg" aria-hidden="true"></i>
                                                {{ trans('allstr.reset_password') }}
                                            </button>
                                            <!-- Delete User Record Button -->
                                            <button class="btn btn-outline-danger" name="{{ $each_user->id }}" id="delete_user_btn">
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

    <!-- Add New User Modal -->
    <div class="modal fade" id="modal_add_new_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <strong class="modal-title text-primary"> {{ trans('allstr.add_user') }} </strong>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="fa fa-times-circle-o fa-lg text-red"></span>
                    </button>
                </div>
                <form method="post" enctype="application/x-www-form-urlencoded">
                <div class='modal-body'>
                    <div class="form-group">
                        <label for="name" class="col-md-6">{{ trans('allstr.name') }} <i class="text-red">*</i></label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus autocomplete='off'>
                            <div id="name_msg"></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group">
                        <label for="email" class="col-md-6">{{ trans('allstr.user_email') }} <i class="text-red">*</i></label>
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="" required autocomplete='off'>
                            <div id="email_msg"></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group">
                        <label for="pwd" class="col-md-6">{{ trans('allstr.password') }} <i class="text-red">*</i></label>
                        <div class="col-md-6">
                            <input id="pwd" type="password" class="form-control" name="password" autocomplete='off' required>
                            <div id="pwd_msg"></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group">
                        <label for="confirm_pwd" class="col-md-6">{{ trans('allstr.password_confirm') }} <i class="text-red">*</i></label>
                        <div class="col-md-6">
                            <input id="confirm_pwd" type="password" class="form-control" name="password_confirmation" required>
                            <div id="confirm_pwd_msg"></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="form-group">
                        <label for="role-option" class="col-md-6">{{ trans('allstr.user_role') }} <i class="text-red">*</i></label>
                        <div class="col-md-6 styled-select">
                            <select id="role_selected" autocomplete='off'>
                                <option value="0" selected>{{ trans('allstr.select_user_option') }}</option>
                                <option value="1">{{ trans('allstr.admin') }}</option>
                                <option value="2">{{ trans('allstr.producer') }}</option>
                                <option value="3">{{ trans('allstr.monitor') }}</option>
                            </select>
                            <div id="option_msg"></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="form-group" id="div_select_facility">
                        <label for="facility-option" class="col-md-6">{{ trans('allstr.facility') }}</label>
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
                    <strong class="modal-title text-primary">{{ trans('allstr.dialog_confirm') }}</strong>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="fa fa-times-circle-o fa-lg text-red"></span>
                    </button>
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
                    <strong class="modal-title text-primary" id="myModalLabel">{{ trans('allstr.modal_edit_user') }}</strong>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="fa fa-times-circle-o fa-lg text-red"></span>
                    </button>
                </div>
                <span id='user_info_detail'>
                    {{ csrf_field() }}
                </span>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Reset User Password Modal -->
    <div class="modal fade" id="modal_reset_pwd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <strong class="modal-title text-primary"> {{ trans('allstr.reset_password') }} </strong>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="fa fa-times-circle-o fa-lg text-red"></span>
                    </button>
                </div>
                <form method="post" enctype="application/x-www-form-urlencoded">
                    <div class='modal-body' id="modal_reset_body">
                        <div class="form-group">
                            <label for="reset_password" class="col-md-6">{{ trans('allstr.password') }} <i class="text-red">*</i></label>
                            <div class="col-md-6">
                                <input id="reset_password" type="password" class="form-control" placeholder="Enter New Password" name="reset_password" autocomplete='off' required>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group">
                            <label for="reset_password_confirm" class="col-md-6">{{ trans('allstr.password_confirm') }} <i class="text-red">*</i></label>
                            <div class="col-md-6">
                                <input id="reset_password_confirm" type="password" class="form-control" placeholder="Enter Password Again" name="reset_password_confirm" required>
                                <div id="reset_password_confirm_msg"></div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <input type="hidden" id="btn_id" value="">
                    </div><!-- /.modal-body -->
                    <div class='modal-footer'>
                        <button class='btn btn-outline-danger' data-dismiss='modal' id="reset_pwd_cancel">
                            <i class='fa fa-refresh fa-lg' aria-hidden='true'></i>
                            {{trans('allstr.cancel')}}
                        </button>
                        <button class='btn btn-outline-primary' id="reset_pwd_save">
                            <i class='fa fa-floppy-o fa-lg' aria-hidden='true'></i>
                            {{ trans('allstr.save')  }}
                        </button>
                    </div><!-- /.modal-footer -->
                </form>
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
                $('#user_mgmt_tbl').DataTable( {
                    deferRender:    true,
                    scroller:       true,
                } );

                // Add_New_user: Confirm match of password and reset password
                $( "#confirm_pwd" ).focusout(function() {
                    var pwd = $('#pwd').val();
                    var pwd_confirm = $('#confirm_pwd').val();
                    if(pwd != "")
                    {
                        if(pwd_confirm != pwd) $('#confirm_pwd_msg').html('<span style="color: red;">{{trans('allstr.password_mismatched')}}</span>');
                        else $('#confirm_pwd_msg').html('<span style="color: green;">{{trans('allstr.password_matched')}}</span>');
                    }
                });

                // Reset_Password: Confirm match of password and reset password
                $( "#reset_password_confirm" ).keyup(function() {
                    var reset_pwd = $('#reset_password').val();
                    var reset_pwd_confirm = $('#reset_password_confirm').val();
                    if(reset_pwd != "")
                    {
                        if(reset_pwd_confirm != reset_pwd)
                            $('#reset_password_confirm_msg').html('<span style="color: red;">{{trans('allstr.password_mismatched')}}</span>');
                        else
                            $('#reset_password_confirm_msg').html('<span style="color: green;">{{trans('allstr.password_matched')}}</span>');
                    }
                });

                /* Show Reset User Password Modal */
                $(document).on('click', "#reset_pwd_btn", function(){
                    var btnid = $(this).data('id');
                    //console.log('id=' + btnid);
                    $("#btn_id").val(btnid);
                    $('#modal_reset_pwd').modal('show');
                    return false;
                });

                /* Reset user password data */
                $(document).on('click', '#reset_pwd_save', function() {

                    var txt_id = $("#btn_id").val();
                    console.log('id=' + btn_id);
                    var txtResetPassword = $('#reset_password').val();
                    // post data to server using ajax
                    $.ajax({
                        type: "POST",
                        url: "{{ route('saveresetpassword') }}",
                        data: {_token: token, resetpwd: txtResetPassword, sid:txt_id},
                        cache: false,
                        success: function(result)
                        {
                            location.reload();
                        },
                        error: function(e)
                        {
                            //console.log(e);
                        }
                    });
                    return false;
                });
                /* ---- ./Reset user password data ----- */

                // Clear old data from form when dismiss modal
                $('#modal_reset_pwd').on('hidden.bs.modal', function (e) {
                    $(this)
                        .find("input,textarea,select")
                        .val("")
                        .end()
                        .find("#reset_password_confirm_msg")
                        .html("")
                        .end();
                });

                // Clear old data from form when dismiss modal
                $('#modal_add_new_user').on('hidden.bs.modal', function (e) {
                    $(this)
                        .find("input,textarea")
                        .val("")
                        .end()
                        .find("span")
                        .html("")
                        .end()
                        .find("input[type=checkbox], input[type=radio]")
                        .prop("checked", "")
                        .end();
                });

                /* ------ Add/Save new User -----*/
                $("#div_select_facility").hide();

                /* Checking Existing Email for add new user form */
                $(document).on('focusout', "#email", function(){
                    var txtEmail = $('#email').val();
                    // post data to server using ajax
                    $.ajax({
                        type: "POST",
                        url: "{{ route('checkexistingemail') }}",
                        data: {_token: token, email: txtEmail},
                        cache: false,
                        success: function(result)
                        {
                            $('#email_msg').html('<span style="color: red;">'+result+"</span>");
                        },
                        error: function(e)
                        {
                            //console.log(e);
                        }
                    });
                    return false;
                });

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

                /* Cancel to save new user */
                $(document).on('click', "#add_new_user_cancel", function(){
                // $("#add_new_user_cancel").click(function() {
                    location.reload();

                });

                /* validate Email x@x.xxx */
                function validateEmail(email) {
                    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                    return re.test(String(email).toLowerCase());
                }

                /* onChange if selected role value !=0 (select option) then removed text "Role is required from
                 below role select option */
                $(document).on('change', "#role_selected", function(){
                    var roleOption_selected = $('#role_selected').val();
                    if(roleOption_selected !=0) {
                        $('#option_msg').html("");
                    }
                });

                /* Save New User */
                $(document).on('click', "#add_new_user_save", function(){
                //$("#add_new_user_save").click(function() {

                    var txtName = $('#name').val();
                    var txtEmail = $('#email').val();
                    var txtPassword = $('#pwd').val();
                    var roleOption = $('#role_selected').val();
                    var facOption = $('#facility_selected').val();

                    if(roleOption ==0) {
                        $('#option_msg').html("<span style='color: red;'>{{ trans('allstr.required_role') }}</span>");
                    }

                    if(txtName ==''){ $('#name_msg').html("<span style='color: red;'>{{ trans('allstr.required_name') }}</span>"); }
                    else { $('#name_msg').html(""); }

                    if(txtPassword ==''){ $('#pwd_msg').html("<span style='color: red;'>{{ trans('allstr.required_password') }}</span>");}
                    else { $('#pwd_msg').html(""); }

                    if (validateEmail(txtEmail) && txtName !='' && txtPassword !='' && roleOption !=0)
                    {
                        // post data to server using ajax
                        $.ajax({
                            type: "POST",
                            url: "{{ route('addnewuser') }}",
                            data: {_token: token, name: txtName, email: txtEmail, pwd: txtPassword, role: roleOption, facil: facOption},
                            cache: false,
                            success: function(result)
                            {
                                location.reload();
                            },
                            error: function(e)
                            {
                                // console.log(e);
                            }
                        });
                    }
                    else if(txtEmail =='') $('#email_msg').html("<span style='color: red;'>{{ trans('allstr.required_email') }}</span>");
                    else if(!validateEmail(txtEmail))
                    {
                        $('#email_msg').html("<span style='color: red;'>{{ trans('allstr.incorrect_email') }}</span>");
                    }

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
                            url: "{{ route('deleteuser') }}",
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
                        url: "{{ route('userinfo') }}",
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
                    var roleOption = $('#role_selected_edit').val();
                    var txt_id = $('#save_change_btn').attr('name');
                    var facOption = $('#facility_selected_edit').val();
                    if(typeof facOption == 'undefined'){
                        facOption = "";
                    }

                    // post data to server using ajax
                    $.ajax({
                        type: "POST",
                        url: "{{ route('saveuserdata') }}",
                        data: {_token: token, name: txtName, email: txtEmail, role: roleOption, facil: facOption, sid:txt_id},
                        cache: false,
                        success: function(result)
                        {
                           location.reload();
                        },
                        error: function(e)
                        {
                            //console.log(e);
                        }
                    });
                    return false;
                });
                /* ---- ./Save Edit data ----- */



        });
</script>
    @endpush

@endsection

