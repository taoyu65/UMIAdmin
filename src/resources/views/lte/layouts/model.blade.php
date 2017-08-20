<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>

    <?php $assetPath = url(config('umi.assets_path')) ?>
    <?php $path = url($assetPath . '/lte') ?>

    <link rel="stylesheet" href="{{$path}}/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{$path}}/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{$path}}/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{$path}}/dist/css/AdminLTE.min.css">
    <!-- jQuery 3 -->
    <script src="{{$path}}/bower_components/jquery/dist/jquery.min.js"></script>
</head>
<body>

@yield('content')

<!-- layer scripts -->
<script src="{{$assetPath}}/layer/layer.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{$path}}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

</body>
</html>