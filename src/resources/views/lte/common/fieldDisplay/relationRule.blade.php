@extends('umi::layouts.model')

@section('content')

    <?php $assetPath = url(config('umi.assets_path')) ?>
    <?php $path = url($assetPath . '/lte') ?>

    <div class="col-sm-12">
        <div class="box box-primary">
            <div class="box-header">
                <h4 class="box-title text-primary">
                    <i class="fa fa-gear smaller-90"></i>
                    {{trans('umiTrans::fieldDisplay.generateRule')}} - {{isset($onlyShowRelationDisplay)&&$onlyShowRelationDisplay=='true'?trans('umiTrans::fieldDisplay.foreignKey'):trans('umiTrans::fieldDisplay.dropDownBox')}}
                </h4>
            </div>
            <div class="box-body">
                <div id="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#tabs-1" data-toggle="tab">{{trans('umiTrans::fieldDisplay.relationDisplay')}}</a>
                        </li>
                        <li {{isset($onlyShowRelationDisplay)&&$onlyShowRelationDisplay=='true'?'hidden':''}}>
                            <a href="#tabs-2" data-toggle="tab">{{trans('umiTrans::fieldDisplay.customValue')}}</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1"><br/>
                            <div class="alert alert-danger-light alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <p>
                                    <strong>
                                        <i class="fa fa-exclamation-circle"></i>
                                        {{trans('umiTrans::fieldDisplay.handsUp')}}
                                    </strong>
                                    {!! trans('umiTrans::fieldDisplay.tip3') !!}
                                </p>
                            </div>
                            {{-- relation display --}}
                            <div class="col-sm-12">
                                <div class="box box-primary box-solid">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">{{trans('umiTrans::fieldDisplay.ruleMaker')}}</h3>
                                    </div>
                                    <div class="box-body">
                                        <form class="form-horizontal" id="validation-form" action="#">
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="table_id">{{trans('umiTrans::fieldDisplay.selectTable')}}</label>
                                                <div class="col-sm-4">
                                                    <select class="form-control" id="tableName" name="table_id" required title="{{trans('umiTrans::fieldDisplay.pleaseSelectTable')}}">
                                                        <option value=""></option>
                                                        @foreach($tableList as $item)
                                                            <option value="{{$item->id}}">{{$item->table_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="field">{{trans('umiTrans::fieldDisplay.tableField')}}</label>
                                                <div class="col-sm-4">
                                                    <select class="form-control" id="field" name="field" required>
                                                        <option value=""></option>
                                                    </select>
                                                    {{--<div id="loadingField"></div>--}}
                                                </div>
                                            </div>

                                            <div class="text-center">
                                                <div class="col-sm-12">
                                                    <button class="btn btn-primary btn-flat" type="button" id="generate_relation">
                                                        <i class="fa fa-check"></i>
                                                        {{trans('umiTrans::fieldDisplay.generateRule')}}
                                                    </button>

                                                    <button class="btn btn-danger btn-flat" type="button" id="close_relation">
                                                        <i class="fa fa-times"></i>
                                                        {{trans('umiTrans::fieldDisplay.close')}}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="overlay" hidden>
                                        <i class="fa fa-refresh fa-spin fa-orange"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="tabs-2"><br/>
                            <div class="alert alert-danger-light alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <p>
                                    <strong>
                                        <i class="fa fa-exclamation-circle"></i>
                                        {{trans('umiTrans::fieldDisplay.handsUp')}}
                                    </strong>
                                    {{trans('umiTrans::fieldDisplay.tip4')}}
                                </p>
                            </div>
                            {{-- custom value --}}
                            <div class="col-sm-12">
                                <div class="box box-primary box-solid">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">{{trans('umiTrans::fieldDisplay.jsonMaker')}}</h3>
                                    </div>
                                    <div class="box-body">
                                        <form class="form-horizontal" id="validation-form" action="#">
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="ph">{{trans('umiTrans::fieldDisplay.placeHolder')}}</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" name="ph" id="ph" value="{{trans('umiTrans::fieldDisplay.pleaseSelectOne')}}">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="ph">{{trans('umiTrans::fieldDisplay.option')}}</label>
                                                <div class="col-sm-4">
                                                    <table class="table" id="table">
                                                        <thead>
                                                        <tr>
                                                            <th>{{trans('umiTrans::fieldDisplay.value')}}</th>
                                                            <th>{{trans('umiTrans::fieldDisplay.text')}}</th>
                                                            <th></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr class="myRow" id="row1">
                                                            <td><input type="text" class="form-control" name="ddValue" id="ddValue"></td>
                                                            <td><input type="text" class="form-control" name="ddText" id="ddText"></td>
                                                            <td>
                                                                <button type="button" class="btn btn-danger btn-flat" id="delete">
                                                                    <i class="fa fa-trash-o"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-sm-offset-2 col-sm-12">
                                                    <button class="btn btn-success btn-flat" type="button" id="add">
                                                        <i class="fa fa-plus"></i>
                                                        {{trans('umiTrans::fieldDisplay.addOption')}}
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="text-center">
                                                <div class="col-sm-12">
                                                    <button class="btn btn-primary btn-flat" type="button" id="generate_customValue">
                                                        <i class="fa fa-check"></i>
                                                        {{trans('umiTrans::fieldDisplay.generateRule')}}
                                                    </button>

                                                    <button class="btn btn-danger btn-flat" type="button" id="close_generation">
                                                        <i class="fa fa-times"></i>
                                                        {{trans('umiTrans::fieldDisplay.close')}}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{$assetPath}}/js/jquery.validate.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {

            $('#validation-form').validate({
                errorClass: 'fa-red'
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
                //$('#loadingField').html("<i id='responseLoading' class='fa fa-spinner fa-spin fa-orange'></i>");
                $('.overlay').show();
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
                var count = table.find('tr').filter('.myRow').length + 1;
                trClone.attr('id', 'row' + count);
                trClone.appendTo(table);
                trClone.find('#ddValue').val('');
                trClone.find('#ddText').val('');
            });

            $('#delete').click(function () {
                var count = $('#table tr').filter('.myRow').length;
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
                    //$('#loadingField').html('');
                    data = JSON.parse(data);
                    $.each(data, function (value, text) {
                        $('#field').append("<option value='" + value + "'>" + text + "</option>");
                    });
                },
                error: function () {
                    $('#field').val('');
                    $('#loadingField').html('loading error');
                    $('.overlay').hide();
                },
                complete: function () {
                    $('.overlay').hide();
                }
            });
        }
    </script>
@endsection