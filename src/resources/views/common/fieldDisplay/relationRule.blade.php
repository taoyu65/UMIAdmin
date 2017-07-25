@extends('umi::layouts.model')

@section('content')

    <?php $assetPath = url(config('umi.assets_path')) ?>
    <?php $path = url($assetPath . '/ace') ?>

    <div class="col-sm-12">
        <h3 class="header blue lighter smaller">
            <i class="ace-icon fa fa-gear smaller-90"></i>
            Generate Rules - {{isset($onlyShowRelationDisplay)&&$onlyShowRelationDisplay=='true'?'Foreign Key':'Drop Down Box'}}
        </h3>

        <div id="tabs">
            <ul>
                <li>
                    <a href="#tabs-1">Relation Display</a>
                </li>

                <li {{isset($onlyShowRelationDisplay)&&$onlyShowRelationDisplay=='true'?'hidden':''}}>
                    <a href="#tabs-2">Custom Value</a>
                </li>
            </ul>

            <div id="tabs-1">
                <div class="alert alert-block alert-danger">
                    <button type="button" class="close" data-dismiss="alert">
                        <i class="ace-icon fa fa-times"></i>
                    </button>
                    <p>
                        <strong>
                            <i class="ace-icon fa fa-check"></i>
                            Hands Up!
                        </strong>
                        Displaying a value that related another table's field to instead of original data. Rule<strong> must be: "TableName:FieldName"</strong>
                    </p>
                </div>
                {{-- relation display --}}
                <div class="col-xs-12">
                    <div class="">
                        <div class="widget-box widget-color-green">
                            <div class="widget-header">
                                <h5 class="widget-title bigger lighter bolder">Rule maker</h5>
                            </div>
                            <form class="form-horizontal" id="validation-form" method="post" action="#">
                                <div class="space-2"></div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2 no-padding-right" for="table_id">Select Table</label>
                                    <div class="col-sm-4">
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
                                <div class="form-group">
                                    <label class="control-label col-sm-2 no-padding-right" for="field">Table Field</label>
                                    <div class="col-sm-4">
                                        <div class="clearfix">
                                            <select class="form-control" id="field" name="field" required>
                                                <option value=""></option>
                                            </select>
                                            <div id="loadingField"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="space-2"></div>
                                <div class="clearfix form-actions text-center">
                                    <div class="col-xs-12">
                                        <button class="btn btn-success" type="button" id="generate_relation">
                                            <i class="ace-icon fa fa-check bigger-110"></i>
                                            Generate Rule
                                        </button>

                                        <button class="btn" type="button" id="close_relation">
                                            <i class="ace-icon fa fa-times bigger-110"></i>
                                            Close
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div id="tabs-2">
                <div class="alert alert-block alert-danger">
                    <button type="button" class="close" data-dismiss="alert">
                        <i class="ace-icon fa fa-times"></i>
                    </button>
                    <p>
                        <strong>
                            <i class="ace-icon fa fa-check"></i>
                            Hands Up!
                        </strong>
                        Customize a json (normally) that contains values to generate a input interface for a data type<strong></strong>
                    </p>
                </div>
                {{-- custom value --}}
                <div class="col-xs-12">
                    <div class="">
                        <div class="widget-box widget-color-orange">
                            <div class="widget-header">
                                <h5 class="widget-title bigger lighter bolder">Json maker</h5>
                            </div>
                            {{-- options table --}}
                            <form class="form-horizontal" id="validation-form" method="post" action="#">
                                <div class="space-2"></div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2 no-padding-right" for="ph">Place Holder</label>
                                    <div class="col-sm-4">
                                        <div class="clearfix">
                                            <input type="text" class="form-control" name="ph" id="ph" value="Please Select one...">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2 no-padding-right" for="ph">Option</label>
                                    <div class="col-sm-4">
                                        <table class="table" id="table">
                                            <thead>
                                            <tr>
                                                <th>value</th>
                                                <th>text</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr class="myRow" id="row1">
                                                <td><input type="text" class="form-control" name="ddValue" id="ddValue"></td>
                                                <td><input type="text" class="form-control" name="ddText" id="ddText"></td>
                                                <td>
                                                    <button type="button" class="btn btn-danger" id="delete">
                                                        <i class="fa fa-trash-o"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-xs-offset-2 col-xs-12">
                                        <button class="btn btn-success" type="button" id="add">
                                            <i class="fa fa-plus"></i>
                                            Add Option
                                        </button>
                                    </div>
                                </div>

                                <div class="clearfix form-actions text-center">
                                    <div class="col-xs-12">
                                        <button class="btn btn-yellow" type="button" id="generate_customValue">
                                            <i class="ace-icon fa fa-check bigger-110"></i>
                                            Generate Rule
                                        </button>

                                        <button class="btn" type="button" id="close_generation">
                                            <i class="ace-icon fa fa-times bigger-110"></i>
                                            Close
                                        </button>
                                    </div>
                                </div>
                                <div class="space-2"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{$path}}/js/jquery.validate.min.js"></script>
    <script src="{{$path}}/js/jquery-ui.min.js"></script>

    <script type="text/javascript">

        $( "#tabs" ).tabs();

        $(document).ready(function () {

            $('#validation-form').validate({
                errorClass: 'red'
            });
//region relation display
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

            $('#generate_relation').click(function () {

                var tableName = $('#tableName').find("option:selected").text();
                var fieldName = $('#field').find("option:selected").text();
                var rule = tableName + ":" + fieldName;

                if (tableName !== '' && fieldName !== '') {
                    parent.$('#{{$relationDisplayDomId}}').val(rule);
                    parent.layer.closeAll();
                } else {
                    layer.alert('Table name and Field Name can not be empty', '');
                }
            });

            $('#close_relation').click(function () {
                parent.$('#{{$relationDisplayDomId}}').val('');
                parent.$('#type').val('');
                parent.layer.closeAll();
            });
//endregion

//region custom value
            $('#add').click(function () {
                var table = $('#table');
                var tr = table.find('tr').filter('.myRow').first();
                var trClone = tr.clone(true);
                var count = $('#table tr').filter('.myRow').size() + 1;
                trClone.attr('id', 'row' + count);
                trClone.appendTo(table);
                trClone.find('#ddValue').val('');
                trClone.find('#ddText').val('');
            });

            $('#delete').click(function () {
                var count = $('#table tr').filter('.myRow').size();
                if (count === 1) {
                    layer.alert('Keep one at least', 'Wrong');
                    return false;
                }
                var tr = $(this).parent('td').parent('tr');
                tr.remove();
            });

            $('#generate_customValue').click(function () {
                var trs = $('#table').find('tr').filter('.myRow');
                var json = '';
                var placeholder = $('#ph').val();
                var optionsArr = [];
                var returnObj = {};
                var typeObj = {};
                trs.each(function () {
                    var o = {};
                    o.value = $(this).find('#ddValue').val();
                    o.text =$(this).find('#ddText').val();
                    optionsArr.push(o);
                });
                typeObj.placeholder = placeholder;
                typeObj.option = optionsArr;
                returnObj.dropDownBox = typeObj;
                var jsonString = JSON.stringify(returnObj);
                parent.$('#{{$customValueDomId}}').val(jsonString);
                parent.layer.closeAll();
            });

            $('#close_generation').click(function () {
                parent.$('#{{$relationDisplayDomId}}').val('');
                parent.$('#type').val('');
                parent.layer.closeAll();
            });
//endregion
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