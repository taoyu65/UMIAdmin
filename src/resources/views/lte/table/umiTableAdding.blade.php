@extends('umi::layouts.model')

@section('content')

    <?php $assetPath = url(config('umi.assets_path')) ?>
    <?php $path = url($assetPath . '/lte') ?>

    <link rel="stylesheet" href="{{$assetPath}}/bsSwitch/bsSwitch.css" />

    <div class="box box-primary">
        <div class="box-header with-border">
            <i class="fa fa-bullhorn fa-primary"></i>
            <h3 class="box-title">Add Confirmation</h3>
        </div>
        <div class="box-body">
            <div class="col-sm-12">
                <form class="form-horizontal" id="umiForm" method="post" action="{{url('add/' . $tableName)}}">
                    {!! csrf_field() !!}
                    {!! $display !!}
                </form>
            </div>
        </div>
    </div>

    <script>
        jQuery(function ($) {
            $('[data-rel=tooltip]').tooltip();
            $('[data-rel=popover]').popover({html:true});
        });

        //关闭所有模态窗口
        //close all model windows
        $('#cls').click(function () {
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

    <script src="{{$assetPath}}/bsSwitch/bsSwitch.js"></script>
    <script src="{{$assetPath}}/js/jquery.validate.min.js"></script>
@endsection
