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
            This list is the entire menus, If you want manage different user's menu, you can use another function called <strong>Distribution</strong>
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
        {{--<div class="dd" id="nestable3">
            <ol class='dd-list dd3-list'>
                <div id="dd-empty-placeholder"></div>
            </ol>
        </div>--}}

        {!! $menuTree !!}

        {{--<div class="dd dd-draghandle">
            <ol class="dd-list">
                <li class="dd-item dd2-item" data-id="13">
                    <div class="dd-handle dd2-handle">
                        <i class="normal-icon ace-icon fa fa-comments blue bigger-130"></i>

                        <i class="drag-icon ace-icon fa fa-arrows bigger-125"></i>
                    </div>
                    <div class="dd2-content">
                        Click on an icon to start dragging
                        <div class="pull-right action-buttons">
                            <a class="green" href="#">
                                <i class="ace-icon fa fa-plus bigger-130"></i>
                            </a>
                            <a class="orange" href="#">
                                <i class="ace-icon fa fa-eye bigger-130"></i>
                            </a>
                            <a class="blue" href="#">
                                <i class="ace-icon fa fa-pencil bigger-130"></i>
                            </a>
                            <a class="red" href="#" onclick="showDeleting('{{url('deleting/post/8')}}')">
                                <i class="ace-icon fa fa-trash-o bigger-130"></i>
                            </a>
                        </div>
                    </div>
                </li>

                <li class="dd-item dd2-item" data-id="14">
                    <div class="dd-handle dd2-handle">
                        <i class="normal-icon ace-icon fa fa-clock-o pink bigger-130"></i>

                        <i class="drag-icon ace-icon fa fa-arrows bigger-125"></i>
                    </div>
                    <div class="dd2-content">Recent Posts</div>
                </li>

                <li class="dd-item dd2-item" data-id="15">
                    <div class="dd-handle dd2-handle">
                        <i class="normal-icon ace-icon fa fa-signal orange bigger-130"></i>

                        <i class="drag-icon ace-icon fa fa-arrows bigger-125"></i>
                    </div>
                    <div class="dd2-content">Statistics</div>

                    <ol class="dd-list">
                        <li class="dd-item dd2-item" data-id="16">
                            <div class="dd-handle dd2-handle">
                                <i class="normal-icon ace-icon fa fa-user red bigger-130"></i>

                                <i class="drag-icon ace-icon fa fa-arrows bigger-125"></i>
                            </div>
                            <div class="dd2-content">Active Users</div>
                        </li>

                        <li class="dd-item dd2-item dd-colored" data-id="17">
                            <div class="dd-handle dd2-handle btn-info">
                                <i class="normal-icon ace-icon fa fa-pencil-square-o bigger-130"></i>

                                <i class="drag-icon ace-icon fa fa-arrows bigger-125"></i>
                            </div>
                            <div class="dd2-content btn-info no-hover">Published Articles</div>
                        </li>

                        <li class="dd-item dd2-item" data-id="18">
                            <div class="dd-handle dd2-handle">
                                <i class="normal-icon ace-icon fa fa-eye green bigger-130"></i>

                                <i class="drag-icon ace-icon fa fa-arrows bigger-125"></i>
                            </div>
                            <div class="dd2-content">Visitors</div>
                        </li>
                    </ol>
                </li>

                <li class="dd-item dd2-item" data-id="19">
                    <div class="dd-handle dd2-handle">
                        <i class="normal-icon ace-icon fa fa-bars blue bigger-130"></i>

                        <i class="drag-icon ace-icon fa fa-arrows bigger-125"></i>
                    </div>
                    <div class="dd2-content">Menu</div>
                </li>
            </ol>
        </div>--}}
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

    <form action="" method="post">
        <textarea id="menuJson"></textarea>
    </form>

    <script src="{{$path}}/js/jquery.nestable.min.js"></script>
    <script type="text/javascript">
        function test(){
            $('#op').html('ads');
            var o = $('.dd').nestable('toArray');
            //document.write($('.dd').nestable('toArray'));
            for (var i in o){
                alert(i);            // 输出属性名：  attribute，method
                alert(o[i])        // 输出属性的值：1和函数的内容
                alert(o["method"]);// 输出指定的值：如果只知道属性的几个字母，那么可以结合正则表达式输出这个属性
            }
        }

        $(document).ready(function(){
           /* var obj = '[{"id":1},{"id":2},{"id":3,"children":[{"id":4},{"id":5}]}]';
            //var obj = '';
            var output = '';
            function buildItem(item) {

                var html = "<li class='dd-item' data-id='" + item.id + "'>";
                html += "<div class='dd-handle'>" + item.id + "</div>";

                if (item.children) {

                    html += "<ol class='dd-list'>";
                    $.each(item.children, function (index, sub) {
                        html += buildItem(sub);
                    });
                    html += "</ol>";

                }

                html += "</li>";

                return html;
            }*/
            //var a = ' ';

           /* $.each(JSON.parse(obj), function (index, item) {
                output += buildItem(item);

            });*/

            //$('#dd-empty-placeholder').html(output);
            //$('#nestable3').nestable();

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
            //$('.dd').nestable('collapseAll');
            //making link enable to click
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
                        updateMenuOrder();
                        break;
                }
            });
        });

        function updateMenuOrder() {
            layer.load(0, {
                shade: [0.8, '#000000']
            });
            $.ajax({
                url: "{{url('menuManagement/updateOrder')}}",
                success: function () {

                },
                error: function () {

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
                area : ['800px' , '520px'],
                content: url
            });
        }

    </script>
@endsection