@extends('umi::layouts.master')

@section('content')

    <?php $assetPath = url(config('umi.assets_path')) ?>
    <?php $path = url($assetPath . '/lte') ?>

    <link rel="stylesheet" href="{{$assetPath}}/bsSwitch/bsSwitch.css">

    <div class="alert bg-olive">
        <button type="button" class="close" data-dismiss="alert">
            <i class="fa fa-times"></i>
        </button>
        <p>
            <strong>
                <i class="fa fa-check"></i>
                {{trans('umiTrans::relation.handsUp')}}
            </strong>
            {{trans('umiTrans::relation.turnOff')}}<br>
            <span class="text-bold"><strong>{{trans('umiTrans::relation.functionDescription2')}}</strong></span>
        </p>
    </div>

    <div class="box box-success with-border">
        <div class="box-header">
            <div class="box-title"><span class="text-primary">{{trans('umiTrans::relation.tooltip')}}: </span>
                <small>{{trans('umiTrans::relation.selfCheckOperation')}}</small>
            </div>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            {!! trans('umiTrans::relation.selfCheckExplain') !!}
        </div>
        <div class="overlay" hidden>
            <i class="fa fa-refresh fa-spin"></i>
        </div>
    </div>

    <div class="list-seperator"></div>

    <form class="form-horizontal" id="validation-form" method="post" action="{{url('relationOpe') . '/' . $currentTableName . '/add'}}">

        {!! csrf_field() !!}
        <input type="hidden" name="rule_name" value="selfCheck">
        <input type="hidden" name="is_extra_operation" value="0">
        <input type="hidden" name="custom_rule_name" value="">

        {{-- action --}}
        <div class="form-group">
            <label class="control-label col-sm-1" for="operationType">{{trans('umiTrans::relation.action')}}</label>
            <div class="col-sm-4">
                <select class="form-control" id="operationType" name="operationType">
                    <option value="">{{trans('umiTrans::relation.operationType')}}</option>
                    <option value="edit">Edit</option>
                    <option value="delete">Delete</option>
                </select>
            </div>
            <i class="fa fa-question-circle fa-lg popover-info fa-primary" aria-hidden="true" data-rel="popover"
               data-trigger="hover" style="transform: translate(0,4px);" data-placement="auto right"
               title="Operation Type"
               data-content="{{trans('umiTrans::relation.actionInfo')}}"></i>
        </div>

        <div class="list-seperator"></div>

        {{--active table--}}
        <div class="form-group">
            <label class="control-label col-sm-1" for="activeTable">{{trans('umiTrans::relation.activeTable')}}</label>
            <div class="col-sm-4">
                <select id="activeTable" name="activeTable" class="chosen-select form-control" data-placeholder="{{trans('umiTrans::relation.choose')}}">
                    <option value="">&nbsp;</option>
                    @foreach($tableNames as $tableName => $tableId)
                        <option value="{{$tableId}}">{{$tableName}}</option>
                    @endforeach
                </select>
            </div>
            <i class="fa fa-question-circle fa-lg popover-info fa-primary" aria-hidden="true" data-rel="popover"
               data-trigger="hover" style="transform: translate(0,4px);" data-placement="auto right"
               title="Active Table"
               data-content="{{trans('umiTrans::relation.activeTableInfo')}}"></i>
            <div class="col-sm-12 col-sm-offset-1 showError"></div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-1" for="responseTable">{{trans('umiTrans::relation.activeField')}} </label>
            <div class="col-sm-4">
                <select class="form-control" id="activeField" name="activeField">
                    <option value="">{{trans('umiTrans::relation.selectActiveTable')}}</option>
                </select>
            </div>
            <i class="fa fa-question-circle fa-lg popover-info fa-primary" aria-hidden="true" data-rel="popover"
               data-trigger="hover" style="transform: translate(0,4px);" data-placement="auto right"
               title="Active Field"
               data-content="{{trans('umiTrans::relation.activeFieldInfo')}}"></i>
            <div class="col-sm-12 col-sm-offset-1 showError"></div>
        </div>

        <div class="list-seperator"></div>

        <div class="form-group">
            <label class="control-label col-sm-1" for="operation">{{trans('umiTrans::relation.operation')}}</label>
            <div class="col-sm-4">
                <select class="form-control" id="operation" name="operation">
                    @foreach($operationCharacter as $item)
                        <option value="{{$item}}">{{$item}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-1" for="targetValue">{{trans('umiTrans::relation.targetValue')}}</label>
            <div class="col-sm-4">
                <input class="form-control" type="text" name="targetValue" id="targetValue"
                       placeholder="{{trans('umiTrans::relation.targetValuePh')}}">
            </div>
            <i class="fa fa-question-circle fa-lg popover-error fa-red" aria-hidden="true" data-rel="popover"
               data-trigger="hover" style="transform: translate(0,4px);" data-placement="auto right"
               title="Warning"
               data-content="{{trans('umiTrans::relation.targetValueInfo')}}"></i>
            <div class="col-sm-12 col-sm-offset-1 showError"></div>
        </div>

        <div class="list-seperator"></div>

        <div class="form-group">
            <label class="control-label col-sm-1" for="detail">{{trans('umiTrans::relation.detail')}}</label>
            <div class="col-sm-4">
                <textarea class="form-control" name="detail" id="detail"></textarea>
            </div>
        </div>

        <button class="btn btn-success btn-flat" type="submit" id="submitBtn">
            {{trans('umiTrans::relation.add')}}
            <i class="fa fa-plus"></i>
        </button>
        &nbsp;&nbsp;
        <button class="btn btn-primary btn-flat" type="button" id="back">
            {{trans('umiTrans::relation.back')}}
            <i class="fa fa-arrow-left"></i>
        </button>
    </form>

    <script>
        $('#submitBtn').attr('disabled', 'disabled');
    </script>

    <script src="{{$assetPath}}/js/jquery.validate.min.js"></script>
    <script src="{{$assetPath}}/js/jquery.form.js"></script>
    <script src="{{$assetPath}}/bsSwitch/bootstrap-switch.min.js"></script>

    <script type="text/javascript" src="{{$assetPath}}/js/relationPage/operationPage.js"></script>
    <script>
        //获取主动表的二级联动数据
        //get active table drop down list
        $('#activeTable').change(function () {
            var url = '{{url('api/fields')}}';
            activeTable(url);
        });

        //获取被动表的二级联动数据
        //get response table drop down list
        $('#responseTable').change(function () {
            var url = '{{url('api/fields')}}';
            responseTable(url);
        });

        $(document).ready(function(){
            $('#submitBtn').removeAttr('disabled');
        });
    </script>
@endsection