@extends('umi::layouts.model')

@section('content')

    <?php $assetPath = url(config('umi.assets_path')) ?>
    <?php $path = url($assetPath . '/lte') ?>

    <div class="col-sm-12">
        <div class="col-sm-12">
            <h4 class="text-primary">{{$selector->title or 'Selector'}}</h4>
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert">
                    <i class="fa fa-times"></i>
                </button>
                {{$selector->tip or trans('umiTrans::selector.clickToSelect')}}
                <br />
            </div>

            @if ($selector->searchField)
                <div class="col-sm-12">
                    <div id="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#tabs-1" data-toggle="tab"><i class="fa fa-search"></i> {{trans('umiTrans::selector.search')}}</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="tabs-1" class="active tab-pane">
                                <form action="{{url('selector/search')}}" method="post">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="url" value="{{$url}}">
                                    <input type="hidden" name="table" value="{{$table}}">
                                    <input type="hidden" name="field" value="{{$selector->searchField}}">
                                    <input type="hidden" name="selector" value="{{serialize($selector)}}">
                                    {{trans('umiTrans::selector.field')}}: <input type="text" name="value">
                                    <button class="btn btn-primary btn-flat" type="submit"><i class="fa fa-search"></i> {{trans('umiTrans::selector.search')}}</button>
                                    <button class="btn btn-primary btn-flat" type="button" id="showAll">{{trans('umiTrans::selector.showAll')}}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <table id="simple-table" class="table table-hover">
                <tr>
                    @foreach($selector->fields as $item)
                        <th>{{$item}}</th>
                    @endforeach
                </tr>
                @foreach($records as $record)
                    <tr class="tr" onclick="parent.{{$selector->functionName}}($(this).find('#{{$selector->returnField}}').html().trim())" >
                        @foreach($selector->fields as $item)
                            <td>
                                <span id="{{$item}}">
                                    {{$record->$item}}
                                </span>
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </table>
            <br>
            {!! $links or '' !!}
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.tr').mouseover(function () {
                $(this).css("background-color","#d5f4fe");
            });
            $('.tr').mouseout(function () {
                $(this).css("background-color","#FFF");
            });
            $('#showAll').click(function () {
                location.href = '{{$url}}';
            });
        });
    </script>

@endsection