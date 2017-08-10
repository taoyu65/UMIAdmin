@extends('umi::layouts.master')

@section('content')

    <?php $assetPath = url(config('umi.assets_path')) ?>
    <?php $path = url($assetPath . '/ace') ?>

    <div class="page-header">
        <h1>
            {{trans('umiTrans::menu.sideMenu')}}
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                {{trans('umiTrans::menu.distribution')}}
            </small>
        </h1>
    </div>
    <div class="row">
        <div class="alert alert-block alert-success">
            <button type="button" class="close" data-dismiss="alert">
                <i class="ace-icon fa fa-times"></i>
            </button>
            <strong>
                <i class="ace-icon fa fa-check"></i>
                {{trans('umiTrans::menu.userFirst')}}.
            </strong>
            {{trans('umiTrans::menu.tip1')}} <br>
            <span class="red"><strong>{{trans('umiTrans::menu.warning')}} </strong>"{{config('umi.system_role.super_admin')}}"
                {{trans('umiTrans::menu.superAdminWarning')}}</span>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="col-sm-12">
                <h3 class="header smaller lighter purple">
                    {{trans('umiTrans::menu.userTree')}}
                </h3>
            </div>

            <div class="col-sm-12">
                <menu id="nestable-menu-user" class="nestable-menu-user">
                    <button type="button" data-action="select-user" class="btn btn-purple btn-sm btn-next" id="select-user">
                        {{trans('umiTrans::menu.selectUser')}}
                        <i class="ace-icon fa fa-user-plus"></i>
                    </button>
                    <button type="button" data-action="expand-all" class="btn btn-primary btn-sm btn-next">
                        {{trans('umiTrans::menu.expandAll')}}
                        <i class="ace-icon fa fa-expand"></i>
                    </button>
                    <button type="button" data-action="collapse-all" class="btn btn-primary btn-sm btn-next">
                        {{trans('umiTrans::menu.collapseAll')}}
                        <i class="ace-icon fa fa-compress"></i>
                    </button>
                    <button type="button" data-action="save" class="btn btn-success btn-sm btn-next" id="save-user">
                        {{trans('umiTrans::menu.update')}}
                        <i class="ace-icon fa fa-arrow-up"></i>
                    </button>
                </menu>
            </div>

            <div class="col-sm-12" id="menuTreeUser">
            </div>
        </div>

        <div class="col-sm-6">
            <div class="col-sm-12">
                <h3 class="header smaller lighter red">
                    {{trans('umiTrans::menu.menuTree')}}
                </h3>
            </div>

            <div class="col-sm-12">
                <menu id="nestable-menu" class="nestable-menu">
                    <button type="button" data-action="expand-all" class="btn btn-primary btn-sm btn-next">
                        {{trans('umiTrans::menu.expandAll')}}
                        <i class="ace-icon fa fa-expand"></i>
                    </button>
                    <button type="button" data-action="collapse-all" class="btn btn-primary btn-sm btn-next">
                        {{trans('umiTrans::menu.collapseAll')}}
                        <i class="ace-icon fa fa-compress"></i>
                    </button>
                    <button type="button" data-action="refresh" class="btn btn-pink btn-sm btn-next">
                        {{trans('umiTrans::menu.reload')}}
                        <i class="ace-icon fa fa-refresh"></i>
                    </button>
                </menu>
            </div>
            <div class="col-sm-12" id="menuTree">
                {!! $menuTree !!}
            </div>
        </div>
    </div>

    <form method="post" id="userTreeUpdateForm">
        {!! csrf_field() !!}
        <input id="menuJsonUser" type="hidden">
        <input id="userId" type="hidden">
    </form>

    <script src="{{$path}}/js/jquery.nestable.min.js"></script>
    <script src="{{$assetPath}}/js/jquery.form.js"></script>
    <script type="text/javascript">
        var userId = '';

        $(document).ready(function () {
            //init
            $('#userId').val('');

            //使得按钮可以点击
            //making the link enable to click
            $('.dd-handle a').on('mousedown', function(e){
                e.stopPropagation();
            });

            //用户菜单按钮组
            //button group of user's tree menu
            $('#nestable-menu-user').on('click', function(e)
            {
                var target = $(e.target),
                    action = target.data('action');
                switch (action) {
                    case 'expand-all':
                        $('#nestableUser').nestable('expandAll');
                        break;
                    case 'collapse-all':
                        $('#nestableUser').nestable('collapseAll');
                        break;
                    case 'select-user':
                        selectUser(target);
                        break;
                    case 'save':
                        if ($('#userId').val() == '')
                            return false;
                        var saveLayerUser = layer.load(0, {
                            shade: [0.8, '#000000']
                        });
                        var options = {
                            type: 'POST',
                            url: "{{url('menuManagement/' . $tableName)}}/updateUserTree/" + $('#userId').val(),
                            data: {'menuJsonUser':$('#menuJsonUser').val()},
                            success: function (data) {
                                layer.close(saveLayerUser);
                                layer.alert(data, function (e) {
                                    //window.location.reload();
                                    layer.close(e);
                                    LoadUserTree(userId);
                                });
                            }
                        };
                        $('#userTreeUpdateForm').ajaxSubmit(options);
                        break;
                }
            });

            //全部菜单按钮组
            //button group of all tree menu
            $('#nestable-menu').on('click', function(e)
            {
                var target = $(e.target),
                    action = target.data('action');
                switch (action) {
                    case 'expand-all':
                        $('#nestableMenu').nestable('expandAll');
                        break;
                    case 'collapse-all':
                        $('#nestableMenu').nestable('collapseAll');
                        break;
                    case 'refresh':
                        ReloadMenuTree();
                        break;
                }
            });

            $('#nestableMenu').nestable();
        });

        //当初始化和拖动菜单后重新计算json
        //when init and drag tree, it will recalculate the json string
        function resetJson(){
            var updateOutput = function(e) {
                var list = e.length ? e : $(e.target),
                    output = list.data('output');
                if(window.JSON) {
                    output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
                }
                else {
                    output.val('JSON browser support required for this demo.');
                }
            };
            $('#nestableUser').nestable().on('change', updateOutput);
            updateOutput($('#nestableUser').data('output', $('#menuJsonUser')));
        }
        //选择用户界面
        //page of selecting user
        function selectUser(obj) {
            //丧失焦点 (为了屏蔽打开窗口后, 点击空格再次打开窗口)
            //lose focus (for after a modal window opens, chick space a new window will be open again)
            obj.blur();

            var url = '{{url("selector/" . $userTableName . '/' . $property)}}';
            layer.open({
                type: 2,
                title: 'select a user',
                maxmin: true,
                shadeClose: true,
                area : ['800px' , '90%'],
                content: url
            });
        }

        function LoadUserTree(value) {
            userId = value;
            layer.closeAll();

            //加载用户菜单
            //loading user menus
            $('#menuTreeUser').html('<i class="ace-icon fa fa-spinner fa-spin orange bigger-300"></i>');

            $.ajax({
                url:"{{url('menuManagement/' . $tableName)}}/loadMenuTreeFromJson/" + value,
                success:function(data) {
                    $('#menuTreeUser').html(data);
                    resetJson();
                    //设置已经选择的用户 Set up a value that just selected
                    $('#userId').val(value);
                },
                error: function () {
                    $('#menuTreeUser').html('something went wrong');
                }
            });
        }

        //重新加载所有菜单
        //reload all the menus
        function ReloadMenuTree() {
            $('#menuTree').html('<i class="ace-icon fa fa-spinner fa-spin orange bigger-300"></i>');

            $.ajax({
                url:"{{url('menuManagement/' . $tableName)}}/loadMenuTree",
                success:function(data) {
                    $('#menuTree').html(data);
                },
                error: function () {
                    $('#menuTree').html('something went wrong');
                }
            });
        }

        //显示删除确认页面
        //show the confirmation page before deleting
        function showDeleting(url){
            layer.open({
                type: 2,
                title: 'deleting',
                maxmin: true,
                shadeClose: true,
                area : ['800px' , '90%'],
                content: url
            });
        }

    </script>
@endsection