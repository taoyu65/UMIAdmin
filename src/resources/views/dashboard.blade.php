@extends('umi::layouts.master')
@section('content')

    <?php $assetPath = url(config('umi.assets_path')) ?>
    <?php $path = url($assetPath . '/ace') ?>

    <div class="alert alert-block alert-success">
        <button type="button" class="close" data-dismiss="alert">
            <i class="ace-icon fa fa-times"></i>
        </button>
        <i class="ace-icon fa fa-check green"></i>
        {{trans('umiTrans::dashboard.welcome')}}
        <strong class="green">
            UMI Admin
            <small>(v0.1)</small>
            Made by Laravel 5.3, php 5.6+
        </strong>
    </div>
    <div class="well">
        <h4 class="blue smaller lighter bolder">{{trans('umiTrans::dashboard.admin')}}</h4>
        {{trans('umiTrans::dashboard.info')}}<br><br>
        {{trans('umiTrans::dashboard.wizard')}}
        <span class="label label-lg label-success arrowed-right"><a href="#" class="white" id="wizardUser">{{trans('umiTrans::dashboard.createUser')}}</a></span>
        <span class="label label-lg label-info arrowed-right"><a href="#" target="_blank" class="white">{{trans('umiTrans::dashboard.role')}}</a></span>
        <span class="label label-lg label-warning arrowed-right"><a href="#" target="_blank" class="white">{{trans('umiTrans::dashboard.permission')}}</a></span>
        <span class="label label-lg label-purple"><a href="#" target="_blank" class="white">{{trans('umiTrans::dashboard.sideMenu')}}</a></span>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="widget-box transparent">
                <div class="widget-header widget-header-flat">
                    <h4 class="widget-title lighter">
                        <i class="ace-icon fa fa- orange"></i>
                        {{trans('umiTrans::dashboard.peopleFrom')}}
                    </h4>

                    <div class="widget-toolbar">
                        <a href="#" data-action="collapse">
                            <i class="ace-icon fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>

                <div class="widget-body">
                    <div class="widget-main no-padding">
                        <table class="table table-bordered table-striped">
                            <thead class="thin-border-bottom">
                            <tr>
                                <th>
                                    <i class="ace-icon fa fa-user blue"></i>user name
                                </th>
                                <th>
                                    <i class="ace-icon fa fa-globe blue"></i>ip
                                </th>
                                <th class="hidden-480">
                                    <i class="ace-icon fa fa-caret-right blue"></i>country
                                </th>
                                {{--<th class="hidden-480">
                                    <i class="ace-icon fa fa-caret-right blue"></i>region
                                </th>--}}
                                <th class="hidden-480">
                                    <i class="ace-icon fa fa-caret-right blue"></i>city
                                </th>
                                <th class="hidden-480">
                                    <i class="ace-icon fa fa-caret-right blue"></i>Date
                                </th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($ips as $ip)
                            <tr>
                                <td>{{$ip->user_name}}</td>
                                <td title="{{$ip->ip}}">
                                    <b class="green">{{substr($ip->ip, 0, 19)}}</b>
                                </td>
                                <td class="hidden-480">
                                    <span class="label-light ">{{$ip->country}}</span>
                                </td>
                                {{--<td class="hidden-480">
                                    <span class="label">{{$ip->region}}</span>
                                </td>--}}
                                <td class="hidden-480">
                                    <span class="label label">{{$ip->city}}</span>
                                </td>
                                <td class="hidden-480">
                                    <span class="label label-grey">{{time_tran($ip->created_at)}}</span>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div>{{$link}}</div>
                    </div><!-- /.widget-main -->
                </div><!-- /.widget-body -->
            </div>
        </div>
        <div class="col-sm-6">
            <div class="widget-box transparent">
                <div class="widget-header widget-header-flat">
                    <h4 class="widget-title lighter">
                        <i class="ace-icon fa fa- orange"></i>
                        {{trans('umiTrans::dashboard.chart')}}
                    </h4>

                    <div class="widget-toolbar">
                        <a href="#" data-action="collapse">
                            <i class="ace-icon fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>

                <div class="widget-body">
                    <canvas id="myChart" width="95%" height="38"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="{{$assetPath}}/chart/chartjs.js"></script>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',

            // The data for our dataset
            data: {
                labels: JSON.parse('{!! $label !!}'),
                datasets: [{
                    label: "Visit Amount",
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: [{{$data}}],
                    fill: false
                }]
            },

            // Configuration options go here
            options: {

            }
        });

        jQuery(function ($) {
            $('#wizardUser').click(function () {
                var url = "{{url('adding') . '/' . config('umiEnum.system_table_name.umi_users')}}";
                layer.open({
                    type: 2,
                    title: 'Add User',
                    maxmin: true,
                    shadeClose: true,
                    area: ['80%', '90%'],
                    content: url
                });
            });
        });
    </script>
@endsection