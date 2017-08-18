
<div class="step-pane" data-step="3">
    <h3 class="header smaller orange">{{trans('umiTrans::permissionCheckBox.permissionOfRole')}} <strong><span id="roleTitle" class="red roleTitle"></span></strong></h3>
    <div class="alert alert-block alert-danger">
        <button type="button" class="close" data-dismiss="alert">
            <i class="ace-icon fa fa-times"></i>
        </button>
        <p>
            <strong>
                <i class="ace-icon fa fa-check"></i>
                {{trans('umiTrans::permissionCheckBox.important')}}
            </strong>
            {!! trans('umiTrans::permissionCheckBox.tip') !!}
        </p>
    </div>
    <form class="form-horizontal">
        <div class="form-group has-warning">
            <label for="inputWarning" class="col-xs-12 col-sm-2 control-label no-padding-right ">{{trans('umiTrans::permissionCheckBox.tableName')}}</label>
            <div class="col-xs-12 col-sm-1">
                <button class="btn btn-success btn-mini" type="button" id="selectAll">{{trans('umiTrans::permissionCheckBox.selectAll')}}</button>
            </div>
            <div class="col-xs-12 col-sm-1">
                <button class="btn btn-danger btn-mini" type="button" id="invertAll">{{trans('umiTrans::permissionCheckBox.invertSelection')}}</button>
            </div>
        </div>
    </form>
    <form class="form-horizontal" id="form">
        @foreach($tables as $table)
            <div class="form-group has-warning table-row" >
                <label for="inputWarning" class="col-xs-12 col-sm-2 control-label no-padding-right bolder">{{$table->table_name}}</label>
                <div class="col-xs-12 col-sm-1">
                    <div class="checkbox">
                        <label>
                            <input name="browser{{$table->id}}" class="ace ace-checkbox-2 permissionCheckBox" type="checkbox"
                                    {{in_array('browser' . $table->id, $permission) ? '' : 'disabled'}} />
                            <span class="lbl">{{trans('umiTrans::permissionCheckBox.browser')}}</span>
                        </label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-1">
                    <div class="checkbox">
                        <label>
                            <input name="read{{$table->id}}" class="ace ace-checkbox-2 permissionCheckBox" type="checkbox"
                                    {{in_array('read' . $table->id, $permission) ? '' : 'disabled'}} />
                            <span class="lbl">{{trans('umiTrans::permissionCheckBox.read')}}</span>
                        </label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-1">
                    <div class="checkbox">
                        <label>
                            <input name="edit{{$table->id}}" class="ace ace-checkbox-2 permissionCheckBox" type="checkbox"
                                    {{in_array('edit' . $table->id, $permission) ? '' : 'disabled'}} />
                            <span class="lbl">{{trans('umiTrans::permissionCheckBox.edit')}}</span>
                        </label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-1">
                    <div class="checkbox">
                        <label>
                            <input name="add{{$table->id}}" class="ace ace-checkbox-2 permissionCheckBox" type="checkbox"
                                    {{in_array('add' . $table->id, $permission) ? '' : 'disabled'}} />
                            <span class="lbl">{{trans('umiTrans::permissionCheckBox.add')}}</span>
                        </label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-1">
                    <div class="checkbox">
                        <label>
                            <input name="delete{{$table->id}}" class="ace ace-checkbox-2 permissionCheckBox" type="checkbox"
                                    {{in_array('delete' . $table->id, $permission) ? '' : 'disabled'}} />
                            <span class="lbl">{{trans('umiTrans::permissionCheckBox.delete')}}</span>
                        </label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-offset-1 col-sm-2">
                    <div class="checkbox">
                        <label>
                            <input class="ace ace-checkbox-2" type="checkbox" onchange="checkAll(this);" />
                            <span class="lbl"> {{trans('umiTrans::permissionCheckBox.allErase')}}</span>
                        </label>
                    </div>
                </div>
            </div>
        @endforeach
    </form>
</div>
<script>
    $(document).ready(function(){
        //反选所有选项
        //invert all the checkbox
        $('#invertAll').click(function () {
            $('#form').find('input[type="checkbox"].permissionCheckBox:not(:disabled)').each(function () {
                if($(this).prop('checked')) {
                    $(this).removeAttr('checked');
                } else {
                    $(this).prop('checked', 'checked');
                }
            });
        });

        //选择所有的checkbox
        //select all the checkbox
        $('#selectAll').click(function () {
            $('#form').find('input[type="checkbox"].permissionCheckBox:not(:disabled)').each(function () {
                $(this).prop('checked', 'checked');
            });
        });
    });

    //行级 - 选择所有
    //select all in a row
    function checkAll(e) {
        if($(e).prop("checked")) {
            $(e).closest('.table-row').find('input[type="checkbox"].permissionCheckBox:not(:disabled)').prop('checked', 'checked');
        } else {
            $(e).closest('.table-row').find('input[type="checkbox"].permissionCheckBox:not(:disabled)').removeAttr('checked');
        }
    }
</script>