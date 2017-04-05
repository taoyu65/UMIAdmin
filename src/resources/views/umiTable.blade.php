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


    <div class="tabbable">
        <ul class="nav nav-tabs" id="myTab1">
            <li class="">
                <a data-toggle="tab" href="#home">
                    <i class="green ace-icon fa fa-search bigger-120"></i>
                    Home
                </a>
            </li>

            <li>
                <a data-toggle="tab" href="#messages">
                    Messages
                </a>
            </li>

            <li class="dropdown active">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                    Dropdown &nbsp;
                    <i class="green ace-icon fa fa-question bigger-120"></i>
                    <i class="ace-icon fa fa-caret-down bigger-110 width-auto"></i>
                </a>

                <ul class="dropdown-menu dropdown-info">
                    <li>
                        <a data-toggle="tab" href="#dropdown1">@fat</a>
                    </li>

                    <li>
                        <a data-toggle="tab" href="#dropdown2">@mdo</a>
                    </li>
                </ul>
            </li>
        </ul>


        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
                <p>Raw denim you probably haven't heard of them jean shorts Austin.</p>
            </div>

            <div id="messages" class="tab-pane fade ">
                <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid.</p>
            </div>

            <div id="dropdown1" class="tab-pane fade">
                <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade.</p>
            </div>

            <div id="dropdown2" class="tab-pane fade">
                <p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin.</p>
            </div>
        </div>
    </div>



    <br>
    {!! $header !!}

    {!! $tableBody !!}

    {!! $footer !!}

@endsection