@extends('umi::layouts.master')

@section('content')
    <div class="page-header">
        <h1>
            {{trans('umiTrans::relation.relationOperation')}}
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                {{trans('umiTrans::relation.selectAdd')}}
            </small>
        </h1>
    </div>

    <div class="alert alert-block alert-success">
        <button type="button" class="close" data-dismiss="alert">
            <i class="ace-icon fa fa-times"></i>
        </button>

        <p>
            <strong>
                <i class="ace-icon fa fa-check"></i>
                {{trans('umiTrans::relation.handsUp')}}
            </strong>
            {{trans('umiTrans::relation.turnOff')}}
        </p>
    </div>

    <div class="row">
        <div class="col-xs-6 col-sm-3 pricing-box">
            <div class="widget-box widget-color-red3">
                <div class="widget-header">
                    <h5 class="widget-title bigger lighter"><strong>{{trans('umiTrans::relation.deleteInterlock')}}</strong></h5>
                </div>

                <div class="widget-body">
                    <div class="widget-main">
                        <ul class="list-unstyled spaced2">
                            <li>
                                <i class="ace-icon fa fa-check green"></i>
                                {{trans('umiTrans::relation.actionDelete')}}
                            </li>

                            <li>
                                <i class="ace-icon fa fa-check green"></i>
                                {{trans('umiTrans::relation.extraOperation')}}
                            </li>

                            <li>
                                <i class="ace-icon fa fa-check green"></i>
                                {{trans('umiTrans::relation.relatedOtherTable')}}
                            </li>

                            <li>
                                <i class="ace-icon fa fa-commenting blue"></i>
                                {{trans('umiTrans::relation.interlockInfo')}}

                            </li>

                            <li>
                                <i class="ace-icon fa fa-info-circle pink"></i>
                                {{trans('umiTrans::relation.interlockExample')}}
                            </li>
                        </ul>

                        <hr />
                        <div class="price">
                           <span class="label label-white middle">
                                {{trans('umiTrans::relation.delete')}}
                            </span>
                        </div>
                    </div>

                    <div>
                        <a href="{{url_with_para('relationOpe/adding/interlock')}}" class="btn btn-block btn-danger">
                            <i class="ace-icon fa fa-arrow-right bigger-110"></i>
                            <span>{{trans('umiTrans::relation.next')}}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xs-6 col-sm-3 pricing-box">
            <div class="widget-box widget-color-orange">
                <div class="widget-header">
                    <h5 class="widget-title bigger lighter"><strong>{{trans('umiTrans::relation.exist')}}</strong></h5>
                </div>

                <div class="widget-body">
                    <div class="widget-main">
                        <ul class="list-unstyled spaced2">
                            <li>
                                <i class="ace-icon fa fa-check green"></i>
                                {{trans('umiTrans::relation.actionDeleteEdit')}}
                            </li>

                            <li>
                                <i class="ace-icon fa fa-times red"></i>
                                {{trans('umiTrans::relation.extraOperation')}}
                            </li>

                            <li>
                                <i class="ace-icon fa fa-check green"></i>
                                {{trans('umiTrans::relation.relatedOtherTable')}}
                            </li>

                            <li>
                                <i class="ace-icon fa fa-commenting blue"></i>
                                {{trans('umiTrans::relation.existInfo')}}
                            </li>

                            <li>
                                <i class="ace-icon fa fa-info-circle pink"></i>
                                {{trans('umiTrans::relation.existExample')}}
                            </li>
                        </ul>

                        <hr />
                        <div class="price">
                           <span class="label label-white middle">
                                {{trans('umiTrans::relation.delete')}}
                            </span>
                            <span class="label label-white middle">
                               {{trans('umiTrans::relation.edit')}}
                            </span>
                        </div>
                    </div>

                    <div>
                        <a href="{{url_with_para('relationOpe/adding/exist')}}" class="btn btn-block btn-warning">
                            <i class="ace-icon fa fa-arrow-right bigger-110"></i>
                            <span>{{trans('umiTrans::relation.next')}}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xs-6 col-sm-3 pricing-box">
            <div class="widget-box widget-color-blue">
                <div class="widget-header">
                    <h5 class="widget-title bigger lighter"><strong>{{trans('umiTrans::relation.selfCheck')}}</strong></h5>
                </div>

                <div class="widget-body">
                    <div class="widget-main">
                        <ul class="list-unstyled spaced2">
                            <li>
                                <i class="ace-icon fa fa-check green"></i>
                                {{trans('umiTrans::relation.actionDeleteEdit')}}
                            </li>

                            <li>
                                <i class="ace-icon fa fa-times red"></i>
                                {{trans('umiTrans::relation.extraOperation')}}
                            </li>

                            <li>
                                <i class="ace-icon fa fa-times red"></i>
                                {{trans('umiTrans::relation.relatedOtherTable')}}
                            </li>

                            <li>
                                <i class="ace-icon fa fa-commenting blue"></i>
                                {{trans('umiTrans::relation.selfCheckInfo')}}
                            </li>

                            <li>
                                <i class="ace-icon fa fa-info-circle pink"></i>
                                {{trans('umiTrans::relation.selfCheckExample')}}
                            </li>
                        </ul>

                        <hr />
                        <div class="price">
                            <span class="label label-white middle">
                                {{trans('umiTrans::relation.delete')}}
                            </span>
                            <span class="label label-white middle">
                               {{trans('umiTrans::relation.edit')}}
                            </span>
                        </div>
                    </div>

                    <div>
                        <a href="{{url_with_para('relationOpe/adding/selfCheck')}}" class="btn btn-block btn-primary">
                            <i class="ace-icon fa fa-arrow-right bigger-110"></i>
                            <span>{{trans('umiTrans::relation.next')}}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xs-6 col-sm-3 pricing-box">
            <div class="widget-box widget-color-green">
                <div class="widget-header">
                    <h5 class="widget-title bigger lighter"><strong>{{trans('umiTrans::relation.custom')}}</strong></h5>
                </div>

                <div class="widget-body">
                    <div class="widget-main">
                        <ul class="list-unstyled spaced2">
                            <li>
                                <i class="ace-icon fa fa-check green"></i>
                                {{trans('umiTrans::relation.actionDeleteEdit')}}
                            </li>

                            <li>
                                <i class="ace-icon fa fa-check green"></i>
                                {{trans('umiTrans::relation.extraOperation')}}
                            </li>

                            <li>
                                <i class="ace-icon fa fa-check green"></i>
                                {{trans('umiTrans::relation.relatedOtherTable')}}
                            </li>

                            <li>
                                <i class="ace-icon fa fa-commenting blue"></i>
                                {{trans('umiTrans::relation.customInfo')}}
                            </li>

                            <li>
                                <i class="ace-icon fa fa-info-circle pink"></i>
                                {{trans('umiTrans::relation.customExample')}}
                            </li>
                        </ul>

                        <hr />
                        <div class="price">
                            <span class="label label-white middle">
                                {{trans('umiTrans::relation.delete')}}
                            </span>
                            <span class="label label-white middle">
                               {{trans('umiTrans::relation.edit')}}
                            </span>
                        </div>
                    </div>

                    <div>
                        <a href="{{url_with_para('relationOpe/adding/custom')}}" class="btn btn-block btn-success">
                            <i class="ace-icon fa fa-arrow-right bigger-110"></i>
                            <span>{{trans('umiTrans::relation.next')}}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div >
    </div>

@endsection