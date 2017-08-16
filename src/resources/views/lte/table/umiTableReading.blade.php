@extends('umi::layouts.model')

@section('content')

    <div class="col-sm-12">
        <h3 class="header smaller lighter blue">
            <i class="ace-icon fa fa-bullhorn"></i>
            Read Fields
        </h3>
        <div class="alert alert-warning">
            <p>
            <form class="form-horizontal">
                {!! $display !!}
            </form>
            </p>
        </div>
    </div>
<script>
    //关闭所有模态窗口
    //close all model windows
    $('#cls').click(function () {
        parent.layer.closeAll();
    });
</script>
@endsection
