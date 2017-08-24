@extends('umi::layouts.master')

@section('content')

    <?php $assetPath = url(config('umi.assets_path')) ?>
    <?php $path = url($assetPath . '/lte') ?>

    <div class="alert bg-olive">
        <button type="button" class="close" data-dismiss="alert">
            <i class="fa fa-times"></i>
        </button>
        <p>
            <strong>
                <i class="fa fa-check"></i>
                {{trans('umiTrans::menu.handsUp')}}
            </strong>
            {!! trans('umiTrans::menu.tip2') !!}
        </p>
    </div>

    <div class="row">
        <div class="col-sm-12">
        <menu id="nestable-menu" class="nestable-menu">
            <button type="button" data-action="expand-all" class="btn btn-primary btn-flat">
                {{trans('umiTrans::menu.expandAll')}}
                <i class="fa fa-expand"></i>
            </button>
            <button type="button" data-action="collapse-all" class="btn btn-primary btn-flat">
                {{trans('umiTrans::menu.collapseAll')}}
                <i class="fa fa-compress"></i>
            </button>
            <button type="button" data-action="refresh" class="btn bg-orange btn-flat">
                {{trans('umiTrans::menu.reload')}}
                <i class="fa fa-refresh"></i>
            </button>
            <button type="button" data-action="save" class="btn btn-success btn-flat">
                {{trans('umiTrans::menu.save')}}
                <i class="fa fa-arrow-up"></i>
            </button>
        </menu>
    </div>

        {{--neastable js tree--}}
        <div class="col-sm-12">
        {!! $menuTree !!}
    </div>

        <div class="col-sm-12">
        <menu id="nestable-menu" class="nestable-menu">
            <button type="button" data-action="expand-all" class="btn btn-primary btn-flat">
                {{trans('umiTrans::menu.expandAll')}}
                <i class="fa fa-expand"></i>
            </button>
            <button type="button" data-action="collapse-all" class="btn btn-primary btn-flat">
                {{trans('umiTrans::menu.collapseAll')}}
                <i class="fa fa-compress"></i>
            </button>
            <button type="button" data-action="refresh" class="btn bg-orange btn-flat">
                {{trans('umiTrans::menu.reload')}}
                <i class="fa fa-refresh"></i>
            </button>
            <button type="button" data-action="save" class="btn btn-success btn-flat">
                {{trans('umiTrans::menu.save')}}
                <i class="fa fa-plus"></i>
            </button>
        </menu>
    </div>

        <form method="post" id="updateOrderForm">
        {!! csrf_field() !!}
        <input id="menuJson" type="hidden">
    </form>
    </div>

    <script src="{{$assetPath}}/js/jquery.nestable.min.js"></script>
    <script src="{{$assetPath}}/js/jquery.form.js"></script>
    <script src="{{$assetPath}}/js/bread/umiTableBread.js"></script>

    <script type="text/javascript">

        $(document).ready(function () {
            var updateOutput = function(e) {
                var list = e.length ? e : $(e.target),
                    output = list.data('output');
                if(window.JSON) {
                    output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
                }
                else {
                    output.val('JSON browser support required for this demo.');
                }
            };
            $('.dd').nestable().on('change', updateOutput);
            updateOutput($('#nestableMenu').data('output', $('#menuJson')));

            //making the link enable to click
            $('.dd-handle a').on('mousedown', function(e){
                e.stopPropagation();
            });

            $('.nestable-menu').on('click', function(e)
            {
                var target = $(e.target),
                    action = target.data('action');
                switch (action) {
                    case 'expand-all':
                        $('.dd').nestable('expandAll');
                        break;
                    case 'collapse-all':
                        $('.dd').nestable('collapseAll');
                        break;
                    case 'refresh':
                        window.location.reload();
                        break;
                    case 'save':
                        var saveLayer = layer.load(0, {
                            shade: [0.8, '#000000']
                        });
                        var options = {
                            type: 'POST',
                            url: "{{url('menuManagement/' . $tableName)}}/updateMenuTree",
                            data: {'menuJson':$('#menuJson').val()},
                            success: function (data) {
                                layer.close(saveLayer);
                                layer.alert(data, function () {
                                    window.location.reload();
                                });
                            }
                        };
                        $('#updateOrderForm').ajaxSubmit(options);
                        break;
                }
            });
        });
    </script>
@endsection