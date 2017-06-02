@extends('umi::layouts.model')

@section('content')

    <?php $assetPath = config('umi.assets_path') ?>
    <?php $path = $assetPath . '/ace' ?>

    <div class="col-sm-12">
        <div class="col-sm-12">
            <h3 class="header smaller lighter blue">Selector</h3>

            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert">
                    <i class="ace-icon fa fa-times"></i>
                </button>
                {{$selector->tip}}
                <br />
            </div>

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
                        <tr class="tr" onclick="parent.{{$selector->functionName}}" >
                            @foreach($selector->fields as $item)
                                <td>
                                    {{$record->$item}}

                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <br>
            {!! $records->render() !!}
        </div>

    </div>
{{$selector->functionName}}
    <script type="text/javascript">

        $(document).ready(function () {
            $('.tr').mouseover(function () {
                $(this).css("background-color","#d5f4fe");
            });
            $('.tr').mouseout(function () {
                $(this).css("background-color","#FFF");
            });
        });

    </script>
@endsection