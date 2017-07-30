<div class="navbar-header pull-left">
    <a href="#" class="navbar-brand">
        <small>
            <i class="fa fa-paw"></i>
            UMI Admin
        </small>
    </a>
</div>

<div class="navbar-buttons navbar-header pull-right" role="navigation">
    <ul class="nav ace-nav">
        <li class="light-green dropdown-modal">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <i class="ace-icon fa fa-globe"></i>
                <span class="badge badge-danger">Lang</span>
            </a>

            <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                <li class="dropdown-header">
                    <i class="ace-icon fa fa-globe"></i>
                    {{trans('umiTrans::master.chooseLanguage')}}
                </li>

                <li class="dropdown-content">
                    <ul class="dropdown-menu dropdown-navbar">
                        <li>
                            <a href="{{url('setLanguage/zh_cn')}}">
                                <div class="clearfix">
                                    <span class="pull-left"><img src="{{$assetPath}}/images/zh_cn.png"></span>
                                    <span class="pull-right">汉语</span>
                                </div>
                            </a>
                        </li>

                        <li>
                            <a href="{{url('setLanguage/en')}}">
                                <div class="clearfix">
                                    <span class="pull-left"><img src="{{$assetPath}}/images/en.png"></span>
                                    <span class="pull-right">English</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </li>

        <li class="grey dropdown-modal">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <i class="ace-icon fa fa-tasks"></i>
                <span class="badge badge-grey">4</span>
            </a>

            <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                <li class="dropdown-header">
                    <i class="ace-icon fa fa-check"></i>
                    {{trans('umiTrans::master.task')}}
                </li>

                <li class="dropdown-content">
                    <ul class="dropdown-menu dropdown-navbar">
                        <li>
                            <a href="#">
                                <div class="clearfix">
                                    <span class="pull-left">{{trans('umiTrans::master.softwareUpdate')}}</span>
                                    <span class="pull-right">65%</span>
                                </div>

                                <div class="progress progress-mini">
                                    <div style="width:65%" class="progress-bar"></div>
                                </div>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <div class="clearfix">
                                    <span class="pull-left">{{trans('umiTrans::master.hardwareUpdate')}}</span>
                                    <span class="pull-right">35%</span>
                                </div>

                                <div class="progress progress-mini">
                                    <div style="width:35%" class="progress-bar progress-bar-danger"></div>
                                </div>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <div class="clearfix">
                                    <span class="pull-left">{{trans('umiTrans::master.unitTesting')}}</span>
                                    <span class="pull-right">15%</span>
                                </div>

                                <div class="progress progress-mini">
                                    <div style="width:15%" class="progress-bar progress-bar-warning"></div>
                                </div>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <div class="clearfix">
                                    <span class="pull-left">{{trans('umiTrans::master.bugFix')}}</span>
                                    <span class="pull-right">90%</span>
                                </div>

                                <div class="progress progress-mini progress-striped active">
                                    <div style="width:90%" class="progress-bar progress-bar-success"></div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="dropdown-footer">
                    <a href="#">
                        {{trans('umiTrans::master.taskDetail')}}
                        <i class="ace-icon fa fa-arrow-right"></i>
                    </a>
                </li>
            </ul>
        </li>

        <li class="purple dropdown-modal">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <i class="ace-icon fa fa-bell icon-animated-bell"></i>
                <span class="badge badge-important">8</span>
            </a>

            <ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
                <li class="dropdown-header">
                    <i class="ace-icon fa fa-exclamation-triangle"></i>
                    {{trans('umiTrans::master.notification')}}
                </li>

                <li class="dropdown-content">
                    <ul class="dropdown-menu dropdown-navbar navbar-pink">
                        <li>
                            <a href="#">
                                <div class="clearfix">
                                    <span class="pull-left">
                                        <i class="btn btn-xs no-hover btn-pink fa fa-comment"></i>
                                        {{trans('umiTrans::master.newComment')}}
                                    </span>
                                    <span class="pull-right badge badge-info">+12</span>
                                </div>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="btn btn-xs btn-primary fa fa-user"></i>
                                Bob just signed up as an editor ...
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <div class="clearfix">
                                    <span class="pull-left">
                                        <i class="btn btn-xs no-hover btn-success fa fa-shopping-cart"></i>
                                        {{trans('umiTrans::master.newOrder')}}
                                    </span>
                                    <span class="pull-right badge badge-success">+8</span>
                                </div>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <div class="clearfix">
                                    <span class="pull-left">
                                        <i class="btn btn-xs no-hover btn-info fa fa-twitter"></i>
                                        Followers
                                    </span>
                                    <span class="pull-right badge badge-info">+11</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="dropdown-footer">
                    <a href="#">
                        {{trans('umiTrans::master.allNotification')}}
                        <i class="ace-icon fa fa-arrow-right"></i>
                    </a>
                </li>
            </ul>
        </li>

        <li class="green dropdown-modal">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <i class="ace-icon fa fa-envelope icon-animated-vertical"></i>
                <span class="badge badge-success">5</span>
            </a>

            <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                <li class="dropdown-header">
                    <i class="ace-icon fa fa-envelope-o"></i>
                    {{trans('umiTrans::master.message')}}
                </li>

                <li class="dropdown-content">
                    <ul class="dropdown-menu dropdown-navbar">
                        <li>
                            <a href="#" class="clearfix">
                                <img src="{{$path}}/images/avatars/avatar.png" class="msg-photo" alt="Alex's Avatar" />
                                <span class="msg-body">
                                    <span class="msg-title">
                                        <span class="blue">Alex:</span>
                                        Ciao sociis natoque penatibus et auctor ...
                                    </span>
                                    <span class="msg-time">
                                        <i class="ace-icon fa fa-clock-o"></i>
                                        <span>a moment ago</span>
                                    </span>
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="#" class="clearfix">
                                <img src="{{$path}}/images/avatars/avatar3.png" class="msg-photo" alt="Susan's Avatar" />
                                <span class="msg-body">
                                    <span class="msg-title">
                                        <span class="blue">Susan:</span>
                                        Vestibulum id ligula porta felis euismod ...
                                    </span>
                                    <span class="msg-time">
                                        <i class="ace-icon fa fa-clock-o"></i>
                                        <span>20 minutes ago</span>
                                    </span>
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="#" class="clearfix">
                                <img src="{{$path}}/images/avatars/avatar4.png" class="msg-photo" alt="Bob's Avatar" />
                                <span class="msg-body">
                                    <span class="msg-title">
                                        <span class="blue">Bob:</span>
                                        Nullam quis risus eget urna mollis ornare ...
                                    </span>
                                    <span class="msg-time">
                                        <i class="ace-icon fa fa-clock-o"></i>
                                        <span>3:15 pm</span>
                                    </span>
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="#" class="clearfix">
                                <img src="{{$path}}/images/avatars/avatar2.png" class="msg-photo" alt="Kate's Avatar" />
                                <span class="msg-body">
                                    <span class="msg-title">
                                        <span class="blue">Kate:</span>
                                        Ciao sociis natoque eget urna mollis ornare ...
                                    </span>
                                    <span class="msg-time">
                                        <i class="ace-icon fa fa-clock-o"></i>
                                        <span>1:33 pm</span>
                                    </span>
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="#" class="clearfix">
                                <img src="{{$path}}/images/avatars/avatar5.png" class="msg-photo" alt="Fred's Avatar" />
                                <span class="msg-body">
                                    <span class="msg-title">
                                        <span class="blue">Fred:</span>
                                        Vestibulum id penatibus et auctor  ...
                                    </span>
                                    <span class="msg-time">
                                        <i class="ace-icon fa fa-clock-o"></i>
                                        <span>10:09 am</span>
                                    </span>
                                </span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="dropdown-footer">
                    <a href="#">
                        {{trans('umiTrans::master.allMessage')}}
                        <i class="ace-icon fa fa-arrow-right"></i>
                    </a>
                </li>
            </ul>
        </li>

        <li class="light-blue dropdown-modal">
            <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                <img class="nav-user-photo" src="{{$path}}/images/avatars/user.jpg" alt="{{$userName}}'s Photo" />
                <span class="user-info">
                    <small>{{trans('umiTrans::master.welcome')}}</small>
                    {{$userName}}
                </span>

                <i class="ace-icon fa fa-caret-down"></i>
            </a>

            <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                <li>
                    <a href="#">
                        <i class="ace-icon fa fa-cog"></i>
                        {{trans('umiTrans::master.setting')}}
                    </a>
                </li>

                <li>
                    <a href="#">
                        <i class="ace-icon fa fa-user"></i>
                        {{trans('umiTrans::master.profile')}}
                    </a>
                </li>

                <li class="divider"></li>
                <li>
                    <a href="{{$refresh}}">
                        <i class="ace-icon fa fa-refresh"></i>
                        {{trans('umiTrans::master.refresh')}}
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="{{$logout}}">
                        <i class="ace-icon fa fa-power-off"></i>
                        {{trans('umiTrans::master.logout')}}
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div>