@extends('umi::layouts.master')

@section('content')

    <?php $assetPath = config('umi.assets_path') ?>
    <?php $path = $assetPath . '/ace' ?>

    <div class="page-header">
        <h1>
            Authority
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Authority Management
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
                                </div>
                                <div class="space-2"></div>
                                <div id="fieldDisplay">

                                </div>
                            </div>
                        </div>
                        <div>
                            <a href="#" class="btn btn-block btn-sm btn-success">
                                <span>Insert</span>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        //$(document).ready(function(){
            $('#tableName').change(function () {
                if ($('#tableName').val() === ''){
                    return false;
                }

                //加载符号
                //showing loading icon
                $('#fieldDisplay').html("<i id='responseLoading' class='ace-icon fa fa-spinner fa-spin orange bigger-170'></i>");

                var tableId = $('#tableName').val();
                var url = "{{url('authority/')}}/{{$table}}/id/" + tableId;

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
            });
        //});

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