<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <?php $assetPath = config('umi.assets_path') ?>
    <?php $path = $assetPath . '/ace' ?>
    <link rel="stylesheet" href="{{$path}}/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
    <link rel="stylesheet" href="{{$path}}/css/bootstrap.min.css" />

    <script src="{{$path}}/js/jquery-2.1.4.min.js"></script>
</head>
<body>

@yield('body')

<!-- layer scripts -->
<script src="{{$assetPath}}/layer/layer.js"></script>

</body>
</html>