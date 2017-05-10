@extends('umi::layouts.master')

@section('content')
    <div class="page-header">
        <h1>
            Relation Operation
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Select &amp; Add
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
                Hands Up!
            </strong>
            You can turn off this function in config file.
        </p>
    </div>

    <div class="row">
        <div class="col-xs-6 col-sm-3 pricing-box">
            <div class="widget-box widget-color-red3">
                <div class="widget-header">
                    <h5 class="widget-title bigger lighter"><strong>Delete Interlock</strong></h5>
                </div>

                <div class="widget-body">
                    <div class="widget-main">
                        <ul class="list-unstyled spaced2">
                            <li>
                                <i class="ace-icon fa fa-check green"></i>
                                Action: Delete
                            </li>

                            <li>
                                <i class="ace-icon fa fa-check green"></i>
                                Extra operation: effect other tables
                            </li>

                            <li>
                                <i class="ace-icon fa fa-check green"></i>
                                Related other tables
                            </li>

                            <li>
                                <i class="ace-icon fa fa-commenting blue"></i>
                                After you delete one record all the records from other tables will be deleted according to the rules you make
                            </li>

                            <li>
                                <i class="ace-icon fa fa-info-circle pink"></i>
                                Example: article and comments - when an article is deleted then<br>
                                all the comments will be deleted<br><br>
                            </li>
                        </ul>

                        <hr />
                        <div class="price">
                            <span class="label label-xlg label-grey arrowed-in-right arrowed-in">
                                Delete
                            </span>
                        </div>
                    </div>

                    <div>
                        <a href="#" class="btn btn-block btn-danger">
                            <i class="ace-icon fa fa-arrow-right bigger-110"></i>
                            <span>Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xs-6 col-sm-3 pricing-box">
            <div class="widget-box widget-color-orange">
                <div class="widget-header">
                    <h5 class="widget-title bigger lighter"><strong>Exist</strong></h5>
                </div>

                <div class="widget-body">
                    <div class="widget-main">
                        <ul class="list-unstyled spaced2">
                            <li>
                                <i class="ace-icon fa fa-check green"></i>
                                Action: Delete Read Edit Add
                            </li>

                            <li>
                                <i class="ace-icon fa fa-times red"></i>
                                Extra operation: effect other tables
                            </li>

                            <li>
                                <i class="ace-icon fa fa-check green"></i>
                                Related other tables
                            </li>

                            <li>
                                <i class="ace-icon fa fa-commenting blue"></i>
                                Check other tables and match the rule before the activate the main action
                            </li>

                            <li>
                                <i class="ace-icon fa fa-info-circle pink"></i>
                                Example: article and article's classification - before delete an article's classification you want to check if there is an article still use this classification
                            </li>
                        </ul>

                        <hr />
                        <div class="price">
                            <span class="label label-xlg label-grey arrowed-in-right arrowed-in">
                                Delete
                            </span>
                            <span class="label label-xlg label-grey arrowed-in-right arrowed-in">
                                Read
                            </span>
                            <span class="label label-xlg label-grey arrowed-in-right arrowed-in">
                               Edit
                            </span>
                            <span class="label label-xlg label-grey arrowed-in-right arrowed-in">
                                Add
                            </span>
                        </div>
                    </div>

                    <div>
                        <a href="#" class="btn btn-block btn-warning">
                            <i class="ace-icon fa fa-arrow-right bigger-110"></i>
                            <span>Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xs-6 col-sm-3 pricing-box">
            <div class="widget-box widget-color-blue">
                <div class="widget-header">
                    <h5 class="widget-title bigger lighter"><strong>Self Check</strong></h5>
                </div>

                <div class="widget-body">
                    <div class="widget-main">
                        <ul class="list-unstyled spaced2">
                            <li>
                                <i class="ace-icon fa fa-check green"></i>
                                Action: Delete Read Edit Add
                            </li>

                            <li>
                                <i class="ace-icon fa fa-times red"></i>
                                Extra operation: effect other tables
                            </li>

                            <li>
                                <i class="ace-icon fa fa-times red"></i>
                                Related other tables
                            </li>

                            <li>
                                <i class="ace-icon fa fa-commenting blue"></i>
                                Check the specific field to match the rule from this table before the action
                            </li>

                            <li>
                                <i class="ace-icon fa fa-info-circle pink"></i>
                                Example: article - Delete or update would be execute only when the article has been published
                                <br><br>
                            </li>
                        </ul>

                        <hr />
                        <div class="price">
                            <span class="label label-xlg label-grey arrowed-in-right arrowed-in">
                                Delete
                            </span>
                            <span class="label label-xlg label-grey arrowed-in-right arrowed-in">
                                Read
                            </span>
                            <span class="label label-xlg label-grey arrowed-in-right arrowed-in">
                               Edit
                            </span>
                            <span class="label label-xlg label-grey arrowed-in-right arrowed-in">
                                Add
                            </span>
                        </div>
                    </div>

                    <div>
                        <a href="#" class="btn btn-block btn-primary">
                            <i class="ace-icon fa fa-arrow-right bigger-110"></i>
                            <span>Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xs-6 col-sm-3 pricing-box">
            <div class="widget-box widget-color-green">
                <div class="widget-header">
                    <h5 class="widget-title bigger lighter"><strong>Custom</strong></h5>
                </div>

                <div class="widget-body">
                    <div class="widget-main">
                        <ul class="list-unstyled spaced2">
                            <li>
                                <i class="ace-icon fa fa-check green"></i>
                                Action: Delete Read Edit Add
                            </li>

                            <li>
                                <i class="ace-icon fa fa-check green"></i>
                                Extra operation: effect other tables
                            </li>

                            <li>
                                <i class="ace-icon fa fa-check green"></i>
                                Related other tables
                            </li>

                            <li>
                                <i class="ace-icon fa fa-commenting blue"></i>
                                Custom rules to achieve specific function, need to program your own code, custom rule name will be function name
                            </li>

                            <li>
                                <i class="ace-icon fa fa-info-circle pink"></i>
                                Example: After a article get deleted and the number of amount of that author's article will be subtract by one (article table and
                                amount of article may not be the same table)
                            </li>
                        </ul>

                        <hr />
                        <div class="price">
                            <span class="label label-xlg label-grey arrowed-in-right arrowed-in">
                                Delete
                            </span>
                            <span class="label label-xlg label-grey arrowed-in-right arrowed-in">
                                Read
                            </span>
                            <span class="label label-xlg label-grey arrowed-in-right arrowed-in">
                               Edit
                            </span>
                            <span class="label label-xlg label-grey arrowed-in-right arrowed-in">
                                Add
                            </span>
                        </div>
                    </div>

                    <div>
                        <a href="#" class="btn btn-block btn-success">
                            <i class="ace-icon fa fa-arrow-right bigger-110"></i>
                            <span>Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection