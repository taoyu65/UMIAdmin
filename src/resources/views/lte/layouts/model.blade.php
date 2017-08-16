<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>

    <?php $assetPath = url(config('umi.assets_path')) ?>
    <?php $path = url($assetPath . '/ace') ?>

    <link rel="stylesheet" href="{{$path}}/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
    <link rel="stylesheet" href="{{$path}}/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{$path}}/font-awesome/4.5.0/css/font-awesome.min.css" />

    <!-- page specific plugin styles -->
    <link rel="stylesheet" href="{{$path}}/css/jquery-ui.min.css" />

    <script src="{{$path}}/js/jquery-2.1.4.min.js"></script>
</head>
<body>

@yield('content')

<script src="{{$path}}/js/bootstrap.min.js"></script>
<!-- layer scripts -->
<script src="{{$assetPath}}/layer/layer.js"></script>

<!-- ace scripts -->
<script src="{{$path}}/js/ace-elements.min.js"></script>
<script src="{{$path}}/js/ace.min.js"></script>

</body>
</html>