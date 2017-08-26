@extends('umi::layouts.model')

@section('content')

    <?php $assetPath = url(config('umi.assets_path')) ?>
    <?php $path = url($assetPath . '/lte') ?>

    <link rel="stylesheet" href="{{$assetPath}}/bsSwitch/bsSwitch.css" />
    <link rel="stylesheet" href="{{$assetPath}}/dateTimePicker/jquery.datetimepicker.css" />

    <br>
    <div class="box box-warning">
        <div class="box-header with-border">
            <h3 class="box-title text-warning"><i class="fa fa-square"></i>Edit Fields</h3>
        </div>
        <div class="box-body">
            {!! $message !!}
            @if (!$actionAvailable)
                <div class="alert alert-danger">
                    Currently you can not edit this record until meet the requirements !
                    <br /><br /><p>
                        <button class="btn btn-danger btn-flat disabled" disabled>Edit</button>
                        <button class="btn btn-primary btn-flat" id="clsDelete">Close</button>
                    </p>
                </div>
            @else
                <form class="form-horizontal" method="post" action="{{url("edit")}}/{{$table}}" id="umiForm">
                    {!! csrf_field() !!}
                    {!! $display !!}

                    <input type="hidden" name="hidden_tn" value="{{$table}}">
                    <input type="hidden" name="hidden_ti" value="{{$recordId}}">
                    <input type="hidden" name="hidden_afv" value="{{$activeFieldValue}}">
                </form>
            @endif
        </div>
    </div>

    <script src="{{$assetPath}}/bsSwitch/bootstrap-switch.min.js"></script>
    <script src="{{$assetPath}}/dateTimePicker/jquery.datetimepicker.full.min.js"></script>
    <script src="{{$assetPath}}/js/jquery.validate.min.js"></script>

    <script>
        //关闭所有模态窗口
        //close all model windows
        $('#cls').click(function () {
            parent.layer.closeAll();
        });

        //生成一个蒙版和加载图标
        //create a shade and a loading icon
        $('#actionEdit').click(function () {
            layer.load(0, {
                shade: [0.8,'#000000']
            });
        });


    </script>
@endsection
