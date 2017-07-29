<div id="{{$tabUiId}}" class="tab-pane fade {{$active}}">
    <form class="form-horizontal" role="form" method="post" action="{{$tableName}}?{{$queryString}}">
        {!! csrf_field() !!}
        <div class="form-group">
            {{$content}}
            <input type="hidden" name="dda" value="{{$tabUiId}}">
            <input type="hidden" name="std" value="{{$tabDataId}}">
        </div>
        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-sm btn-info" type="submit" >
                    <i class="ace-icon fa fa-search bigger-110"></i>
                    {{trans('umiTrans.search.search')}}
                </button>

                <button class="btn btn-sm" type="reset">
                    <i class="ace-icon fa fa-undo bigger-110"></i>
                    {{trans('umiTrans.search.resets')}}
                </button>
            </div>
        </div>
    </form>
</div>