
<div class="form-group">
    <label class="control-label col-xs-12 col-sm-1 no-padding-right" for="responseField">Table Field</label>
    <div class="col-xs-12 col-sm-4">
        <div class="clearfix">
            <select class="form-control" id="field" name="field" required title="Nothing can be selected">
                <option value=""></option>
            </select>
        </div>
    </div>
    <i class="fa fa-question-circle fa-lg popover-info blue" aria-hidden="true" data-rel="popover"
       data-trigger="hover" style="transform: translate(0,4px);" data-placement="auto right"
       title="Field"
       data-content="Select a Field that does not exist"></i>
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
            $('#field').html("<i id='responseLoading' class='ace-icon fa fa-spinner fa-spin orange bigger-170'></i>");
            loadTableFields($('#tableName'));
        }
    });

    $('#field').change(function () {
        $("#type").val('');
    });

    //获取被动表的二级联动数据
    //get response table drop down list
    $('#tableName').change(function () {
        if ($(this).val() === ''){
            return false;
        }

        var tableId = $(this).children('option:selected').val();

        //加载符号
        //showing loading icon
        $('#field').after("<i id='responseLoading' class='ace-icon fa fa-spinner fa-spin orange bigger-125'></i>");

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
                    $('#field').append("<option value='" + value + "'>" + value + "</option>");
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