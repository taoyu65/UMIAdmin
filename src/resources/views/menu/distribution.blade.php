@extends('umi::layouts.master')

@section('content')

    <?php $assetPath = config('umi.assets_path') ?>
    <?php $path = $assetPath . '/ace' ?>

    <div class="page-header">
        <h1>
            Side Menu
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Distribution
            </small>
        </h1>
    </div>

    <div class="row">
        {{-- User Tree --}}
        <div class="col-sm-6">
            <div class="col-sm-12">
                <h3 class="header smaller lighter purple">
                    User Tree
                </h3>
            </div>

            <div class="col-sm-12">
                <menu id="nestable-menu-user" class="nestable-menu-user">
                    <button type="button" data-action="select-user" class="btn btn-purple btn-sm btn-next">
                        Select a user
                        <i class="ace-icon fa fa-user-plus"></i>
                    </button>
                    <button type="button" data-action="expand-all" class="btn btn-primary btn-sm btn-next">
                        Expand All
                        <i class="ace-icon fa fa-expand"></i>
                    </button>
                    <button type="button" data-action="collapse-all" class="btn btn-primary btn-sm btn-next">
                        Collapse All
                        <i class="ace-icon fa fa-compress"></i>
                    </button>
                    <button type="button" data-action="save" class="btn btn-success btn-sm btn-next">
                        Save
                        <i class="ace-icon fa fa-plus"></i>
                    </button>
                </menu>
            </div>

            <div class="col-sm-12" id="menuTreeUser">
                {!! $menuTree !!}
            </div>
        </div>

        {{-- Menu Tree --}}
        <div class="col-sm-6">
            <div class="col-sm-12">
                <h3 class="header smaller lighter red">
                    Menu Tree
                </h3>
            </div>

            <div class="col-sm-12">
                <menu id="nestable-menu" class="nestable-menu">
                    <button type="button" data-action="expand-all" class="btn btn-primary btn-sm btn-next">
                        Expand All
                        <i class="ace-icon fa fa-expand"></i>
                    </button>
                    <button type="button" data-action="collapse-all" class="btn btn-primary btn-sm btn-next">
                        Collapse All
                        <i class="ace-icon fa fa-compress"></i>
                    </button>
                    <button type="button" data-action="refresh" class="btn btn-pink btn-sm btn-next">
                        Reload
                        <i class="ace-icon fa fa-refresh"></i>
                    </button>
                </menu>
            </div>
            <div class="col-sm-12" id="menuTree">
                {!! $menuTree !!}
            </div>
        </div>
    </div>

    {{--neastable js tree--}}
    <div class="col-xs-12">

    </div>

    <form method="post" id="updateOrderForm">
        {!! csrf_field() !!}
    </form>

    <script src="{{$path}}/js/jquery.nestable.min.js"></script>
    <script src="{{$assetPath}}/js/jquery.form.js"></script>
    <script type="text/javascript">

        $(document).ready(function () {
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
            $('.dd').nestable().on('change', updateOutput);
            updateOutput($('#nestable').data('output', $('#menuJson')));

            //making the link enable to click
            $('.dd-handle a').on('mousedown', function(e){
                e.stopPropagation();
            });

            $('#nestable-menu').on('click', function(e)
            {
                var target = $(e.target),
                    action = target.data('action');
                switch (action) {
                    case 'expand-all':
                        $('#menuTree').children('.dd').nestable('expandAll');
                        break;
                    case 'collapse-all':
                        $('#menuTree').children('.dd').nestable('collapseAll');
                        break;
                    case 'refresh':
                        menuTreeReload();
                        break;
                }
            });

            $('#nestable-menu-user').on('click', function(e)
            {
                var target = $(e.target),
                    action = target.data('action');
                switch (action) {
                    case 'expand-all':
                        $('#menuTreeUser').children('.dd').nestable('expandAll');
                        break;
                    case 'collapse-all':
                        $('#menuTreeUser').children('.dd').nestable('collapseAll');
                        break;
                    case 'refresh':
                        ReloadMenuTree();
                        break;
                    case 'select-user':
                        selectUser(target);
                        break;
                }
            });
        });

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

        function LoadUserTree() {
            alert('gg');
        }

        //重新加载所有菜单
        //reload all the menus
        function ReloadMenuTree() {
            $('#menuTree').html('<i class="ace-icon fa fa-spinner fa-spin orange bigger-300"></i>');

            $.ajax({
                url:"{{url('menuManagement/' . $table)}}/loadMenuTree",
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