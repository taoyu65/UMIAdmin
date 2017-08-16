/*
 * interlock.blade
 * custom.blade
 * exist.blade
 * selfCheck.blade
 */

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
            operationType: {
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
            operationType: "Please choose an action",
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
});