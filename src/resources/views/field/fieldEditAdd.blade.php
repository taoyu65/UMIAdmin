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
                                    <label class="control-label col-xs-12 col-sm-1 no-padding-right" for="table_id">Select Table</label>
                                    <div class="col-xs-12 col-sm-4">
                                        <div class="clearfix">
                                            <select class="form-control" id="tableName" name="table_id" required title="Please select a table">
                                                <option value=""></option>
                                                @foreach($tableList as $item)
                                                    <option value="{{$item->id}}">{{$item->table_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <button type="button" class="btn btn-sm btn-round btn-pink" id="quickAdd"
                                                data-rel="tooltip" data-placement="bottom" title="Fill up all missing fields">
                                            Quick Add
                                            <i class="fa fa-bolt"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-round btn-default btn-inverse" id="hideQuickAdd">
                                            Hide Fields
                                            <i class="fa fa-eye-slash"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-round btn-light" id="showQuickAdd">
                                            Show Fields
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="space-2"></div>
                            </div>
                            <div class="col-xs-12">
                                <div id="fieldDisplay">
                                </div>

                                <div class="hr hr-dotted"></div>
                                <div class="space-2"></div>
                            </div>
                            <div class="col-xs-12">

                                {{-- drop down box for selecting field --}}
                                @include('umi::common.fieldDisplay.fieldsDropDownBox')

                                <div class="form-group">
                                    <label class="control-label col-xs-12 col-sm-1 no-padding-right" for="activeTable">Data Type</label>
                                    <div class="col-xs-12 col-sm-4">
                                        <div class="clearfix">
                                            <select class="form-control" name="type" id="type">
                                                <option value=''>Please select a Type</option>
                                                @foreach($dataTypes as $key => $value)
                                                    <option value="{{$key}}"
                                                            relation_display="{{$value['relation_display']}}"
                                                            custom_value="{{$value['custom_value']}}"
                                                    >{{$key}}</option>
                                                    {{--todo - now has new data type array, analyz and oupput different option load different function--}}
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-xs-12 col-sm-1 no-padding-right" for="activeTable">Relation Rule</label>
                                    <div class="col-xs-12 col-sm-4">
                                        <div class="clearfix">
                                            <input class="form-control" name="relation_display">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div>
                            <button class="btn btn-block btn-sm btn-success bolder" type="submit"><span class="bolder">Add Field</span></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{$path}}/js/jquery.validate.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {

            //初始化
            //init
            $("#type").val('');

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

                $("#type").val('');

                if ($(this).val() === '') {
                    return false;
                }

                //加载符号
                //showing loading icon
                $('#fieldDisplay').html("<i id='responseLoading' class='ace-icon fa fa-spinner fa-spin orange bigger-170'></i>");
                tableId = $(this).val();
                loadTable(url + tableId);
            });

            //选择数据类型
            //select data type
            $('#type').change(function () {

                //badge类型比较特殊, 需要和badge数据表协同完成badge显示, 所以规则字段必须默认是 "表名:字段名"
                //badge type is special, need to complete the function working with badge table, so the rule must be: "table name: field name"
                if ($(this).val() === 'badge') {
                    var tableName = $("#tableName").find("option:selected").text();
                    var fieldName = $("#field").find("option:selected").text();

                    if (tableName === '' || fieldName === '') {
                        layer.alert('For badge: table name and field name can not be empty', '');
                        $("#type").val('');
                        return;
                    }

                    alert(tableName + ":" + fieldName);
                    $('#relation_display').val();
                    return;
                }

                var relation_display = $(this).find("option:selected").attr("relation_display");
                var custom_value = $(this).find("option:selected").attr("custom_value");


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

                        //确认执行快速添加字段
                        //confirm to quick add fields
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

            //隐藏 查询出的字段列表
            //hide all fields list from selecting table name
            $('#hideQuickAdd').click(function () {
                $('#fieldDisplay').slideUp();
            });

            //显示 查询出的字段列表
            //show all fields list from selecting table name
            $('#showQuickAdd').click(function () {
                $('#fieldDisplay').slideDown();
            });

            $('#validation-form').validate({
                errorClass: "red"
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
                    $('#fieldDisplay').html(data).hide().slideDown(2000,function () {});
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