@extends('umi::layouts.master')

@section('content')

    <?php $assetPath = config('umi.assets_path') ?>
    <?php $path = $assetPath . '/ace' ?>

    <div class="page-header">
        <h1>
            UMI Tables
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Data Table Manage &amp; Search
            </small>
        </h1>
    </div>

    {!! $header !!}

    {!! $tableBody !!}

    {!! $footer !!}

    <script src="{{$assetPath}}/js/bread/umiTableBread.js"></script>

@endsection