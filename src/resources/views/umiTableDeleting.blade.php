@extends('umi::layouts.model')

@section('body')

    <div class="col-sm-12">
        <h3 class="header smaller lighter red">
            <i class="ace-icon fa fa-bullhorn"></i>
            Delete Confirmation
        </h3>

        {!! $message !!}
        @if (!$actionAvailable)
            <div class="alert alert-danger">
                Currently you can not delete this record until meet the requirement !
                <br /><br /><p>
                    <button class="btn btn-sm btn-danger disabled" disabled>Delete</button>
                    <button class="btn btn-sm btn-info" id="clsDelete">Close</button>
                </p>
            </div>
        @else
            <div class="alert alert-warning">
                Confirm to delete this record?
                <br /><br /><p>
                    <form method="post" action="{{url("delete")}}/{{$table}}">
                        {!! csrf_field() !!}

                        <input type="hidden" name="hidden_tn" value="{{$table}}">
                        <input type="hidden" name="hidden_ti" value="{{$id}}">
                        <input type="hidden" name="hidden_afv" value="{{$activeFieldValue}}">

                        <button class="btn btn-sm btn-danger" id="actionDelete" type="submit">Delete</button>
                        <button class="btn btn-sm btn-info" id="clsDelete" type="button">Close</button>
                    </form>
                </p>
            </div>
        @endif

    </div>
<script>

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
