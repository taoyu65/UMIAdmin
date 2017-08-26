<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>UMI admin - login page</title>

    <?php $path = url(config('umi.assets_path')) . '/lte' ?>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{$path}}/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{$path}}/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{$path}}/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{$path}}/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{$path}}/plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <style>
        .tou{
            background: url("{{$path}}/images/login/tou.png") no-repeat;
            width: 97px;
            height: 92px;
            position: absolute;
            top: -87px;
            left: 100px;
        }
        .left_hand{
            background: url("{{$path}}/images/login/left_hand.png") no-repeat;
            width: 32px;
            height: 37px;
            position: absolute;
            top: -38px;
            left: 90px;
        }
        .right_hand{
            background: url("{{$path}}/images/login/right_hand.png") no-repeat;
            width: 32px;
            height: 37px;
            position: absolute;
            top: -38px;
            right: -75px;
        }
        .initial_left_hand{
            background: url("{{$path}}/images/login/hand.png") no-repeat;
            width: 30px;
            height: 20px;
            position: absolute;
            top: -12px;
            left: 60px;
        }
        .initial_right_hand{
            background: url("{{$path}}/images/login/hand.png") no-repeat;
            width: 30px;
            height: 20px;
            position: absolute;
            top: -12px;
            right: -75px;
        }
        .left_handing{
            background: url("{{$path}}/images/login/left-handing.png") no-repeat;
            width: 30px;
            height: 20px;
            position: absolute;
            top: -24px;
            left: 70px;
        }
        .right_handinging{
            background: url("{{$path}}/images/login/right_handing.png") no-repeat;
            width: 30px;
            height: 20px;
            position: absolute;
            top: -21px;
            left: 170px;
        }

    </style>
</head>
<body class="hold-transition login-page">

@if(isset($error))
    {!! $error !!}
@endif
@if ($errors->has('password'))
    <script>
        alert('{{$errors->first('password')}}');
    </script>
@endif
@if ($errors->has('email'))
    <script>
        alert('{{$errors->first('email')}}');
    </script>
@endif

<div class="login-box">
    <div class="login-logo">
        <h1>
            <i class="ace-icon fa fa-paw fa-success"></i>
            <span class="fa-danger">UMI</span>
            <span class="fa-gray" id="id-text2">Admin</span>
        </h1>
    </div>
    <div style="padding-bottom: 50px;"></div>
    <div class="space-6"></div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <DIV style="width: 165px; height: 96px; position: absolute;">
            <DIV class="tou"></DIV>
            <DIV class="initial_left_hand" id="left_hand"></DIV>
            <DIV class="initial_right_hand" id="right_hand"></DIV>
        </DIV>

        <form method="post" action="{{url('submit')}}">
            {!! csrf_field() !!}
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Username" name="username" value="admin">
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password" id="password" name="password" value="123123">
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" checked> {{trans('umiTrans::login.rememberPassword')}}
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">{{trans('umiTrans::login.login')}}</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <div class="social-auth-links text-center">
            <p>- {{trans('umiTrans::login.otherWayLogin')}} -</p>
            <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
                Facebook</a>
            <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
                Google+</a>
        </div>
        <!-- /.social-auth-links -->

        <a href="#">{{trans('umiTrans::login.forget')}}</a><br>
        <a href="#" class="text-center">{{trans('umiTrans::login.iWantRegister')}}</a>

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="{{$path}}/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{$path}}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="{{$path}}/plugins/iCheck/icheck.min.js"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
<SCRIPT type="text/javascript">
    $(function(){

        $("#password").focus(function(){
            $("#left_hand").animate({
                left: "110",
                top: " -38"
            },{step: function(){
                if(parseInt($("#left_hand").css("left"))>100){
                    $("#left_hand").attr("class","left_hand");
                }
            }}, 2000);
            $("#right_hand").animate({
                right: "-35",
                top: "-38px"
            },{step: function(){
                if(parseInt($("#right_hand").css("right"))> -41){
                    $("#right_hand").attr("class","right_hand");
                }
            }}, 2000);
        });

        $("#password").blur(function(){
            $("#left_hand").attr("class","initial_left_hand");
            $("#left_hand").attr("style","left:60px;top:-12px;");
            $("#right_hand").attr("class","initial_right_hand");
            $("#right_hand").attr("style","right:-75px;top:-12px");
        });
    });
</SCRIPT>
</body>
</html>