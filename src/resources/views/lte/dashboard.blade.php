@extends('umi::layouts.master')
@section('content')

    <?php $assetPath = url(config('umi.assets_path')) ?>
    <?php $path = url($assetPath . '/lte') ?>

    <div class="callout callout-success">
        <h4>{{trans('umiTrans::dashboard.welcome')}} <strong>UMI Admin</strong><small>(v0.1)</small></h4>
        <p>Made by Laravel 5.3, php 5.6+</p>
    </div>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{trans('umiTrans::dashboard.admin')}}</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            {{trans('umiTrans::dashboard.info')}}<br><br>
            <h4>{{trans('umiTrans::dashboard.wizard')}}
            <span class="label label-danger"><a href="#" class="fa-white" id="wizardUser">{{trans('umiTrans::dashboard.createUser')}}</a></span>
            <span class="label label-success"><a href="#" class="fa-white" id="wizardRole">{{trans('umiTrans::dashboard.role')}}</a></span>
            <span class="label label label-info"><a href="#" class="fa-white" id="wizardSetRole">{{trans('umiTrans::dashboard.setRole')}}</a></span>
            <span class="label label-warning"><a href="{{route('rolePermission')}}" target="_blank" class="fa-white">{{trans('umiTrans::dashboard.permission')}}</a></span>
            <span class="label label-primary"><a href="{{url('menuManagement' . '/' . config('umiEnum.system_table_name.umi_menus') . '/distribution')}}" target="_blank" class="fa-white">{{trans('umiTrans::dashboard.sideMenu')}}</a></span>
            </h4>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-6">
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">{{trans('umiTrans::dashboard.peopleFrom')}}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>user name</th>
                            <th>IP</th>
                            <th>Country</th>
                            <th>City</th>
                            <th>Date</th>
                        </tr>
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
                    </table>
                    <div>{{$link}}</div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <div class="col-xs-6">
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">{{trans('umiTrans::dashboard.chart')}}</h3>
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

            $('#wizardRole').click(function () {
                var url = "{{url('adding') . '/' . config('umiEnum.system_table_name.umi_roles')}}";
                layer.open({
                    type: 2,
                    title: 'Add Role',
                    maxmin: true,
                    shadeClose: true,
                    area: ['80%', '90%'],
                    content: url
                });
            });

            $('#wizardSetRole').click(function () {
                var url = "{{url('adding') . '/' . config('umiEnum.system_table_name.umi_user_role')}}";
                layer.open({
                    type: 2,
                    title: 'Set User\'s Role',
                    maxmin: true,
                    shadeClose: true,
                    area: ['80%', '90%'],
                    content: url
                });
            });
        });
    </script>
@endsection