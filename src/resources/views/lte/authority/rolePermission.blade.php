@extends('umi::layouts.master')

@section('content')

    <?php $assetPath = url(config('umi.assets_path')) ?>
    <?php $path = url($assetPath . '/lte') ?>

    <link rel="stylesheet" href="{{$path}}/plugins/iCheck/all.css">

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title Bold">{{trans('umiTrans::rolePermission.selectRole')}}:</h3>
                    <strong><span id="roleTitle" class="red roleTitle"></span></strong>
                </div>
                <div class="widget-body">
                    <form class="form-horizontal" id="updateSubmit" action="{{url('authority/wizardUpdate')}}" method="post">
                        {!! csrf_field() !!}
                        <div class="form-group has-info">
                            <label for="role_id" class="col-xs-12 col-sm-2 control-label no-padding-right">{{trans('umiTrans::rolePermission.role')}} </label>
                            <div class="col-xs-12 col-sm-5">
                                <select id="role_id" name="role_id" class="chosen-select form-control" data-placeholder="{{trans('umiTrans::rolePermission.selectRole')}}" required>
                                    <option value="">{{trans('umiTrans::rolePermission.selectRole')}}...</option>
                                    @foreach($roles as $id => $role)
                                        <option value="{{$id}}">{{$role}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xs-12 col-xs-2">
                                <button class="btn bg-olive btn-flat" type="button" id="addNewRole">{{trans('umiTrans::rolePermission.addNewRole')}}</button>
                            </div>
                        </div>
                        <input type="hidden" name="oldPermissions" id="oldPermissions">
                        <input type="hidden" name="newPermissions" id="newPermissions">
                    </form>
                    <br>
                </div>
            </div>
        </div>
    </div>

    @include('umi::common.authority.permissionCheckBox')

    <form class="form-horizontal">
        <div class="form-group has-success">
            <label for="role_id" class="col-xs-12 col-sm-2 control-label no-padding-right"></label>
            <div class="col-xs-12 col-sm-5">
                <button class="btn btn-warning bolder" type="button" id="updateSubmitBtn">{{trans('umiTrans::rolePermission.update')}}</button>
            </div>
        </div>
    </form>

    <script src="{{$assetPath}}/js/jquery.validate.min.js"></script>
    <script src="{{$path}}/plugins/iCheck/icheck.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            //根据角色获取权限
            //get all permissions according to the role selected
            $('#role_id').change(function () {
                var roleId = $(this).val();
                if (roleId === '')
                    return false;

                var load = layer.load(3, {
                    shade: [0.6, '#000']
                });

                var url = '{{url("/api/checkRole")}}' + '/' + roleId;
                $.ajax({
                    type: 'get',
                    url: url,
                    success: function (data) {
                        if (data.length > 0) {
                            //最后提交表单使用的隐藏域
                            //hidden field for submitting at the end
                            $('#oldPermissions').val(JSON.stringify(data));
                            //循环检查权限
                            //circulate to check all the permissions
                            $('#form').find('input[type="checkbox"].permissionCheckBox:not(:disabled)').each(function () {
                                var checkBoxName = $(this).prop('name');console.log($.inArray(checkBoxName, data));
                                if ($.inArray(checkBoxName, data) === -1) {
                                    //$(this).prop('checked', 'checked');
                                    $(this).iCheck('uncheck');
                                } else {
                                    $(this).iCheck('check');
                                    //$(this).removeAttr('checked');
                                }
                            });
                        } else {
                            $('#form').find('input[type="checkbox"].permissionCheckBox:not(:disabled)').each(function () {
                                //$(this).removeAttr('checked');
                                $(this).iCheck('uncheck');
                            });
                        }
                    },
                    error: function () {
                        layer.alert('Something went wrong!', {title: 'Wrong'})
                    },
                    complete: function () {
                        layer.close(load);
                    }
                });
            });

            //提交表单
            //submit form
            $('#updateSubmitBtn').click(function () {
                //最后提交表单使用的隐藏域
                //hidden field for submitting at the end
                var newPermission = [];
                $('#form').find('input[type="checkbox"].permissionCheckBox:not(:disabled)').each(function () {
                    if ($(this).is(':checked')) {
                        newPermission.push($(this).prop('name'));
                    }
                });
                $('#newPermissions').val(JSON.stringify(newPermission));

                $("#updateSubmit").validate({errorClass: 'text-red'});
                $('#updateSubmit').submit();
            });

            //增加一个新角色
            //add a new role
            $('#addNewRole').click(function () {
                var url = "{{url('adding') . '/' . config('umiEnum.system_table_name.umi_roles')}}";
                layer.open({
                    type: 2,
                    title: 'Add Role',
                    maxmin: true,
                    shadeClose: true,
                    area: ['80%', '90%'],
                    content: url
                });
            });
        });
    </script>
@endsection