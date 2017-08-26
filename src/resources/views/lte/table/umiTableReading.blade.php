@extends('umi::layouts.model')

@section('content')

    <br>
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title text-success"><i class="fa fa-eye"></i>Read Fields</h3>
        </div>
        <div class="box-body">
            <form class="form-horizontal">
                {!! $display !!}
            </form>
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
