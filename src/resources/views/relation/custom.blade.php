@extends('umi::layouts.master')

@section('content')

    <?php $assetPath = config('umi.assets_path') ?>
    <?php $path = $assetPath . '/ace' ?>

    <div class="page-header">
        <h1>
            Relation Operation
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Select &amp; Add
                <i class="ace-icon fa fa-angle-double-right"></i>
                Custom
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
            You can turn off this function in config file.
        </p>
    </div>

    <div class="col-xs-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title">
                    Tooltips
                    <small>Example of Custom delete</small>
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
                        You can customize any rule, set the correct table and field that can receive the right data for special operation <br>
                        <span class="red2">
                            Advantage: The custom rule name will be the function name which you will manually program with
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>&nbsp
    <div class="hr hr-dotted"></div>

    <form class="form-horizontal" id="validation-form" method="post" action="{{url('relationOpe') . '/' . $currentTableName . '/add'}}">

        {!! csrf_field() !!}
        <input type="hidden" name="rule_name" value="interlock">
        <input type="hidden" name="operation_type" value="delete">
        <input type="hidden" name="is_extra_operation" value="1">

        {{--custom rule name--}}
        <div class="form-group">
            <label class="control-label col-xs-12 col-sm-1 no-padding-right" for="ruleName">Rule Name</label>
            <div class="col-xs-12 col-sm-4">
                <div class="clearfix">
                    <input type="text" name="ruleName" id="ruleName" class="form-control">
                </div>
            </div>
            <i class="fa fa-question-circle fa-lg popover-error red2" aria-hidden="true" data-rel="popover"
               data-trigger="hover" style="transform: translate(0,4px);" data-placement="auto right"
               title="Rule Name"
               data-content="Will be method name you are going to program, has to be valid function name"></i>
        </div>

        <div class="hr hr-dotted"></div>
        <div class="space-2"></div>

        {{--active table--}}
        <div class="form-group">
            <label class="control-label col-xs-12 col-sm-1 no-padding-right" for="activeTable">Active Table</label>
            <div class="col-xs-12 col-sm-4">
                <select id="activeTable" name="activeTable" class="chosen-select form-control" data-placeholder="Click to Choose...">
                    <option value="">&nbsp;</option>
                    @foreach($tableNames as $tableName => $tableId)
                        <option value="{{$tableId}}">{{$tableName}}</option>
                    @endforeach
                </select>
            </div>
            <i class="fa fa-question-circle fa-lg popover-info blue" aria-hidden="true" data-rel="popover"
               data-trigger="hover" style="transform: translate(0,4px);" data-placement="auto right"
               title="Active Table"
               data-content="The record that you are going to delete from which table"></i>
        </div>

        <div class="space-2"></div>

        <div class="form-group">
            <label class="control-label col-xs-12 col-sm-1 no-padding-right" for="responseTable">Active Field </label>
            <div class="col-xs-12 col-sm-4">
                <div class="clearfix">
                    <select class="form-control" id="activeField" name="activeField">
                        <option value="">select active table</option>
                    </select>
                </div>
            </div>
            <i class="fa fa-question-circle fa-lg popover-info blue" aria-hidden="true" data-rel="popover"
               data-trigger="hover" style="transform: translate(0,4px);" data-placement="auto right"
               title="Active Field"
               data-content="The record that you are going to delete from which table"></i>
        </div>

        <div class="hr hr-dotted"></div>
        <div class="space-2"></div>

        {{--response table--}}
        <div class="form-group">
            <label class="control-label col-xs-12 col-sm-1 no-padding-right" for="responseTable">Response Table</label>
            <div class="col-xs-12 col-sm-4">
                <select id="responseTable" name="responseTable" class="chosen-select form-control" data-placeholder="Click to Choose...">
                    <option value="">&nbsp;</option>
                    @foreach($tableNames as $tableName => $tableId)
                        <option value="{{$tableId}}">{{$tableName}}</option>
                    @endforeach
                </select>
            </div>
            <i class="fa fa-question-circle fa-lg popover-info blue" aria-hidden="true" data-rel="popover"
               data-trigger="hover" style="transform: translate(0,4px);" data-placement="auto right"
               title="Response Table"
               data-content="Which table will be related by deleting of active table's record"></i>
        </div>

        <div class="space-2"></div>

        <div class="form-group">
            <label class="control-label col-xs-12 col-sm-1 no-padding-right" for="responseField">Response Field</label>
            <div class="col-xs-12 col-sm-4">
                <div class="clearfix">
                    <select class="form-control" id="responseField" name="responseField">
                        <option value="">select response table</option>
                    </select>
                </div>
            </div>
            <i class="fa fa-question-circle fa-lg popover-info blue" aria-hidden="true" data-rel="popover"
               data-trigger="hover" style="transform: translate(0,4px);" data-placement="auto right"
               title="Response Field"
               data-content="This field will match active filed to achieve deletion of relation"></i>
        </div>

        <div class="hr hr-dotted"></div>
        <div class="space-2"></div>

        {{--advantage--}}
        <div class="form-group">
            <label class="control-label col-xs-12 col-sm-1 no-padding-right" for="detail">Advantage</label>
            <div class="col-xs-4">
                <label>
                    <input name="switch-field-1" id="advantageSwitch" class="ace ace-switch ace-switch-7" type="checkbox" />
                    <span class="lbl"></span>
                </label>
            </div>
            <i class="fa fa-question-circle fa-lg popover-error red2" aria-hidden="true" data-rel="popover"
               data-trigger="hover" style="transform: translate(0,4px);" data-placement="auto right"
               title="Custom Rule"
               data-content="Set the rule to match active field for deleting of records"></i>
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
                <label class="control-label col-xs-12 col-sm-1 no-padding-right" for="targetValue">Target Value</label>
                <div class="col-xs-12 col-sm-4">
                    <div class="clearfix">
                        <input class="form-control" type="text" name="targetValue" id="targetValue" disabled="disabled">
                    </div>
                </div>
                <i class="fa fa-question-circle fa-lg popover-error red2" aria-hidden="true" data-rel="popover"
                   data-trigger="hover" style="transform: translate(0,4px);" data-placement="auto right"
                   title="Warning"
                   data-content="Please set correct type of value to match response field. TRUE:1 FALSE:0"></i>
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

        <button class="btn btn-success btn-sm btn-next" type="submit">
            Add
            <i class="ace-icon fa fa-plus"></i>
        </button>
        &nbsp;&nbsp;
        <button class="btn btn-primary btn-sm btn-next" type="button" id="back">
            Back
            <i class="ace-icon fa fa-arrow-left"></i>
        </button>
    </form>

    <script src="{{$path}}/js/jquery.validate.min.js"></script>
    <script src="{{$path}}/js/chosen.jquery.min.js"></script>
    <script src="{{$assetPath}}/js/jquery.form.js"></script>

    <script type="text/javascript">
        jQuery(function($) {
            $('[data-rel=popover]').popover({
                html:false,
            });

            $('#back').click(function () {
                window.history.back();
            });
            
            //如果高级模式加载的时候开启 则初始化active field 为不可用
            //when web page is loading with advantage function activated then disabled active field.
            if ($('#advantageSwitch').is(":checked")) {
                $('#activeField').attr('disabled', 'disabled');
                $('#activeField option').remove();
                $('#activeField').val(0);
                //show advantage
                $('#advantage').removeAttr('hidden');
                $('#targetValue').removeAttr('disabled');
            }

            //高级模式打开后 active field将不可用
            //advantage model, active field will be locked
            $('#advantageSwitch').click(function () {
                if ($('#advantageSwitch').is(":checked")) {
                    $('#activeField').attr('disabled', 'disabled');
                    $('#activeField option').remove();
                    //show advantage
                    $('#advantage').removeAttr('hidden');
                    $('#targetValue').removeAttr('disabled');
                } else {
                    $('#activeField').removeAttr('disabled');
                    //show advantage
                    $('#advantage').attr('hidden', 'hidden');
                    $('#targetValue').attr('disabled', 'disabled');
                }
            });

            //自动调整下拉框大小
            //resize the chosen on window resize
            if(!ace.vars['touch']) {
                $('.chosen-select').chosen({allow_single_deselect:true});
                $(window)
                    .off('resize.chosen')
                    .on('resize.chosen', function() {
                        $('.chosen-select').each(function() {
                            var $this = $(this);
                            $this.next().css({'width': $this.parent().width()});
                        })
                    }).trigger('resize.chosen');
                //resize chosen on sidebar collapse/expand
                /*$(document).on('settings.ace.chosen', function(e, event_name, event_val) {
                 if(event_name != 'sidebar_collapsed') return;
                 $('.chosen-select').each(function() {
                 var $this = $(this);
                 $this.next().css({'width': $this.parent().width()});
                 })
                 });*/
            }

            //数据验证
            //validation
            $('#validation-form').validate({
                errorElement: 'div',
                errorClass: 'help-block',
                focusInvalid: false,
                ignore: "",
                rules: {
                    ruleName: {
                        required: true
                    },
                    activeTable: {
                        required: true
                    },
                    activeField: {
                        required: true
                    },
                    responseTable: {
                        required: true
                    },
                    responseField: {
                        required: true
                    },
                    targetValue: {
                        required: true,
                    }
                },
                messages: {
                    ruleName: "please input a valid value",
                    activeTable: "Please choose active table",
                    activeField: "please choose active field",
                    responseTable: "Please choose response table",
                    responseField: "please choose response field",
                    targetValue: "please input a value"
                },
                highlight: function (e) {
                    $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
                },
                success: function (e) {
                    $(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
                    $(e).remove();
                },
                errorPlacement: function (error, element) {
                    if(element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
                        var controls = element.closest('div[class*="col-"]');
                        if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
                        else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
                    }
                    else if(element.is('.select2')) {
                        error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
                    }
                    else if(element.is('.chosen-select')) {
                        error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
                    }
                    else error.insertAfter(element.parent());
                },
                submitHandler: function (form) {
                    form.submit();
                },
                invalidHandler: function (form) {
                }
            });

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
        });
    </script>
@endsection