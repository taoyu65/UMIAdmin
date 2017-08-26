@extends('umi::layouts.master')

@section('content')

    <div class="alert bg-info">
        {{--<button type="button" class="close" data-dismiss="alert">
            <i class="fa fa-times"></i>
        </button>--}}
        <p>
            <strong>
                <i class="fa fa-check"></i>
                {{trans('umiTrans::relation.handsUp')}}
            </strong>
            {{trans('umiTrans::relation.turnOff')}}<br>
            <span class="text-bold"><strong>{{trans('umiTrans::relation.turnOff')}}</strong></span>
        </p>
    </div>

    {{-- interlock --}}
    <div class="row">
        <div class="col-sm-3">
            <div class="box box-success box-solid">
                <div class="box-header text-bold">{{trans('umiTrans::relation.deleteInterlock')}}</div>
                <div class="box-body">
                    <ul class="list-unstyled ul-space">
                        <li class="">
                            <i class="fa fa-check fa-green"></i>
                            {{trans('umiTrans::relation.actionDelete')}}
                        </li>

                        <li>
                            <i class="fa fa-check fa-green"></i>
                            {{trans('umiTrans::relation.extraOperation')}}
                        </li>

                        <li>
                            <i class="fa fa-check fa-green"></i>
                            {{trans('umiTrans::relation.relatedOtherTable')}}
                        </li>

                        <li>
                            <i class="fa fa-commenting fa-primary"></i>
                            {{trans('umiTrans::relation.interlockInfo')}}

                        </li>

                        <li>
                            <i class="fa fa-info-circle fa-maroon"></i>
                            {{trans('umiTrans::relation.interlockExample')}}
                        </li>
                    </ul>
                    <hr />
                    <div class="">
                           <span class="label bg-gray">
                                {{trans('umiTrans::relation.delete')}}
                            </span>
                    </div>
                </div>
                <a href="{{url_with_para('relationOpe/adding/interlock')}}" class="btn btn-block btn-success btn-flat">
                    <i class="fa fa-arrow-right"></i>
                    <span>{{trans('umiTrans::relation.next')}}</span>
                </a>
            </div>
        </div>

        {{-- exist --}}
        <div class="col-sm-3">
            <div class="box box-danger box-solid">
                <div class="box-header text-bold">{{trans('umiTrans::relation.exist')}}</div>
                <div class="box-body">
                    <ul class="list-unstyled ul-space">
                        <li>
                            <i class="fa fa-check fa-green"></i>
                            {{trans('umiTrans::relation.actionDeleteEdit')}}
                        </li>

                        <li>
                            <i class="fa fa-times red"></i>
                            {{trans('umiTrans::relation.extraOperation')}}
                        </li>

                        <li>
                            <i class="fa fa-check fa-green"></i>
                            {{trans('umiTrans::relation.relatedOtherTable')}}
                        </li>

                        <li>
                            <i class="fa fa-commenting fa-primary"></i>
                            {{trans('umiTrans::relation.existInfo')}}
                        </li>

                        <li>
                            <i class="fa fa-info-circle fa-maroon"></i>
                            {{trans('umiTrans::relation.existExample')}}
                        </li>
                    </ul>
                    <hr />
                    <div>
                        <span class="label bg-gray">
                            {{trans('umiTrans::relation.delete')}}
                        </span>&nbsp;
                        <span class="label bg-gray">
                            {{trans('umiTrans::relation.edit')}}
                        </span>
                    </div>
                </div>
                <a href="{{url_with_para('relationOpe/adding/interlock')}}" class="btn btn-block btn-danger btn-flat">
                    <i class="fa fa-arrow-right"></i>
                    <span>{{trans('umiTrans::relation.next')}}</span>
                </a>
            </div>
        </div>

        {{-- self check --}}
        <div class="col-sm-3">
            <div class="box box-warning box-solid">
                <div class="box-header text-bold">{{trans('umiTrans::relation.selfCheck')}}</div>
                <div class="box-body">
                    <ul class="list-unstyled ul-space">
                        <li>
                            <i class="fa fa-check fa-green"></i>
                            {{trans('umiTrans::relation.actionDeleteEdit')}}
                        </li>

                        <li>
                            <i class="fa fa-times fa-red"></i>
                            {{trans('umiTrans::relation.extraOperation')}}
                        </li>

                        <li>
                            <i class="fa fa-times fa-red"></i>
                            {{trans('umiTrans::relation.relatedOtherTable')}}
                        </li>

                        <li>
                            <i class="fa fa-commenting fa-primary"></i>
                            {{trans('umiTrans::relation.selfCheckInfo')}}
                        </li>

                        <li>
                            <i class="fa fa-info-circle fa-maroon"></i>
                            {{trans('umiTrans::relation.selfCheckExample')}}
                        </li>
                    </ul>
                    <hr />
                    <div>
                        <span class="label bg-gray">
                            {{trans('umiTrans::relation.delete')}}
                        </span>&nbsp;
                        <span class="label bg-gray">
                            {{trans('umiTrans::relation.edit')}}
                        </span>
                    </div>
                </div>
                <a href="{{url_with_para('relationOpe/adding/interlock')}}" class="btn btn-block btn-warning btn-flat">
                    <i class="fa fa-arrow-right"></i>
                    <span>{{trans('umiTrans::relation.next')}}</span>
                </a>
            </div>
        </div>

        {{-- custom --}}
        <div class="col-sm-3">
            <div class="box box-primary box-solid">
                <div class="box-header text-bold">{{trans('umiTrans::relation.custom')}}</div>
                <div class="box-body">
                    <ul class="list-unstyled ul-space">
                        <li>
                            <i class="fa fa-check fa-green"></i>
                            {{trans('umiTrans::relation.actionDeleteEdit')}}
                        </li>

                        <li>
                            <i class="fa fa-check fa-green"></i>
                            {{trans('umiTrans::relation.extraOperation')}}
                        </li>

                        <li>
                            <i class="fa fa-check fa-green"></i>
                            {{trans('umiTrans::relation.relatedOtherTable')}}
                        </li>

                        <li>
                            <i class="fa fa-commenting fa-primary"></i>
                            {{trans('umiTrans::relation.customInfo')}}
                        </li>

                        <li>
                            <i class="fa fa-info-circle fa-maroon"></i>
                            {{trans('umiTrans::relation.customExample')}}
                        </li>
                    </ul>
                    <hr />
                    <div>
                        <span class="label bg-gray">
                            {{trans('umiTrans::relation.delete')}}
                        </span>&nbsp;
                        <span class="label bg-gray">
                            {{trans('umiTrans::relation.edit')}}
                        </span>
                    </div>
                </div>
                <a href="{{url_with_para('relationOpe/adding/interlock')}}" class="btn btn-block btn-primary btn-flat">
                    <i class="fa fa-arrow-right"></i>
                    <span>{{trans('umiTrans::relation.next')}}</span>
                </a>
            </div>
        </div>
    </div>

@endsection