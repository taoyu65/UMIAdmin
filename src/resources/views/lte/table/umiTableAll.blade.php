@extends('umi::layouts.master')

@section('content')

    <div class="row">
        <div class="col-md-6">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
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
                            <span class="label label-primary">4</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="home" class="tab-pane active">
                        <p>Raw denim you probably haven't heard of them jean shorts Austin.</p>
                    </div>

                    <div id="messages" class="tab-pane">
                        <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid.</p>
                    </div>

                    <div id="dropdown1" class="tab-pane">
                        <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection