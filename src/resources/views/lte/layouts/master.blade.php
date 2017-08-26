<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>UMI admin - login page</title>

    <?php $assetPath = url(config('umi.assets_path')) ?>
    <?php $path = url($assetPath . '/lte') ?>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{$path}}/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{$path}}/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{$path}}/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
           folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{$path}}/dist/css/skins/_all-skins.min.css">
    <!-- gritter -->
    <link rel="stylesheet" href="{{$assetPath}}/css/jquery.gritter.min.css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- jQuery 3 -->
    <script src="{{$path}}/bower_components/jquery/dist/jquery.min.js"></script>
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    {!! $header !!}

    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            {{--<div class="user-panel">
                <div class="pull-left image">
                    <img src="../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>Alexander Pierce</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>--}}
            <!-- search form -->
            {{--<form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
                </div>
            </form>--}}
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                {!! $sideMenu !!}
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small>{{Request::segment(1)}}</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active">{{Request::segment(1)}}</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            {!! $body !!}
            @yield('content')
        </section>
        <!-- /.content -->
    </div>

    <footer class="main-footer">
        {!! $footer !!}
    </footer>
</div>

<!-- Bootstrap 3.3.7 -->
<script src="{{$path}}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="{{$path}}/dist/js/adminlte.min.js"></script>

<!-- layer scripts -->
<script src="{{$assetPath}}/layer/layer.js"></script>
<!-- ace plugin -->
<script src="{{$assetPath}}/js/jquery.gritter.min.js"></script>
<!-- 显示操作信息 使用 gritter 和 一次性的快闪session -->
<!-- show all the operation information, use gritter and flash session -->
{!! \Illuminate\Support\Facades\Session::get('showMessage') !!}
{{\Illuminate\Support\Facades\Session::pull('showMessage')}}
</body>
</html>
