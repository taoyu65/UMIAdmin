<div class="col-xs-12">
    <p>
        <button class="btn btn-success large btn-round width-10 {{$type==='browser'?'disabled':''}}" {{$type==='browser'?'disabled="disabled"':''}}
                onclick="window.location.href='{{url("fieldDisplay/" . \Illuminate\Support\Facades\Config::get('umiEnum.system_table_name.umi_field_display_browser') . "/type/browser")}}'">
            Browser <i class="fa fa-eye"></i>
        </button>
        <button class="btn btn-primary large btn-round width-10 {{$type==='read'?'disabled':''}}" {{$type==='read'?'disabled="disabled"':''}}
                onclick="window.location.href='{{url("fieldDisplay/" . \Illuminate\Support\Facades\Config::get('umiEnum.system_table_name.umi_field_display_read') . "/type/read")}}'">
            Read <i class="fa fa-book"></i>
        </button>
        <button class="btn btn-warning large btn-round width-10 {{$type==='edit'?'disabled':''}}" {{$type==='edit'?'disabled="disabled"':''}}
                onclick="window.location.href='{{url("fieldDisplay/" . \Illuminate\Support\Facades\Config::get('umiEnum.system_table_name.umi_field_display_edit') . "/type/edit")}}'">
            Edit <i class="fa fa-pencil-square-o"></i>
        </button>
        <button class="btn btn-purple large btn-round width-10 {{$type==='add'?'disabled':''}}" {{$type==='add'?'disabled="disabled"':''}}
                onclick="window.location.href='{{url("fieldDisplay/" . \Illuminate\Support\Facades\Config::get('umiEnum.system_table_name.umi_field_display_add') . "/type/add")}}'">
            Add <i class="fa fa-plus"></i>
        </button>
    </p>
</div>