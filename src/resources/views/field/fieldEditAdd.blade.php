@extends('umi::layouts.master')

@section('content')

    <?php $assetPath = config('umi.assets_path') ?>
    <?php $path = $assetPath . '/ace' ?>

    <div class="page-header">
        <h1>
            Field
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Field Display Management
            </small>
        </h1>
    </div>

    {{--<div class="alert alert-block alert-success">
        <button type="button" class="close" data-dismiss="alert">
            <i class="ace-icon fa fa-times"></i>
        </button>
        <p>
            <strong>
                <i class="ace-icon fa fa-check"></i>
                Hands Up!
            </strong>
            ***<strong>*****</strong>
        </p>
    </div>--}}

    <div class="col-xs-12">
        <p>
            <button class="btn btn-success large btn-round width-10 disabled">Browser <i class="fa fa-eye"></i></button>
            <button class="btn btn-primary btn-round width-10">Read <i class="fa fa-book"></i></button>
            <button class="btn btn-yellow btn-round width-10">Edit <i class="fa fa-pencil-square-o"></i></button>
            <button class="btn btn-purple btn-round width-10">Add <i class="fa fa-plus"></i></button>
        </p>
    </div>

    <div class="col-xs-12">
        <div class="">
            <div class="widget-box widget-color-green">
                <div class="widget-header">
                    <h5 class="widget-title bigger lighter bolder">Browser</h5>
                </div>
                <form class="form-horizontal" id="validation-form" method="post" action="">
                    <div class="widget-body">
                        <div class="widget-main no-padding">
                            <div class="col-xs-12">
                                <div class="space-2"></div>
                                <div class="form-group">
                                    <label class="control-label col-xs-12 col-sm-1 no-padding-right" for="activeTable">Select Table</label>
                                    <div class="col-xs-12 col-sm-4">
                                        <div class="clearfix">
                                            <select class="form-control" id="tableName" name="tableName">
                                                <option value="">Please select a table</option>
                                                @foreach($tableList as $item)
                                                    <option value="{{$item->id}}">{{$item->table_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-3">
                                        <button type="button" class="btn btn-sm btn-round btn-pink" id="quickAdd"
                                                data-rel="tooltip" data-placement="right" title="Fill up all missing fields">Quick Add</button>
                                    </div>
                                </div>
                                <div class="space-2"></div>
                                <div id="fieldDisplay">

                                </div>
                            </div>
                        </div>
                        <div>
                            <a href="#" class="btn btn-block btn-sm btn-success bolder">
                                <span>Add Field</span>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            //刷新当前页面是保持数据显示
            //keep data display when refresh page
            var tableId = $('#tableName').val();
            var url = "{{url('fieldDisplay')}}/{{$table}}/id/";
            if (tableId !== '') {
                //加载符号
                //showing loading icon
                $('#fieldDisplay').html("<i id='responseLoading' class='ace-icon fa fa-spinner fa-spin orange bigger-170'></i>");
                loadTable(url + tableId);
            }

            $('#tableName').change(function () {
                if ($(this).val() === '') {
                    return false;
                }

                //加载符号
                //showing loading icon
                $('#fieldDisplay').html("<i id='responseLoading' class='ace-icon fa fa-spinner fa-spin orange bigger-170'></i>");

                tableId = $(this).val();
                loadTable(url + tableId);
            });

            $('[data-rel=tooltip]').tooltip();
            $('[data-rel=popover]').popover({html:true});

            //快速添加字段
            //quick add
            $('#quickAdd').click(function () {
                $(this).blur();
                var tableId = $('#tableName').val();
                if (tableId === '') {
                    layer.alert('Please select a table', {title: 'Wrong'});
                    return;
                }
                layer.confirm('All the fields will be added by default setting<br> except the fields already exist',
                    {
                        btn: ['Add', 'Cancel'],
                        title: 'Sure?'
                    },
                    function () {
                        layer.closeAll();
                        var load = layer.load(3, {shade: [0.5, '#000']});
                        var existFields = $('#existFields').val();
                        var url = "{{url('fieldDisplay')}}/{{$table}}/quickAdd/" + existFields + "/" + tableId;
                        $.ajax({
                            type: 'get',
                            url: url,
                            success: function (data) {
                                layer.close(load);
                                if (data === '0') {
                                    layer.alert('Nothing Added!');
                                } else {
                                    layer.alert(data + ' records had been added', function () {
                                        window.location.reload();
                                    });
                                }
                            },
                            error: function () {
                                layer.close(load);
                                layer.alert('Request failed, please try it again', {title: 'Wrong'});
                            }
                        });
                    },
                    function () {
                    }
                );
            });
        });

        //删除记录 (默认不带关联删除, 可以附带参数进行关联删除)
        //delete record (no related operation as default, can add parameter for relation operation
        function recordDelete(tableName, tableId) {
            var url = "{{url('deleting')}}/" + tableName + '/' + tableId;
            var delConfirm = layer.open ({
                type: 2,
                title: 'Deleting',
                maxmin: true,
                shadeClose: true,
                area : ['800px' , '520px'],
                content: url
            });
        }

        //更新记录
        //update record
        function recordEdit(tableName, tableId) {
            //todo - edit need to be completed
        }

        //加载数据当选择表名的时候
        //load data when select table name
        function loadTable(url) {
            $.ajax({
                type: 'get',
                url: url,
                success: function (data) {
                    $('#fieldDisplay').html(data);
                },
                error: function () {
                    $('#fieldDisplay').html('loading error');
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
                area: ['800px', '520px'],
                content: url
            });
        }
    </script>
@endsection