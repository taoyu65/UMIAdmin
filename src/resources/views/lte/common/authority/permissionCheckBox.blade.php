<div class="row">
    <div class="col-xs-12">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">{{trans('umiTrans::permissionCheckBox.permissionOfRole')}}</h3>
            </div>
            <div class="widget-body">
                <div class="col-xs-12 col- center">
                    <div class="alert alert-danger-light alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-ban"></i> {{trans('umiTrans::permissionCheckBox.important')}}</h4>
                        {!! trans('umiTrans::permissionCheckBox.tip') !!}
                    </div>
                </div>

                <form class="form-horizontal">
                    <div class="form-group has-warning">
                        <label for="inputWarning" class="col-xs-12 col-sm-2 control-label">{{trans('umiTrans::permissionCheckBox.tableName')}}</label>
                        <div class="col-xs-12 col-sm-1">
                            <button class="btn bg-olive btn-flat" type="button" id="selectAll">{{trans('umiTrans::permissionCheckBox.selectAll')}}</button>
                        </div>
                        <div class="col-xs-12 col-sm-1">
                            <button class="btn bg-red btn-flat" type="button" id="invertAll">{{trans('umiTrans::permissionCheckBox.invertSelection')}}</button>
                        </div>
                    </div>
                </form>

                <form class="form-horizontal" id="form">
                    @foreach($tables as $table)
                        <div class="form-group has-warning table-row">
                            <label for="inputWarning" class="col-xs-12 col-sm-2 control-label">{{$table->table_name}}</label>
                            <div class="col-xs-12 col-sm-1">
                                <div class="checkbox">
                                    <label>
                                        <input name="browser{{$table->id}}" class="minimal permissionCheckBox {{$table->table_name}}" type="checkbox"
                                                {{in_array('browser' . $table->id, $permission) ? '' : 'disabled'}} />
                                        <span class="lbl">{{trans('umiTrans::permissionCheckBox.browser')}}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-1">
                                <div class="checkbox">
                                    <label>
                                        <input name="read{{$table->id}}" class="minimal permissionCheckBox {{$table->table_name}}" type="checkbox"
                                                {{in_array('read' . $table->id, $permission) ? '' : 'disabled'}} />
                                        <span class="lbl">{{trans('umiTrans::permissionCheckBox.read')}}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-1">
                                <div class="checkbox">
                                    <label>
                                        <input name="edit{{$table->id}}" class="minimal permissionCheckBox {{$table->table_name}}" type="checkbox"
                                                {{in_array('edit' . $table->id, $permission) ? '' : 'disabled'}} />
                                        <span class="lbl">{{trans('umiTrans::permissionCheckBox.edit')}}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-1">
                                <div class="checkbox">
                                    <label>
                                        <input name="add{{$table->id}}" class="minimal permissionCheckBox {{$table->table_name}}" type="checkbox"
                                                {{in_array('add' . $table->id, $permission) ? '' : 'disabled'}} />
                                        <span class="lbl">{{trans('umiTrans::permissionCheckBox.add')}}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-1">
                                <div class="checkbox">
                                    <label>
                                        <input name="delete{{$table->id}}" class="minimal permissionCheckBox {{$table->table_name}}" type="checkbox"
                                                {{in_array('delete' . $table->id, $permission) ? '' : 'disabled'}} />
                                        <span class="lbl">{{trans('umiTrans::permissionCheckBox.delete')}}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-offset-1 col-sm-2">
                                <div class="checkbox">
                                    <label>
                                        {{--<input class="minimal checkRowAll {{$table->table_name}}" type="checkbox" />--}}
                                        <input type="button" value="Select All" class="btn btn-flat btn-sm bg-purple" onclick="checkAll(this, '{{$table->table_name}}')">
                                        {{--<span class="lbl"> </span>--}}
                                    </label>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </form>
                <br/>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-green',
            radioClass   : 'iradio_minimal-green'
        });

        //反选所有选项
        //invert all the checkbox
        $('#invertAll').click(function () {
            $('#form').find('input[type="checkbox"].minimal:not(:disabled)').each(function () {
                if($(this).prop('checked')) {
                    $(this).iCheck('uncheck');
                    //$(this).removeAttr('checked');
                } else {
                    $(this).iCheck('check');
                    //$(this).prop('checked', 'checked');
                }
            });
        });

        //选择所有的checkbox
        //select all the checkbox
        $('#selectAll').click(function () {
            $('#form').find('input[type="checkbox"].permissionCheckBox:not(:disabled)').each(function () {
                $(this).iCheck('check');
                //$(this).prop('checked', 'checked');
            });
        });

        $('.checkRowAll').on('ifChecked', function (event) {
        });
    });

    //行级 - 选择所有
    //select all in a row
    function checkAll(btn, e) {
        if ($(btn).val() === 'Select All') {
            $('.' + e+':not(:disabled)').each(function () {
                $(this).iCheck('check');
            });
            $(btn).attr('value', 'Erase All');
            $(btn).removeAttr('class');
            $(btn).attr('class', 'btn btn-flat btn-sm bg-orange');
        } else if ($(btn).val() === 'Erase All') {
            $('.' + e+':not(:disabled)').each(function () {
                $(this).iCheck('uncheck');
            });
            $(btn).attr('value', 'Select All');
            $(btn).removeAttr('class');
            $(btn).attr('class', 'btn btn-flat btn-sm bg-purple');
        }
    }
</script>