<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <?php $assetPath = config('umi.assets_path') ?>
    <?php $path = $assetPath . '/ace' ?>
    <link rel="stylesheet" href="{{$path}}/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
</head>
<body>
@yield('body')
</body>
</html>