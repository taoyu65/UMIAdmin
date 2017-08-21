@extends('umi::layouts.model')

@section('content')

    <?php $assetPath = url(config('umi.assets_path')) ?>
    <?php $path = url($assetPath . '/lte') ?>

    <link rel="stylesheet" href="{{$path}}/bower_components/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="{{$path}}/dist/css/AdminLTE.min.css">

    <div class="col-sm-12">
        <div class="box box-primary with-border">
            <div class="box-header">
                <h4 class="box-title text-primary"><i class="fa fa-gear fa-primary"></i> {{trans('umiTrans::popupWindow.generateRule')}}</h4>
            </div>
            <div class="box-body">
                <div class="col-xs-12">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="tableName">{{trans('umiTrans::popupWindow.tableName')}}</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="tableName" required>
                                    <option value="">{{trans('umiTrans::popupWindow.selectTable')}}</option>
                                    @foreach($table as $item => $value)
                                        <option value="{{$item}}">{{$item}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="returnField">{{trans('umiTrans::popupWindow.returnField')}}</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="returnField" name="returnField" required>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="searchField">{{trans('umiTrans::popupWindow.searchField')}}</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="searchField" name="searchField" required>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="showField">{{trans('umiTrans::popupWindow.showField')}}</label>
                            <div class="col-sm-4" id="showFieldParent">
                                <select class="form-control select2" id="showField" multiple="multiple" data-placeholder="{{trans('umiTrans::popupWindow.chooseField')}}">

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2"></label>
                            <div class="col-sm-4">
                                <button type="button" class="btn btn-primary btn-flat" id="generate">{{trans('umiTrans::popupWindow.generateRole')}}</button>
                                <button type="button" class="btn btn-danger btn-flat" id="close">{{trans('umiTrans::popupWindow.close')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{$path}}/bower_components/select2/dist/js/select2.full.min.js"></script>

    <script type="text/javascript">

        $(document).ready(function () {
            $('#close').click(function () {
                parent.layer.closeAll();
            });

            $('#generate').click(function () {
                var obj = Object();
                obj.tableName = $('#tableName').val();
                obj.returnField = $('#returnField').val();
                obj.searchField = $('#searchField').val();
                obj.showFields = $('#showField').val();
                if (obj.returnField === null || obj.showFields === null) {
                    layer.alert('return and show field can not be empty!', {title: 'wrong'});
                    return false;
                }
                var returnJson = JSON.stringify(obj);
                parent.$('#{{$customValueDomId}}').val(returnJson);
                parent.layer.closeAll();
            });

            $('#tableName').change(function () {

                if ($(this).val() === '') {
                    return false;
                }

                var load = layer.load(3, {shade: [0.5, '#000']});
                //var tableId = $(this).val();
                var tableName = $(this).find("option:selected").text();
                var url = "{{url('api/fields')}}/" + tableName;

                $.ajax({
                    type: 'get',
                    url: url,
                    success: function (data) {
                        $('#showFieldParent').empty();
                        data = JSON.parse(data);
                        $('#showFieldParent').append('<select multiple="multiple" class="form-control select2" id="showField" data-placeholder="Choose Fields...">');
                        $.each(data, function (value, text) {
                            $('#showField').append("<option value='" + text + "'>" + text + "</option>");
                        });
                        $('#showFieldParent').append('</select>');
                        $('.select2').select2();

                        //复制获得的所有字段
                        //clone all the fields
                        var cloneFields = $('#showField option').clone();
                        var cloneFields2 = $('#showField option').clone();

                        $('#returnField').empty();
                        cloneFields.appendTo($('#returnField'));

                        $('#searchField').empty();
                        cloneFields2.appendTo($('#searchField'));

                    },
                    error: function () {
                        layer.alert('Something went wrong!', {title: ''});
                    },
                    complete: function () {
                        layer.close(load);
                    }
                });
            });
        });
    </script>
@endsection