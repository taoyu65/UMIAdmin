@extends('umi::layouts.model')

@section('content')

    <div class="col-sm-12">
        <h3 class="header smaller lighter green">
            <i class="ace-icon fa fa-bullhorn"></i>
            Add Confirmation
        </h3>

        @if (!$actionAvailable)
            <div class="alert alert-danger">
                Currently you can not add a record until meet the requirement !
                <br /><br /><p>
                    <button class="btn btn-sm btn-danger disabled" disabled>Add</button>
                    <button class="btn btn-sm btn-info" id="clsDelete">Close</button>
                </p>
            </div>
        @else
            {{-- tooltips --}}
            <div class="col-xs-12">
                <div class="widget-box">
                    <div class="widget-header">
                        <h4 class="widget-title">
                            Tooltips
                            <small>Adding record instruction</small>
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
                                <span class="red">
                                    Warning: All the showing fields can be customized to different display model.
                                </span><br>
                                You can decide which fields are showing to be added or the fields are showing but not editable with a default value<br>
                                <span class="blue">
                                    Advantage: For some foreign key input, you can set a special data type to help input such as drop down box with the actual value related that foreign key
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>&nbsp
            <div class="hr hr-dotted"></div>

            <form class="form-horizontal" id="validation-form" method="post" action="">

                {!! csrf_field() !!}

                {{--active table--}}
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-1 no-padding-right" for="activeTable">Active Table</label>
                    <div class="col-xs-12 col-sm-4">
                        <select id="activeTable" name="activeTable" class="chosen-select form-control" data-placeholder="Click to Choose...">
                            <option value="">&nbsp;</option>

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
                    <label class="control-label col-xs-12 col-sm-1 no-padding-right blue" for="detail">Advantage</label>
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
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-1 no-padding-right" for="targetValue">Target Value</label>
                        <div class="col-xs-12 col-sm-4">
                            <div class="clearfix">
                                <input class="form-control" type="text" name="targetValue" id="targetValue" disabled="disabled"
                                       placeholder="This value will be matched to response field">
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

                <button class="btn btn-success btn-sm btn-next" type="submit" id="submitBtn">
                    Add
                    <i class="ace-icon fa fa-plus"></i>
                </button>
                &nbsp;&nbsp;
                <button class="btn btn-primary btn-sm btn-next" type="button" id="back">
                    Back
                    <i class="ace-icon fa fa-arrow-left"></i>
                </button>
            </form>
        @endif

        {!! $message !!}

    </div>
<script>

    jQuery(function ($) {
        $('[data-rel=tooltip]').tooltip();
        $('[data-rel=popover]').popover({html:true});
    });

    //关闭所有模态窗口
    //close all model windows
    $('#clsDelete').click(function () {
        parent.layer.closeAll();
    });

    //生成一个蒙版和加载图标
    //create a shade and a loading icon
    $('#actionDelete').click(function () {
        layer.load(0, {
            shade: [0.8,'#000000']
        });
    });

</script>
@endsection
