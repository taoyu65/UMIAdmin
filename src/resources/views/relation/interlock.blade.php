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
                Interlock
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

    <form class="form-horizontal" id="validation-form" method="get">

        <input type="hidden" name="rule_name" value="interlock">
        <input type="hidden" name="operation_type" value="delete">
        <input type="hidden" name="is_extra_operation" value="1">

        <div class="form-group">
            <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="activeTable">Active Table</label>

            <div class="col-xs-12 col-sm-4">
                <select id="activeTable" name="activeTable" class="chosen-select form-control" data-placeholder="Click to Choose...">
                    <option value="">&nbsp;</option>
                    @foreach($tableNames as $tableName => $tableId)
                        <option value="{{$tableId}}">{{$tableName}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="space-2"></div>

        <div class="form-group">
            <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="responseTable">Response Table</label>

            <div class="col-xs-12 col-sm-9">
                <div class="clearfix">
                    <select class="input-medium" id="responseTable" name="responseTable">
                        <option value="">select active table</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="hr hr-dotted"></div>
        <div class="space-2"></div>

        <div class="form-group">
            <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">Comment</label>

            <div class="col-xs-12 col-sm-9">
                <div class="clearfix">
                    <textarea class="input-xlarge" name="comment" id="comment"></textarea>
                </div>
            </div>
        </div>

        <div class="space-8"></div>

        <div class="form-group">
            <div class="col-xs-12 col-sm-4 col-sm-offset-3">
                <label>
                    <input name="agree" id="agree" type="checkbox" class="ace" />
                    <span class="lbl"> I accept the policy</span>
                </label>
            </div>
        </div>
        <button class="btn btn-success btn-sm btn-next" type="submit">
            Add
            <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
        </button>
    </form>


    <script src="{{$path}}/js/jquery.validate.min.js"></script>
    <script src="{{$path}}/js/chosen.jquery.min.js"></script>
    <script src="{{$assetPath}}/js/jquery.form.js"></script>

    <script type="text/javascript">

        jQuery(function($) {
            if(!ace.vars['touch']) {
                $('.chosen-select').chosen({allow_single_deselect:true});

                //resize the chosen on window resize
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
                    activeTable: {
                        required: true
                    },
                    responseTable: {
                        required: true
                    },
                    agree: {
                        required: true,
                    }
                },
                messages: {
                    activeTable: "Please choose active table",
                    responseTable: "Please choose response table",
                    agree: "Please accept our policy"
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
                    alert( "submitted!" );
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

                var tableId = $(this).children('option:selected').val();

                //加载符号
                //showing loading icon
                $('#responseTable').after("<i id='responseLoading' class='ace-icon fa fa-spinner fa-spin orange bigger-125'></i>");

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
                        $('#responseTable option').remove();
                        $('#responseTable').next().remove();
                        $.each(data, function (name, value) {
                            $('#responseTable').append("<option value='" + value + "'>" + value + "</option>");
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