<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>Dashboard - UMI Admin</title>

    <?php $assetPath = url(config('umi.assets_path')) ?>
    <?php $path = url($assetPath . '/ace') ?>

    <meta name="description" content="overview &amp; stats" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="{{$path}}/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{$path}}/font-awesome/4.5.0/css/font-awesome.min.css" />

    <!-- plug in -->
    <link rel="stylesheet" href="{{$path}}/css/jquery.gritter.min.css" />
    <link rel="stylesheet" href="{{$path}}/css/chosen.min.css" />
    <link rel="stylesheet" href="{{$path}}/css/select2.min.css" />

    <!-- text fonts -->
    <link rel="stylesheet" href="{{$path}}/css/fonts.googleapis.com.css" />

    <!-- ace styles -->
    <link rel="stylesheet" href="{{$path}}/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="{{$path}}/css/ace-part2.min.css" class="ace-main-stylesheet" />
    <![endif]-->

    <link rel="stylesheet" href="{{$path}}/css/ace-skins.min.css" />
    <link rel="stylesheet" href="{{$path}}/css/ace-rtl.min.css" />

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="{{$path}}/css/ace-ie.min.css" />
    <![endif]-->

    <!--[if !IE]> -->
    <script src="{{$path}}/js/jquery-2.1.4.min.js"></script>
    <!-- <![endif]-->

    <!--[if IE]>
    <script src="{{$path}}/js/jquery-1.11.3.min.js"></script>
    <![endif]-->

</head>

<body class="no-skin">
<div id="navbar" class="navbar navbar-default          ace-save-state">
    <div class="navbar-container ace-save-state" id="navbar-container">
        <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
            <span class="sr-only">Toggle sidebar</span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>
        </button>

        {!! $header !!}

    </div><!-- /.navbar-container -->
</div>

<div class="main-container ace-save-state" id="main-container">
    <script type="text/javascript">
        try{ace.settings.loadState('main-container')}catch(e){}
    </script>

    <div id="sidebar" class="sidebar responsive ace-save-state">
        <script type="text/javascript">
            try{ace.settings.loadState('sidebar')}catch(e){}
        </script>

        <div class="sidebar-shortcuts" id="sidebar-shortcuts">
            <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
                <button class="btn btn-success" onclick="window.location.href='{{url('umiTable')}}'">
                    <i class="ace-icon fa fa-bars"></i>
                </button>

                <button class="btn btn-info">
                    <i class="ace-icon fa fa-pencil"></i>
                </button>

                <button class="btn btn-warning">
                    <i class="ace-icon fa fa-users"></i>
                </button>

                <button class="btn btn-danger">
                    <i class="ace-icon fa fa-cogs"></i>
                </button>
            </div>

            <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
                <span class="btn btn-success"></span>

                <span class="btn btn-info"></span>

                <span class="btn btn-warning"></span>

                <span class="btn btn-danger"></span>
            </div>
        </div><!-- /.sidebar-shortcuts -->

        <ul class="nav nav-list">
            {!! $sideMenu !!}
        </ul><!-- /.nav-list -->

        <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
            <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
        </div>
    </div>

    <div class="main-content">
        <div class="main-content-inner">
            <div class="breadcrumbs ace-save-state" id="breadcrumbs">

                <ul class="breadcrumb">
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <li>
                        <a href="">Dashboard</a>
                    </li>
                    <li class="active">{{Request::segment(1)}}</li>
                </ul>
            </div>
            <div class="page-content">
                {!! $body !!}
                @yield('content')
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->

    <div class="footer">
        <div class="footer-inner">
            <div class="footer-content">
                {!! $footer !!}
            </div>
        </div>
    </div>

    <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
        <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
    </a>
</div><!-- /.main-container -->

<!-- basic scripts -->
<script type="text/javascript">
    if('ontou chstart' in document.documentElement) document.write("<script src='{{$path}}/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>
<script src="{{$path}}/js/bootstrap.min.js"></script>

<!-- ace scripts -->
<script src="{{$path}}/js/ace-elements.min.js"></script>
<script src="{{$path}}/js/ace.min.js"></script>

<!-- layer scripts -->
<script src="{{$assetPath}}/layer/layer.js"></script>

<!-- ace plugin -->
<script src="{{$path}}/js/jquery.gritter.min.js"></script>

<!-- 显示操作信息 使用 gritter 和 一次性的快闪session -->
<!-- show all the operation information, use gritter and flash session -->
{!! \Illuminate\Support\Facades\Session::get('showMessage') !!}

</body>
</html>
