@extends('umi::layouts.master')

@section('content')

    <?php $assetPath = url(config('umi.assets_path')) ?>
    <?php $path = url($assetPath . '/lte') ?>

    {!! $header !!}

    {!! $tableBody !!}

    {!! $footer !!}

    <script src="{{$assetPath}}/js/bread/umiTableBread.js"></script>

@endsection