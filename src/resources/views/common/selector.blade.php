@extends('umi::layouts.model')

@section('content')

    <?php $assetPath = config('umi.assets_path') ?>
    <?php $path = $assetPath . '/ace' ?>

    <div class="col-sm-12">
        <div class="col-sm-12">
            <h3 class="header smaller lighter blue">Selector</h3>

            <table id="simple-table" class="table table-bordered table-hover">
                <thead>
                <tr>
                    @foreach($property->fields as $item)
                        <th>{{$item}}</th>
                    @endforeach
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>

    </div>

    <script src="{{$path}}/js/jquery.nestable.min.js"></script>
    <script src="{{$assetPath}}/js/jquery.form.js"></script>
    <script type="text/javascript">

        $(document).ready(function () {

        });

    </script>
@endsection