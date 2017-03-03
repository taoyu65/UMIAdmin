@extends('umi::layouts.master')

@section('content')
    <div class="page-header">
        <h1>
            UMI Tables
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Data Table Manage &amp; Search
            </small>
        </h1>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <ul class="nav nav-tabs" id="myTab">
                <li class="active">
                    <a data-toggle="tab" href="#home">
                        <i class="green ace-icon fa fa-list bigger-120"></i>
                        ALL
                    </a>
                </li>

                <li>
                    <a data-toggle="tab" href="#messages">
                        UMI
                    </a>
                </li>

                <li>
                    <a data-toggle="tab" href="#dropdown1">
                        Customer
                        <span class="badge badge-info">4</span>
                    </a>
                </li>
            </ul>

            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <p>Raw denim you probably haven't heard of them jean shorts Austin.</p>
                </div>

                <div id="messages" class="tab-pane fade">
                    <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid.</p>
                </div>

                <div id="dropdown1" class="tab-pane fade">
                    <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade.</p>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            asdf
        </div>
    </div>

@endsection