@extends('umi::layouts.model')

@section('content')

    <?php $assetPath = config('umi.assets_path') ?>
    <?php $path = $assetPath . '/ace' ?>

    <div class="alert alert-block alert-success">
        <button type="button" class="close" data-dismiss="alert">
            <i class="ace-icon fa fa-times"></i>
        </button>
        <p>
            <strong>
                <i class="ace-icon fa fa-check"></i>
                Hands Up!
            </strong>
            Display which Field's value from another table will be showing instead of original data. Rule is: <strong>"TableName:FieldName"</strong>
        </p>
    </div>

    <div class="col-xs-12">
        <div class="">
            <div class="widget-box widget-color-green">
                <div class="widget-header">
                    <h5 class="widget-title bigger lighter bolder">Browser</h5>
                </div>
                <form class="form-horizontal" id="validation-form" method="post" action="#">
                    <div class="col-xs-12">
                        <div class="space-2"></div>
                        <div class="form-group">
                            <label class="control-label col-xs-12 col-sm-2 no-padding-right" for="table_id">Select Table</label>
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
                        </div>
                        <div class="space-2"></div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-2 no-padding-right" for="field">Table Field</label>
                        <div class="col-xs-12 col-sm-4">
                            <div class="clearfix">
                                <select class="form-control" id="field" name="field" required>
                                    <option value=""></option>
                                </select>
                                <div id="loadingField"></div>
                            </div>
                        </div>
                    </div>
                    <div class="space-2"></div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="text-center col-sm-2">
                                <button class="btn btn-success btn-round" type="button" id="generate">Generate Rule</button>
                            </div>
                            <div class="text-center col-sm-2">
                                <button class="btn btn-danger btn-round" type="button" id="close">Close</button>
                            </div>
                        </div>
                    </div>
                    <div class="space-2"></div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{$path}}/js/jquery.validate.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {

            $('#validation-form').validate({
                errorClass: 'red'
            });

            //选择table
            //select table
            $('#tableName').change(function () {

                if ($(this).val() === '') {
                    return false;
                }

                //加载符号
                //showing loading icon
                $('#loadingField').html("<i id='responseLoading' class='ace-icon fa fa-spinner fa-spin orange bigger-170'></i>");
                var tableName = $(this).find("option:selected").text();

                loadTable("{{url('api/fields')}}/" + tableName);
            });

            $('#generate').click(function () {

                var tableName = $('#tableName').find("option:selected").text();
                var fieldName = $('#field').find("option:selected").text();
                var rule = tableName + ":" + fieldName;

                if (tableName !== '' && fieldName !== '') {
                    parent.$('#{{$returnedDomId}}').val(rule);
                    parent.layer.closeAll();
                } else {
                    layer.alert('Table name and Field Name can not be empty', '');
                }
            });

            $('#close').click(function () {
                parent.$('#{{$returnedDomId}}').val('');
                parent.$('#type').val('');
                parent.layer.closeAll();
            });
        });

        //加载数据当选择表名的时候
        //load data when select table name
        function loadTable(url) {
            $.ajax({
                type: 'get',
                url: url,
                success: function (data) {
                    //填充数据
                    //fill in data
                    $('#field option').remove();
                    $('#loadingField').html('');
                    data = JSON.parse(data);
                    $.each(data, function (value, text) {
                        $('#field').append("<option value='" + value + "'>" + text + "</option>");
                    });
                },
                error: function () {
                    $('#field').val('');
                    $('#loadingField').html('loading error');
                }
            });
        }
    </script>
@endsection