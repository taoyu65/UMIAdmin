
<div class="form-group">
    <label class="control-label col-sm-1" for="field">{{trans('umiTrans::fieldDisplay.tableField')}}</label>
    <div class="col-sm-4">
        <select class="form-control" id="field" name="field" required title="{{trans('umiTrans::fieldDisplay.tip1')}}">
            <option value=""></option>
        </select>
    </div>
    <i class="fa fa-question-circle fa-lg popover-info fa-red" aria-hidden="true" data-rel="popover"
       data-trigger="hover" style="transform: translate(0,4px);" data-placement="auto right"
       title="Field"
       data-content="{{trans('umiTrans::fieldDisplay.tip2')}}"></i>
</div>

<script>
    $(document).ready(function () {
        //刷新当前页面是保持数据显示
        //keep data display when refresh page
        var table = $('#tableName').find("option:selected").text();
        var url = "{{url('api/fields')}}" + '/' +table;
        if (table !== '') {
            //加载符号
            //showing loading icon
            $('#field').html("<i id='responseLoading' class='fa fa-spinner fa-spin fa-orange'></i>");
            loadTableFields($('#tableName'));
        }
    });

    $('#field').change(function () {
        $("#type").val('');
        $("#relation_display").val('');
    });

    //获取还未添加的字段
    //get fields that have not added
    $('#tableName').change(function () {
        if ($(this).val() === ''){
            return false;
        }

        var tableId = $(this).children('option:selected').val();

        //加载符号
        //showing loading icon
        $('#field').after("<i id='responseLoading' class='fa fa-spinner fa-spin fa-orange'></i>");

        //获取数据
        //get data
        loadTableFields(this);
    });

    function loadTableFields(o) {
        var selected = $(o).find("option:selected");
        var tableId = selected.val();
        var table = selected.text();

        var url = "{{url('api/fields/noExist')}}/{{$table}}/" +table + "/" + tableId;

        $.ajax({
            type: 'get',
            url: url,
            dataType: 'json',
            success: function (data) {
                //填充数据
                //fill in data
                $('#field option').remove();
                $('#field').next().remove();
                $.each(data, function (name, value) {
                    if (value !== '{{config('umi.primary_key')}}') {
                        $('#field').append("<option value='" + value + "'>" + value + "</option>");
                    }
                });
            },
            error: function () {
                layer.alert('loading data was wrong!', function (){
                    window.history.back();
                });
            }
        });
    }
</script>