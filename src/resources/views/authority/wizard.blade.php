@extends('umi::layouts.master')

@section('content')

    <?php $assetPath = config('umi.assets_path') ?>
    <?php $path = $assetPath . '/ace' ?>

    <div class="widget-box">
        <div class="widget-header widget-header-blue widget-header-flat">
            <h4 class="widget-title lighter">Distribute Authority Wizard</h4>

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
                                <span class="title">Select User</span>
                            </li>

                            <li data-step="2">
                                <span class="step">2</span>
                                <span class="title">Select Role</span>
                            </li>

                            <li data-step="3">
                                <span class="step">3</span>
                                <span class="title">Distribute Permission</span>
                            </li>

                            <li data-step="4">
                                <span class="step">4</span>
                                <span class="title">Finish</span>
                            </li>
                        </ul>
                    </div>

                    <hr />

                    <div class="step-content pos-rel">
                        {{-- User --}}
                        <div class="step-pane active" data-step="1">
                            <h3 class="header smaller lighter green">Select a User who you want to give permissions to</h3>
                            <form class="form-horizontal">
                                <div class="form-group has-success">
                                    <label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right">user name: </label>
                                    <div class="col-xs-12 col-sm-2">
                                        <span class="block input-icon input-icon-right">
                                            <div id="userStep">
                                                <button data-toggle="dropdown" class="btn btn-success btn-sm dropdown-toggle" id="userBtn">
                                                    Select a User
                                                    <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                                                </button>
                                                <button data-toggle="dropdown" class="btn btn-success btn-sm dropdown-toggle" id="loadUserBtn" disabled="disabled" style="display: none">
                                                    Loading...
                                                    <i class='ace-icon fa fa-spinner fa-spin white bigger-125'></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-success dropdown-menu-right">
                                                    @foreach($users as $user)
                                                    <li>
                                                        <a href="#">{{$user}}</a>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>

                                        </span>
                                    </div>
                                    <div class="col-xs-12 col-sm-2">
                                        <button class="btn btn-success btn-sm" id="userRefresh" type="button">
                                            Refresh
                                            <i class="fa fa-refresh"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group has-success">
                                    <label for="userName" class="col-xs-12 col-sm-3 control-label no-padding-right"></label>

                                    <div class="col-xs-12 col-sm-5">
                                        <span class="block input-icon input-icon-right">
                                            <input type="text" id="userName" class="width-100" name="userName"/>
                                            <i class="ace-icon fa fa-user"></i>
                                        </span>
                                    </div>
                                    <div class="help-block col-xs-12 col-sm-reset inline"> Select or type in </div>
                                </div>
                            </form>

                            <h3 class="header smaller lighter blue">More Action</h3>
                            <form class="form-horizontal">
                                <div class="form-group has-success">
                                    <label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right"></label>
                                    <div class="col-xs-12 col-sm-5">
                                        <button class="btn btn-info" type="button" id="createUserBtn">Create User</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        {{-- Role --}}
                        <div class="step-pane" data-step="2">
                            <h3 class="header smaller lighter blue">Select a Role</h3>
                            <form class="form-horizontal">
                                <div class="form-group has-info">
                                    <label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right">Role name: </label>
                                    <div class="col-xs-12 col-sm-2">
                                        <span class="block input-icon input-icon-right">
                                            <div id="roleStep">
                                                <button data-toggle="dropdown" class="btn btn-info btn-sm dropdown-toggle" disabled="disabled" id="loadRoleBtn">
                                                    Loading...
                                                    <i class='ace-icon fa fa-spinner fa-spin white bigger-125'></i>
                                                </button>
                                                <button data-toggle="dropdown" class="btn btn-info btn-sm dropdown-toggle" id="roleBtn" style="display: none">
                                                    Select Role
                                                    <span id='responseLoading' class='ace-icon fa fa-caret-down icon-on-right'></span>
                                                </button>

                                                <ul class="dropdown-menu dropdown-info dropdown-menu-right">
                                                </ul>
                                            </div>
                                        </span>
                                    </div>
                                    <div class="col-xs-12 col-sm-2">
                                        <button class="btn btn-info btn-sm" id="roleRefresh" type="button">
                                            Refresh
                                            <i class="fa fa-refresh"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group has-info">
                                    <label for="roleName" class="col-xs-12 col-sm-3 control-label no-padding-right"></label>

                                    <div class="col-xs-12 col-sm-5">
                                        <span class="block input-icon input-icon-right">
                                            <input type="text" id="roleName" class="width-100" name="roleName"/>
                                            <i class="ace-icon fa fa-users"></i>
                                        </span>
                                    </div>
                                    <div class="help-block col-xs-12 col-sm-reset inline"> Select or type in </div>
                                </div>
                            </form>

                            <h3 class="header smaller lighter orange2">More Action</h3>
                            <form class="form-horizontal">
                                <div class="form-group has-success">
                                    <label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right"></label>
                                    <div class="col-xs-12 col-sm-5">
                                        <button class="btn btn-yellow" type="button" id="createRoleBtn">Create Role</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="step-pane" data-step="3">
                            <div class="center">
                                <h3 class="blue lighter">This is step 3</h3>
                            </div>
                        </div>

                        <div class="step-pane" data-step="4">
                            <div class="center">
                                <h3 class="green">Congrats!</h3>
                                Your product is ready to ship! Click finish to continue!
                            </div>
                        </div>
                    </div>
                </div>

                <div class="wizard-actions">
                    <button class="btn btn-prev">
                        <i class="ace-icon fa fa-arrow-left"></i>
                        Prev
                    </button>

                    <button class="btn btn-success btn-next" data-last="Finish">
                        Next
                        <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                    </button>
                </div>
            </div><!-- /.widget-main -->
        </div><!-- /.widget-body -->
    </div>

    <script src="{{$path}}/js/wizard.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#fuelux-wizard-container').ace_wizard({
                }).on('finished.fu.wizard', function(e) {
                    layer.alert('a');
                }).on('stepclick.fu.wizard', function(e){
                //e.preventDefault();//this will prevent clicking and selecting steps
            }).on('actionclicked.fu.wizard' , function(e, info){
                if(info.step == 1) {
                    //只在第一次加载角色数据
                    //only load once at the first time
                    if ($('#roleStep ul li').size() === 0) {
                        //加载步骤2的角色列表
                        //load role list for step 2
                        getRoleName();
                    }
                }
            });

            //点击用户列表
            //click user list
            $('#userStep a').click(function () {
                $('#userName').val($(this).text());
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
                        ul.append("<li><a href='#'>" + value + "</a></li>");
                    });
                    var roleDom = $('#roleBtn');
                    var loadDom = $('#loadRoleBtn');
                    roleDom.removeAttr('style');
                    loadDom.attr('style', 'display:none');

                    //点击角色列表
                    //click role list
                    $('#roleStep ul li a').click(function () {
                        $('#roleName').val($(this).text());
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
    </script>
@endsection