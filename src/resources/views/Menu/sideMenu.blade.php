@extends('umi::layouts.master')

@section('content')

    <?php $assetPath = config('umi.assets_path') ?>
    <?php $path = $assetPath . '/ace' ?>

    <div class="page-header">
        <h1>
            Side Menu
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Menu Management
            </small>
        </h1>
    </div>

    <div class="alert alert-block alert-success">
        <button type="button" class="close" data-dismiss="alert">
            <i class="ace-icon fa fa-times"></i>
        </button>

        <p>
            <strong>
                <i class="ace-icon fa fa-check"></i>
                Hands Up!
            </strong>
            This list is the <strong class="red">entire menus</strong>, If you want manage different user's menu, you can use another function called <strong>Distribution</strong>
        </p>
    </div>

    <div class="col-xs-12">
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
            <button type="button" data-action="save" class="btn btn-success btn-sm btn-next">
                Save
                <i class="ace-icon fa fa-plus"></i>
            </button>
        </menu>
    </div>

    {{--neastable js tree--}}
    <div class="col-xs-12">
        {{--<div class="dd dd-draghandle" id="nestableMenu">--}}
            {!! $menuTree !!}
        {{--</div>--}}
    </div>

    <div class="col-xs-12">
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
            <button type="button" data-action="save" class="btn btn-success btn-sm btn-next">
                Save
                <i class="ace-icon fa fa-plus"></i>
            </button>
        </menu>
    </div>

    <form method="post" id="updateOrderForm">
        {!! csrf_field() !!}
        <input id="menuJson" type="hidden">
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
            updateOutput($('#nestableMenu').data('output', $('#menuJson')));

            //making the link enable to click
            $('.dd-handle a').on('mousedown', function(e){
                e.stopPropagation();
            });

            $('.nestable-menu').on('click', function(e)
            {
                var target = $(e.target),
                    action = target.data('action');
                switch (action) {
                    case 'expand-all':
                        $('.dd').nestable('expandAll');
                        break;
                    case 'collapse-all':
                        $('.dd').nestable('collapseAll');
                        break;
                    case 'refresh':
                        window.location.reload();
                        break;
                    case 'save':
                        var saveLayer = layer.load(0, {
                            shade: [0.8, '#000000']
                        });
                        var options = {
                            type: 'POST',
                            url: "{{url('menuManagement/' . $tableName)}}/updateMenuTree",
                            data: {'menuJson':$('#menuJson').val()},
                            success: function (data) {
                                layer.close(saveLayer);
                                layer.alert(data, function () {
                                    window.location.reload();
                                });
                            }
                        };
                        $('#updateOrderForm').ajaxSubmit(options);
                        break;
                }
            });
        });

        //显示删除确认页面
        //show the confirmation page before deleting
        function showDeleting(url){
            layer.open({
                type: 2,
                title: 'Deleting',
                maxmin: true,
                shadeClose: true,
                area : ['80%' , '90%'],
                content: url
            });
        }

        //显示添加确认页面
        //show the confirmation page before adding
        function showAdding(url) {
            layer.open({
                type: 2,
                title: 'Adding',
                maxmin: true,
                shadeClose: true,
                area : ['80%' , '90%'],
                content: url
            });
        }

    </script>
@endsection