@extends('umi::layouts.model')

@section('content')

    <?php $assetPath = config('umi.assets_path') ?>
    <?php $path = $assetPath . '/ace' ?>

    <form class="col-sm-12">
        <h3 class="header smaller lighter green">
            <i class="ace-icon fa fa-bullhorn"></i>
            Add Confirmation
        </h3>
    </form>

    <div class="col-sm-12">
        <form class="form-horizontal" id="addForm" method="post" action="{{url('add/' . $tableName)}}">
            {!! $display !!}
        </form>
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

    <script src="{{$path}}/js/jquery.validate.min.js"></script>
@endsection
