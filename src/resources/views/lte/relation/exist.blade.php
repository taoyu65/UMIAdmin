@extends('umi::layouts.master')

@section('content')

    <?php $assetPath = url(config('umi.assets_path')) ?>
    <?php $path = url($assetPath . '/ace') ?>

    <div class="page-header">
        <h1>
            {{trans('umiTrans::relation.relationOperation')}}
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                {{trans('umiTrans::relation.selectAdd')}}
                <i class="ace-icon fa fa-angle-double-right"></i>
                {{trans('umiTrans::relation.exist')}}
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
                {{trans('umiTrans::relation.handsUp')}}
            </strong>
            {{trans('umiTrans::relation.turnOff')}}<br>
            <span class="red2"><strong>{{trans('umiTrans::relation.functionDescription2')}}</strong></span>
        </p>
    </div>

    <div class="col-xs-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title">
                    {{trans('umiTrans::relation.tooltip')}}
                    <small>{{trans('umiTrans::relation.exitOperation')}}</small>
                </h4>
                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-up"></i>
                    </a>

                    <a href="#" data-action="close">
                        <i class="ace-icon fa fa-times"></i>
                    </a>
                </div>
            </div>

            <div class="widget-body">
                <div class="widget-main">
                    <p class="muted">
                        {!! trans('umiTrans::relation.existExplain') !!}
                    </p>
                </div>
            </div>
        </div>
    </div>&nbsp
    <div class="hr hr-dotted"></div>

    <form class="form-horizontal" id="validation-form" method="post" action="{{url('relationOpe') . '/' . $currentTableName . '/add'}}">

        {!! csrf_field() !!}
        <input type="hidden" name="rule_name" value="exist">
        {{--<input type="hidden" name="operation_type" value="delete">--}}
        <input type="hidden" name="is_extra_operation" value="0">

        {{--custom rule name--}}
        <div class="form-group">
            <label class="control-label col-xs-12 col-sm-1 no-padding-right" for="operationType">{{trans('umiTrans::relation.action')}}</label>
            <div class="col-xs-12 col-sm-4">
                <div class="clearfix">
                    <select class="form-control" id="operationType" name="operationType">
                        <option value="">{{trans('umiTrans::relation.operationType')}}</option>
                        <option value="edit">Edit</option>
                        <option value="delete">Delete</option>
                    </select>
                </div>
            </div>
            <i class="fa fa-question-circle fa-lg popover-info blue" aria-hidden="true" data-rel="popover"
               data-trigger="hover" style="transform: translate(0,4px);" data-placement="auto right"
               title="Operation Type"
               data-content="{{trans('umiTrans::relation.actionInfo')}}"></i>
        </div>

        <div class="hr hr-dotted"></div>
        <div class="space-2"></div>

        {{--active table--}}
        <div class="form-group">
            <label class="control-label col-xs-12 col-sm-1 no-padding-right" for="activeTable">{{trans('umiTrans::relation.activeTable')}}</label>
            <div class="col-xs-12 col-sm-4">
                <select id="activeTable" name="activeTable" class="chosen-select form-control" data-placeholder="{{trans('umiTrans::relation.choose')}}">
                    <option value="">&nbsp;</option>
                    @foreach($tableNames as $tableName => $tableId)
                        <option value="{{$tableId}}">{{$tableName}}</option>
                    @endforeach
                </select>
            </div>
            <i class="fa fa-question-circle fa-lg popover-info blue" aria-hidden="true" data-rel="popover"
               data-trigger="hover" style="transform: translate(0,4px);" data-placement="auto right"
               title="Active Table"
               data-content="{{trans('umiTrans::relation.activeTableInfo')}}"></i>
        </div>

        <div class="space-2"></div>

        <div class="form-group">
            <label class="control-label col-xs-12 col-sm-1 no-padding-right" for="responseTable">{{trans('umiTrans::relation.activeField')}} </label>
            <div class="col-xs-12 col-sm-4">
                <div class="clearfix">
                    <select class="form-control" id="activeField" name="activeField">
                        <option value="">{{trans('umiTrans::relation.selectActiveTable')}}</option>
                    </select>
                </div>
            </div>
            <i class="fa fa-question-circle fa-lg popover-info blue" aria-hidden="true" data-rel="popover"
               data-trigger="hover" style="transform: translate(0,4px);" data-placement="auto right"
               title="Active Field"
               data-content="{{trans('umiTrans::relation.activeFieldInfo')}}"></i>
        </div>

        <div class="hr hr-dotted"></div>
        <div class="space-2"></div>

        {{--response table--}}
        <div class="form-group">
            <label class="control-label col-xs-12 col-sm-1 no-padding-right" for="responseTable">{{trans('umiTrans::relation.responseTable')}}</label>
            <div class="col-xs-12 col-sm-4">
                <select id="responseTable" name="responseTable" class="chosen-select form-control" data-placeholder="{{trans('umiTrans::relation.choose')}}">
                    <option value="">&nbsp;</option>
                    @foreach($tableNames as $tableName => $tableId)
                        <option value="{{$tableId}}">{{$tableName}}</option>
                    @endforeach
                </select>
            </div>
            <i class="fa fa-question-circle fa-lg popover-info blue" aria-hidden="true" data-rel="popover"
               data-trigger="hover" style="transform: translate(0,4px);" data-placement="auto right"
               title="Response Table"
               data-content="{{trans('umiTrans::relation.responseTableInfo')}}"></i>
        </div>

        <div class="space-2"></div>

        <div class="form-group">
            <label class="control-label col-xs-12 col-sm-1 no-padding-right" for="responseField">{{trans('umiTrans::relation.responseField')}}</label>
            <div class="col-xs-12 col-sm-4">
                <div class="clearfix">
                    <select class="form-control" id="responseField" name="responseField">
                        <option value="">{{trans('umiTrans::relation.selectResponseTable')}}</option>
                    </select>
                </div>
            </div>
            <i class="fa fa-question-circle fa-lg popover-info blue" aria-hidden="true" data-rel="popover"
               data-trigger="hover" style="transform: translate(0,4px);" data-placement="auto right"
               title="Response Field"
               data-content="{{trans('umiTrans::relation.responseFieldInfo')}}"></i>
        </div>

        <div class="hr hr-dotted"></div>
        <div class="space-2"></div>

        {{--advantage--}}
        <div class="form-group">
            <label class="control-label col-xs-12 col-sm-1 no-padding-right blue" for="detail">{{trans('umiTrans::relation.advantage')}}</label>
            <div class="col-xs-4">
                <label>
                    <input name="advantageSwitch" id="advantageSwitch" class="ace ace-switch ace-switch-7" type="checkbox" />
                    <span class="lbl"></span>
                </label>
            </div>
            <i class="fa fa-question-circle fa-lg popover-error red2" aria-hidden="true" data-rel="popover"
               data-trigger="hover" style="transform: translate(0,4px);" data-placement="auto right"
               title="Custom Rule"
               data-content="{{trans('umiTrans::relation.advantageInfo')}}"></i>
        </div>

        <div id="advantage" hidden="hidden">
            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-1 no-padding-right" for="operation">Operation</label>
                <div class="col-xs-12 col-sm-4">
                    <div class="clearfix">
                        <select class="form-control" id="operation" name="operation">
                            @foreach($operationCharacter as $item)
                                <option value="{{$item}}">{{$item}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-1 no-padding-right" for="targetValue">{{trans('umiTrans::relation.targetValue')}}</label>
                <div class="col-xs-12 col-sm-4">
                    <div class="clearfix">
                        <input class="form-control" type="text" name="targetValue" id="targetValue" disabled="disabled"
                               placeholder="{{trans('umiTrans::relation.targetValuePh')}}">
                    </div>
                </div>
                <i class="fa fa-question-circle fa-lg popover-error red2" aria-hidden="true" data-rel="popover"
                   data-trigger="hover" style="transform: translate(0,4px);" data-placement="auto right"
                   title="Warning"
                   data-content="{{trans('umiTrans::relation.targetValueInfo')}}"></i>
            </div>
        </div>

        <div class="hr hr-dotted"></div>
        <div class="space-2"></div>

        <div class="form-group">
            <label class="control-label col-xs-12 col-sm-1 no-padding-right" for="detail">Detail</label>
            <div class="col-xs-12 col-sm-4">
                <textarea class="form-control" name="detail" id="detail"></textarea>
            </div>
        </div>

        <div class="space-8"></div>

        <button class="btn btn-success btn-sm btn-next" type="submit" id="submitBtn">
            {{trans('umiTrans::relation.add')}}
            <i class="ace-icon fa fa-plus"></i>
        </button>
        &nbsp;&nbsp;
        <button class="btn btn-primary btn-sm btn-next" type="button" id="back">
            {{trans('umiTrans::relation.back')}}
            <i class="ace-icon fa fa-arrow-left"></i>
        </button>
    </form>

    <script>
        $('#submitBtn').attr('disabled', 'disabled');
    </script>

    <script src="{{$path}}/js/jquery.validate.min.js"></script>
    <script src="{{$path}}/js/chosen.jquery.min.js"></script>
    <script src="{{$assetPath}}/js/jquery.form.js"></script>

    <script type="text/javascript" src="{{$assetPath}}/js/relationPage/operationPage.js"></script>
    <script>
        //获取主动表的二级联动数据
        //get active table drop down list
        $('#activeTable').change(function () {
            if ($('#activeTable').val() === ''){
                return false;
            }

            if ($('#advantageSwitch').is(":checked")) {
                return false;
            }

            var tableId = $(this).children('option:selected').val();

            //加载符号
            //showing loading icon
            $('#activeField').after("<i id='responseLoading' class='ace-icon fa fa-spinner fa-spin orange bigger-125'></i>");

            //获取数据
            //get data
            var table = $('#activeTable').find("option:selected").text();
            var url = "{{url('api/fields')}}" + '/' +table;
            $.ajax({
                type: 'get',
                url: url,
                dataType: 'json',
                success: function (data) {
                    //填充数据
                    //fill in data
                    $('#activeField option').remove();
                    $('#activeField').next().remove();
                    $.each(data, function (name, value) {
                        $('#activeField').append("<option value='" + value + "'>" + value + "</option>");
                    });
                },
                error: function () {
                    layer.alert('loading data was wrong!', function (){
                        window.history.back();
                    });
                }
            });
        });

        //获取被动表的二级联动数据
        //get response table drop down list
        $('#responseTable').change(function () {
            if ($('#responseTable').val() === ''){
                return false;
            }

            var tableId = $(this).children('option:selected').val();

            //加载符号
            //showing loading icon
            $('#responseField').after("<i id='responseLoading' class='ace-icon fa fa-spinner fa-spin orange bigger-125'></i>");

            //获取数据
            //get data
            var table = $('#responseTable').find("option:selected").text();
            var url = "{{url('api/fields')}}" + '/' +table;
            $.ajax({
                type: 'get',
                url: url,
                dataType: 'json',
                success: function (data) {
                    //填充数据
                    //fill in data
                    $('#responseField option').remove();
                    $('#responseField').next().remove();
                    $.each(data, function (name, value) {
                        $('#responseField').append("<option value='" + value + "'>" + value + "</option>");
                    });
                },
                error: function () {
                    layer.alert('loading data was wrong!', function (){
                        window.history.back();
                    });
                }
            });
        });

        $(document).ready(function(){
            $('#submitBtn').removeAttr('disabled');
        });
    </script>
@endsection