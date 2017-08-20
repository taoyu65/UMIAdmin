@extends('umi::layouts.master')

@section('content')

    <?php $assetPath = url(config('umi.assets_path')) ?>
    <?php $path = url($assetPath . '/lte') ?>

    <link rel="stylesheet" href="{{$assetPath}}/css/style.css">

    <div class="box box-success box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">{{trans('umiTrans::wizard.wizardTitle')}}</h3>
        </div>
        <div class="box-body">
            <div class="col-xs-12 text-center">
                <div class="f1">
                    <h3>{{trans('umiTrans::wizard.wizardTitle')}}</h3>
                    <p>Please follow the step</p>
                    <div class="f1-steps">
                        <div class="f1-progress">
                            <div class="f1-progress-line" data-now-value="25" data-number-of-steps="4" style="width: 25%;"></div>
                        </div>
                        <div class="f1-step active">
                            <div class="f1-step-icon"><i class="fa fa-user"></i></div>
                            <p>{{trans('umiTrans::wizard.selectUser')}}</p>
                        </div>
                        <div class="f1-step">
                            <div class="f1-step-icon"><i class="fa fa-users"></i></div>
                            <p>{{trans('umiTrans::wizard.selectRole')}}</p>
                        </div>
                        <div class="f1-step">
                            <div class="f1-step-icon"><i class="fa fa-key"></i></div>
                            <p>{{trans('umiTrans::wizard.distributePermission')}}</p>
                        </div>
                        <div class="f1-step">
                            <div class="f1-step-icon"><i class="fa fa-check"></i></div>
                            <p>{{trans('umiTrans::wizard.finish')}}</p>
                        </div>
                    </div>

                    <fieldset>
                        <br/>
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="text-primary">{{trans('umiTrans::wizard.givePermission')}}</h3>
                            </div>
                            <div class="form-horizontal">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label text-primary">{{trans('umiTrans::wizard.userName')}}</label>
                                        <div class="col-sm-2">
                                            <div class="btn-group">
                                                <div class="input-group-btn">
                                                    <button type="button" class="btn btn-primary dropdown-toggle btn-flat" data-toggle="dropdown" id="userBtn">{{trans('umiTrans::wizard.selectUser')}}
                                                        <span class="fa fa-caret-down"></span></button>
                                                    <button type="button" class="btn btn-primary dropdown-toggle btn-flat" data-toggle="dropdown" id="loadUserBtn" disabled="disabled" style="display: none">{{trans('umiTrans::wizard.loading')}}
                                                        <i class='ace-icon fa fa-spinner fa-spin white bigger-125'></i></button>
                                                    <ul class="dropdown-menu userStep">
                                                        @foreach($users as $id=>$user)
                                                            <li>
                                                                @if(in_array($user, $systemRole))
                                                                    <a href="#" id="{{$id}}" onclick="systemRole(true)">{{$user}}</a>
                                                                @else
                                                                    <a href="#" id="{{$id}}" onclick="systemRole(false)">{{$user}}</a>
                                                                @endif
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <button class="btn btn-primary btn-flat" id="userRefresh" type="button">
                                                {{trans('umiTrans::wizard.refresh')}}
                                                <i class="fa fa-refresh"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-group has-primary">
                                        <label class="col-sm-2 control-label" for=""></label>
                                        <div class="col-sm-5">
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="userName" name="userName" disabled="disabled">
                                                <span class="input-group-addon"><i class="fa fa-user fa-primary"></i></span>
                                            </div>
                                            <label class="text-red" hidden="hidden" id="errorUser">Please select a user</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="text-success">{{trans('umiTrans::wizard.moreAction')}}</h3>
                            </div>
                            <div class="form-horizontal">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label text-success"></label>
                                        <div class="col-sm-12 col-sm-5">
                                            <button class="btn btn-success btn-flat" type="button" id="createUserBtn">{{trans('umiTrans::wizard.createUser')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="f1-buttons">
                            <button type="button" class="btn btn-prev btn-navy btn-flat" disabled="disabled">
                                <i class="ace-icon fa fa-arrow-left"></i>
                                {{trans('umiTrans::wizard.prev')}}
                            </button>
                            <button type="button" class="btn btn-success btn-flat btn-next">
                                {{trans('umiTrans::wizard.next')}}
                                <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                            </button>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="box box-success box-solid">
                            <div class="box-header with-border">
                                <h3 class="box-title">{{trans('umiTrans::wizard.wizardTitle')}}</h3>
                            </div>
                            <div class="box-body">
                            </div>
                        </div>
                        <div class="f1-buttons">
                            <button type="button" class="btn btn-previous">Previous</button>
                            <button type="button" class="btn btn-next">Next</button>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="f1-buttons">
                            <button type="button" class="btn btn-previous">Previous</button>
                            <button type="button" class="btn btn-next">Next</button>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="f1-buttons">
                            <button type="button" class="btn btn-previous">Previous</button>
                            <button type="submit" class="btn btn-submit">Submit</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    </div>
    <form action="{{url('authority/wizardUpdate')}}" method="post" id="updateAuthority">
        {!! csrf_field() !!}
        <input type="hidden" name="user_id" id="user_id" value="">
        <input type="hidden" name="role_id" id="role_id" value="">
        <input type="hidden" name="oldPermissions" id="oldPermissions">
        <input type="hidden" name="newPermissions" id="newPermissions">
    </form>


    <script src="{{$path}}/plugins/iCheck/icheck.min.js"></script>

    <script>
        $(document).ready(function () {

            //点击用户列表
            //click user list
            $('.userStep a').click(function () {
                $('#userName').val($(this).text());
                //最后提交表单使用的隐藏域
                //hidden field for submitting at the end
                $('#user_id').val($(this).prop('id'));
            });
            //刷新用户列表
            //refresh user list
            $('#userRefresh').click(function () {
                $('#loadUserBtn').removeAttr('style');
                $('#userBtn').attr('style', 'display:none');
                getUserName();
            });
            //添加新用户
            //add new user
            $('#createUserBtn').click(function () {
                var url = '{{url("adding/" . $userTableName)}}';
                layer.open({
                    type: 2,
                    title: 'Create User',
                    maxmin: true,
                    shadeClose: true,
                    area: ['80%', '90%'],
                    content: url
                });
            });
            //添加新角色
            //add new role
            $('#createRoleBtn').click(function () {
                var url = '{{url("adding/" . $roleTableName)}}';
                layer.open({
                    type: 2,
                    title: 'Create Role',
                    maxmin: true,
                    shadeClose: true,
                    area: ['80%', '90%'],
                    content: url
                });
            });
        });
        //加载步骤1的用户列表
        //load user list for step 1
        function getUserName() {
            var url = '{{url("authority/ajax/users")}}';
            var ul = $('.userStep');
            $.ajax({
                type: 'get',
                url: url,
                dataType: 'json',
                success: function (data) {
                    ul.children('li').remove();
                    $.each(data, function (name, value) {
                        ul.append("<li><a href='#'>" + value + "</a></li>");
                    });
                    var roleDom = $('#userBtn');
                    var loadDom = $('#loadUserBtn');
                    roleDom.removeAttr('style');
                    loadDom.attr('style', 'display:none');
                    //点击用户列表
                    //click user list
                    $('.userStep a').click(function () {
                        $('#userName').val($(this).text());
                    });
                    //刷新角色列表
                    //refresh role list
                    $('#userRefresh').click(function () {
                        loadDom.removeAttr('style');
                        roleDom.attr('style', 'display:none');
                        getUserName();
                    });
                },
                error: function () {
                    layer.alert('loading data was wrong!', function (){
                        window.history.back();
                    });
                }
            });
        }
        //加载步骤2的角色列表
        //load role list for step 2
        function getRoleName() {
            var url = '{{url("authority/ajax/roles")}}';
            var ul = $('#roleStep ul');
            $.ajax({
                type: 'get',
                url: url,
                dataType: 'json',
                success: function (data) {
                    ul.children('li').remove();
                    $.each(data, function (name, value) {
                        ul.append("<li><a href='#' id='" + name + "'>" + value + "</a></li>");
                    });
                    var roleDom = $('#roleBtn');
                    var loadDom = $('#loadRoleBtn');
                    roleDom.removeAttr('style');
                    loadDom.attr('style', 'display:none');
                    //点击角色列表
                    //click role list
                    $('#roleStep a').click(function () {
                        $('#roleName').val($(this).text());
                        //最后提交表单使用的隐藏域
                        //hidden field for submitting at the end
                        $('#role_id').val($(this).prop('id'));
                    });
                    //刷新角色列表
                    //refresh role list
                    $('#roleRefresh').click(function () {
                        loadDom.removeAttr('style');
                        roleDom.attr('style', 'display:none');
                        getRoleName();
                    });
                },
                error: function () {
                    layer.alert('loading data was wrong!', function (){
                        window.history.back();
                    });
                }
            });
        }
        //
        //
        function systemRole(is_system_role) {
            var label = $('#systemRole');
            if (is_system_role) {
                label.show();
            } else {
                label.hide();
            }
        }



        function scroll_to_class(element_class, removed_height) {
            var scroll_to = $(element_class).offset().top - removed_height;
            if($(window).scrollTop() != scroll_to) {
                $('html, body').stop().animate({scrollTop: scroll_to}, 0);
            }
        }

        function bar_progress(progress_line_object, direction) {
            var number_of_steps = progress_line_object.data('number-of-steps');
            var now_value = progress_line_object.data('now-value');
            var new_value = 0;
            if(direction == 'right') {
                new_value = now_value + ( 100 / number_of_steps );
            }
            else if(direction == 'left') {
                new_value = now_value - ( 100 / number_of_steps );
            }
            progress_line_object.attr('style', 'width: ' + new_value + '%;').data('now-value', new_value);
        }


        jQuery(document).ready(function() {
            /*
             Form
             */
            $('.f1 fieldset:first').fadeIn('slow');

            $('.f1 input[type="text"], .f1 input[type="password"], .f1 textarea').on('focus', function() {
                $(this).removeClass('input-error');
            });

            // next step
            $('.f1 .btn-next').on('click', function() {
                var parent_fieldset = $(this).parents('fieldset');
                var next_step = true;
                // navigation steps / progress steps
                var current_active_step = $(this).parents('.f1').find('.f1-step.active');
                var progress_line = $(this).parents('.f1').find('.f1-progress-line');

                // fields validation
                parent_fieldset.find('#userName, input[type="password"], textarea').each(function() {
                    if( $(this).val() == "" ) {
                        $('#errorUser').show();
                        next_step = false;
                    }
                    else {
                        $('#errorUser').hide();
                    }
                });
                // fields validation

                if( next_step ) {
                    parent_fieldset.fadeOut(400, function() {
                        // change icons
                        current_active_step.removeClass('active').addClass('activated').next().addClass('active');
                        // progress bar
                        bar_progress(progress_line, 'right');
                        // show next step
                        $(this).next().fadeIn();
                        // scroll window to beginning of the form
                        scroll_to_class( $('.f1'), 20 );
                    });
                }

            });

            // previous step
            $('.f1 .btn-previous').on('click', function() {
                // navigation steps / progress steps
                var current_active_step = $(this).parents('.f1').find('.f1-step.active');
                var progress_line = $(this).parents('.f1').find('.f1-progress-line');

                $(this).parents('fieldset').fadeOut(400, function() {
                    // change icons
                    current_active_step.removeClass('active').prev().removeClass('activated').addClass('active');
                    // progress bar
                    bar_progress(progress_line, 'left');
                    // show previous step
                    $(this).prev().fadeIn();
                    // scroll window to beginning of the form
                    scroll_to_class( $('.f1'), 20 );
                });
            });

            // submit
            $('.f1').on('submit', function(e) {

                // fields validation
                $(this).find('input[type="text"], input[type="password"], textarea').each(function() {
                    if( $(this).val() == "" ) {
                        e.preventDefault();
                        $(this).addClass('input-error');
                    }
                    else {
                        $(this).removeClass('input-error');
                    }
                });
                // fields validation
            });
        });
    </script>
@endsection