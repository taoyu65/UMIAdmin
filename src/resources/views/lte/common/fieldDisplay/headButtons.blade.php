<div class="col-xs-12">
    <p>
        <button class="btn bg-green btn-flat {{$type==='browser'?'disabled':''}}" {{$type==='browser'?'disabled="disabled"':''}}
                onclick="window.location.href='{{url("fieldDisplay/" . \Illuminate\Support\Facades\Config::get('umiEnum.system_table_name.umi_field_display_browser') . "/type/browser")}}'">
            {{trans('umiTrans::fieldDisplay.browser')}} <i class="fa fa-eye"></i>
        </button>
        <button class="btn btn-primary btn-flat {{$type==='read'?'disabled':''}}" {{$type==='read'?'disabled="disabled"':''}}
                onclick="window.location.href='{{url("fieldDisplay/" . \Illuminate\Support\Facades\Config::get('umiEnum.system_table_name.umi_field_display_read') . "/type/read")}}'">
            {{trans('umiTrans::fieldDisplay.read')}} <i class="fa fa-book"></i>
        </button>
        <button class="btn btn-warning btn-flat {{$type==='edit'?'disabled':''}}" {{$type==='edit'?'disabled="disabled"':''}}
                onclick="window.location.href='{{url("fieldDisplay/" . \Illuminate\Support\Facades\Config::get('umiEnum.system_table_name.umi_field_display_edit') . "/type/edit")}}'">
            {{trans('umiTrans::fieldDisplay.edit')}} <i class="fa fa-pencil-square-o"></i>
        </button>
        <button class="btn btn-danger btn-flat {{$type==='add'?'disabled':''}}" {{$type==='add'?'disabled="disabled"':''}}
                onclick="window.location.href='{{url("fieldDisplay/" . \Illuminate\Support\Facades\Config::get('umiEnum.system_table_name.umi_field_display_add') . "/type/add")}}'">
            {{trans('umiTrans::fieldDisplay.add')}} <i class="fa fa-plus"></i>
        </button>
    </p>
</div>