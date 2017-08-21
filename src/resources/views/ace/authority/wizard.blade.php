@extends('umi::layouts.master')

@section('content')

    <?php $assetPath = url(config('umi.assets_path')) ?>
    <?php $path = url($assetPath . '/ace') ?>

    <div class="widget-box">
        <div class="widget-header widget-header-blue widget-header-flat">
            <h4 class="widget-title lighter">{{trans('umiTrans::wizard.wizardTitle')}}</h4>

            <div class="widget-toolbar">
                <label>

                </label>
            </div>
        </div>

        <div class="widget-body">
            <div class="widget-main">
                <div id="fuelux-wizard-container">
                    <div class="steps-container">
                        <ul class="steps">
                            <li data-step="1" class="active">
                                <span class="step">1</span>
                                <span class="title">{{trans('umiTrans::wizard.selectUser')}}</span>
                            </li>

                            <li data-step="2">
                                <span class="step">2</span>
                                <span class="title">{{trans('umiTrans::wizard.selectRole')}}</span>
                            </li>

                            <li data-step="3">
                                <span class="step">3</span>
                                <span class="title">{{trans('umiTrans::wizard.distributePermission')}}</span>
                            </li>

                            <li data-step="4">
                                <span class="step">4</span>
                                <span class="title">{{trans('umiTrans::wizard.finish')}}</span>
                            </li>
                        </ul>
                    </div>

                    <hr />

                    <div class="step-content pos-rel">
                        {{-- User --}}
                        <div class="step-pane active" data-step="1">
                            <h3 class="header smaller lighter green">{{trans('umiTrans::wizard.givePermission')}}</h3>
                            <form class="form-horizontal">
                                <div class="form-group has-success">
                                    <label for="inputWarning" class="col-xs-12 col-sm-2 control-label no-padding-right">{{trans('umiTrans::wizard.userName')}} </label>
                                    <div class="col-xs-12 col-sm-2">
                                        <span class="block input-icon input-icon-right">
                                            <div id="userStep">
                                                <button data-toggle="dropdown" class="btn btn-success btn-sm dropdown-toggle" id="userBtn">
                                                    {{trans('umiTrans::wizard.selectUser')}}
                                                    <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                                                </button>
                                                <button data-toggle="dropdown" class="btn btn-success btn-sm dropdown-toggle" id="loadUserBtn" disabled="disabled" style="display: none">
                                                    {{trans('umiTrans::wizard.loading')}}
                                                    <i class='ace-icon fa fa-spinner fa-spin white bigger-125'></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-success dropdown-menu-right">
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

                                        </span>
                                    </div>
                                    <div class="col-xs-12 col-sm-2">
                                        <button class="btn btn-success btn-sm" id="userRefresh" type="button">
                                            {{trans('umiTrans::wizard.refresh')}}
                                            <i class="fa fa-refresh"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group has-success">
                                    <label for="userName" class="col-xs-12 col-sm-2 control-label no-padding-right"></label>

                                    <div class="col-xs-12 col-sm-5">
                                        <span class="block input-icon input-icon-right">
                                            <input type="text" id="userName" class="width-100" name="userName" disabled/>
                                            <i class="ace-icon fa fa-user"></i>
                                        </span>
                                    </div>
                                    <div class="help-block col-xs-12 col-sm-reset inline"> {{trans('umiTrans::wizard.selectUser')}} </div>
                                    <div class="col-xs-offset-2 col-xs-12 red" id="systemRole" hidden="hidden">
                                        <strong>{{trans('umiTrans::wizard.important')}}</strong>
                                        {!! trans('umiTrans::wizard.tip1') !!}
                                    </div>
                                </div>
                            </form>

                            <h3 class="header smaller lighter blue">{{trans('umiTrans::wizard.moreAction')}}</h3>
                            <form class="form-horizontal">
                                <div class="form-group has-success">
                                    <label for="inputWarning" class="col-xs-12 col-sm-2 control-label no-padding-right"></label>
                                    <div class="col-xs-12 col-sm-5">
                                        <button class="btn btn-info" type="button" id="createUserBtn">{{trans('umiTrans::wizard.createUser')}}</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        {{-- Role --}}
                        <div class="step-pane" data-step="2">
                            <h3 class="header smaller lighter blue">{{trans('umiTrans::wizard.selectRole')}}</h3>
                            <form class="form-horizontal">
                                <div class="form-group has-info">
                                    <label for="inputWarning" class="col-xs-12 col-sm-2 control-label no-padding-right">{{trans('umiTrans::wizard.roleName')}} </label>
                                    <div class="col-xs-12 col-sm-2">
                                        <span class="block input-icon input-icon-right">
                                            <div id="roleStep">
                                                <button data-toggle="dropdown" class="btn btn-info btn-sm dropdown-toggle" disabled="disabled" id="loadRoleBtn">
                                                    {{trans('umiTrans::wizard.loading')}}
                                                    <i class='ace-icon fa fa-spinner fa-spin white bigger-125'></i>
                                                </button>
                                                <button data-toggle="dropdown" class="btn btn-info btn-sm dropdown-toggle" id="roleBtn" style="display: none">
                                                    {{trans('umiTrans::wizard.selectRole')}}
                                                    <span id='responseLoading' class='ace-icon fa fa-caret-down icon-on-right'></span>
                                                </button>

                                                <ul class="dropdown-menu dropdown-info dropdown-menu-right">
                                                </ul>
                                            </div>
                                        </span>
                                    </div>
                                    <div class="col-xs-12 col-sm-2">
                                        <button class="btn btn-info btn-sm" id="roleRefresh" type="button">
                                            {{trans('umiTrans::wizard.refresh')}}
                                            <i class="fa fa-refresh"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group has-info">
                                    <label for="roleName" class="col-xs-12 col-sm-2 control-label no-padding-right"></label>

                                    <div class="col-xs-12 col-sm-5">
                                        <span class="block input-icon input-icon-right">
                                            <input type="text" id="roleName" class="width-100" name="roleName" disabled/>
                                            <i class="ace-icon fa fa-users"></i>
                                        </span>
                                    </div>
                                    <div class="help-block col-xs-12 col-sm-reset inline"> {{trans('umiTrans::wizard.selectRole')}} </div>
                                </div>
                            </form>

                            <h3 class="header smaller lighter orange2">{{trans('umiTrans::wizard.moreAction')}}</h3>
                            <form class="form-horizontal">
                                <div class="form-group has-success">
                                    <label for="inputWarning" class="col-xs-12 col-sm-2 control-label no-padding-right"></label>
                                    <div class="col-xs-12 col-sm-5">
                                        <button class="btn btn-yellow" type="button" id="createRoleBtn">{{trans('umiTrans::wizard.createRole')}}</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        {{-- Permission --}}
                        @include('umi::common.authority.permissionCheckBox')

                        {{-- Submit --}}
                        <div class="step-pane" data-step="4">
                            <div class="center">
                                <h3 class="red">{{trans('umiTrans::wizard.warning')}}</h3>
                                <div class="alert alert-block alert-danger">
                                    <button type="button" class="close" data-dismiss="alert">
                                        <i class="ace-icon fa fa-times"></i>
                                    </button>

                                    <p>
                                        <strong>
                                            <i class="ace-icon fa fa-check"></i>
                                            {{trans('umiTrans::wizard.handsUp')}}
                                        </strong>
                                        {!! trans('umiTrans::wizard.tip2') !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="wizard-actions">
                    <button class="btn btn-prev">
                        <i class="ace-icon fa fa-arrow-left"></i>
                        {{trans('umiTrans::wizard.prev')}}
                    </button>

                    <button class="btn btn-success btn-next" data-last="Finish">
                        {{trans('umiTrans::wizard.next')}}
                        <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                    </button>
                </div>
            </div><!-- /.widget-main -->
        </div><!-- /.widget-body -->
    </div>

    <form action="{{url('authority/wizardUpdate')}}" method="post" id="updateAuthority">
        {!! csrf_field() !!}
        <input type="hidden" name="user_id" id="user_id" value="">
        <input type="hidden" name="role_id" id="role_id" value="">
        <input type="hidden" name="oldPermissions" id="oldPermissions">
        <input type="hidden" name="newPermissions" id="newPermissions">
    </form>

    <script src="{{$path}}/js/wizard.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#fuelux-wizard-container').ace_wizard({
                }).on('finished.fu.wizard', function(e) {
                    //提交更新
                    //submit update
                    $('#updateAuthority').submit();
                }).on('stepclick.fu.wizard', function(e) {
                    //e.preventDefault();//this will prevent clicking and selecting steps
                }).on('actionclicked.fu.wizard' , function(e, info){
                    //返回并不激发事件
                    //go back will not fire event
                    if (info.direction !== 'previous') {
                        if (info.step === 1) {
                            if ($('#userName').val().trim() === '') {
                                layer.alert('Please Select a User.', {title: 'Wrong'});
                                return false;
                            }
                            //只在第一次加载角色数据
                            //only load once at the first time
                            if ($('#roleStep ul li').size() === 0) {
                                //加载步骤2的角色列表
                                //load role list for step 2
                                getRoleName();
                            }
                        } else if (info.step === 2) {
                            if ($('#roleName').val().trim() === '') {
                                layer.alert('Please Select a Role.', {title: 'Wrong'});
                                return false;
                            }

                            //查看是否存在指定角色, 并且返回权限列表以固定格式 例如 (Browser1 = 表id为1的Browser权限)
                            //check if specific role exist, and return permission string (such as, B1 equal the permission of browser from table of id is 1)
                            var load = layer.load(3, {
                                shade: [0.5, '#000']
                            });
                            var roleName = $('#roleName').val();
                            var url = '{{url("/api/checkRole")}}' + '/' + roleName;
                            $.ajax({
                                type: 'get',
                                url: url,
                                async: false,
                                success: function (data) {
                                    if (data.length > 0) {
                                        //最后提交表单使用的隐藏域
                                        //hidden field for submitting at the end
                                        $('#oldPermissions').val(JSON.stringify(data));
                                        //循环检查权限
                                        //circulate to check all the permissions
                                        $('#form').find('input[type="checkbox"].permissionCheckBox:not(:disabled)').each(function () {
                                            var checkBoxName = $(this).prop('name');
                                            if ($.inArray(checkBoxName, data) !== -1) {
                                                $(this).prop('checked', 'checked');
                                            } else {
                                                $(this).removeAttr('checked');
                                            }
                                        });
                                        $('.roleTitle').text($('#roleName').val());
                                    } else {
                                        if (data === '') {
                                            var wizard = $('#fuelux-wizard-container').data('fu.wizard')
                                            wizard.currentStep = 1;
                                            wizard.setState();
                                            layer.alert('Role does not exist, please create this role');
                                            return false;
                                        } else {
                                            $('#form').find('input[type="checkbox"].permissionCheckBox:not(:disabled)').each(function () {
                                                $(this).removeAttr('checked');
                                            });
                                        }
                                    }
                                },
                                error: function () {
                                    layer.alert('Something went wrong.', 'Wrong');
                                    window.history.back();
                                },
                                complete: function () {
                                    layer.close(load);
                                }
                            });
                        } else if (info.step === 3) {
                            //最后提交表单使用的隐藏域
                            //hidden field for submitting at the end
                            var newPermission = [];
                            $('#form').find('input[type="checkbox"].permissionCheckBox:not(:disabled)').each(function () {
                                if ($(this).prop('checked')) {
                                    newPermission.push($(this).prop('name'));
                                }
                            });
                            $('#newPermissions').val(JSON.stringify(newPermission));
                        }
                    }
                });

            //点击用户列表
            //click user list
            $('#userStep a').click(function () {
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
            var ul = $('#userStep ul');
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
                    $('#userStep a').click(function () {
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
    </script>
@endsection