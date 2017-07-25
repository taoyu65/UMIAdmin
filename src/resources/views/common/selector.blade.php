@extends('umi::layouts.model')

@section('content')

    <?php $assetPath = url(config('umi.assets_path')) ?>
    <?php $path = url($assetPath . '/ace') ?>

    <script src="{{$path}}/js/jquery-ui.min.js"></script>

    <div class="col-sm-12">
        <div class="col-sm-12">
            <h3 class="header smaller lighter blue">{{$selector->title or 'Selector'}}</h3>

            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert">
                    <i class="ace-icon fa fa-times"></i>
                </button>
                {{$selector->tip or 'Please Click Row To Select'}}
                <br />
            </div>

            @if ($selector->searchField)
                <div class="col-sm-12">
                    {{--<h3 class="header blue lighter smaller">
                        <i class="ace-icon fa fa-folder-o smaller-90"></i>
                        Search
                    </h3>--}}
                    <div id="tabs">
                        <ul>
                            <li>
                                <a href="#tabs-1"><i class="fa fa-search"></i> Search</a>
                            </li>
                        </ul>
                        <div id="tabs-1">
                            <form action="{{url('selector/search')}}" method="post">
                                {!! csrf_field() !!}
                                <input type="hidden" name="url" value="{{$url}}">
                                <input type="hidden" name="table" value="{{$table}}">
                                <input type="hidden" name="field" value="{{$selector->searchField}}">
                                <input type="hidden" name="selector" value="{{serialize($selector)}}">
                                field: <input type="text" name="value">
                                <button class="btn btn-info" type="submit">Search</button>
                                <button class="btn btn-info" type="button" id="showAll">Show All</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif

            <table id="simple-table" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        @foreach($selector->fields as $item)
                            <th>{{$item}}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($records as $record)
                        <tr class="tr" onclick="parent.{{$selector->functionName}}($(this).find('#{{$selector->returnField}}').html())" >
                            @foreach($selector->fields as $item)
                                <td>
                                    <span id="{{$item}}">
                                        {{$record->$item}}
                                    </span>
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <br>
            {!! $links or '' !!}
        </div>

    </div>

    <script type="text/javascript">

        $(document).ready(function () {
            $("#tabs").tabs();

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