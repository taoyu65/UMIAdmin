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
                                Related to other tables
                            </li>

                            <li>
                                <i class="ace-icon fa fa-commenting blue"></i>
                                After you delete one record and all the records from another tables will be deleted according to the rules you make

                            </li>

                            <li>
                                <i class="ace-icon fa fa-info-circle pink"></i>
                                Example: article and comments - when an article is deleted then all the comments will be deleted. Or delete a user and all the data from different table relative user will be deleted
                            </li>
                        </ul>

                        <hr />
                        <div class="price">
                           <span class="label label-white middle">
                                Delete
                            </span>
                        </div>
                    </div>

                    <div>
                        <a href="{{url_with_para('relationOpe/adding/interlock')}}" class="btn btn-block btn-danger">
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
                                Action: Delete Read Edit
                            </li>

                            <li>
                                <i class="ace-icon fa fa-times red"></i>
                                Extra operation: effect other tables
                            </li>

                            <li>
                                <i class="ace-icon fa fa-check green"></i>
                                Related to other tables
                            </li>

                            <li>
                                <i class="ace-icon fa fa-commenting blue"></i>
                                Check the field from another tables and the rules have to be matched before activate the main action (button available)
                            </li>

                            <li>
                                <i class="ace-icon fa fa-info-circle pink"></i>
                                Example: article and its classification - before deleting an article's classification you want to check if there any article still use this classification (prevent pointing a data does not exist)
                            </li>
                        </ul>

                        <hr />
                        <div class="price">
                           <span class="label label-white middle">
                                Delete
                            </span>
                            <span class="label label-white middle">
                               Edit
                            </span>
                        </div>
                    </div>

                    <div>
                        <a href="{{url_with_para('relationOpe/adding/exist')}}" class="btn btn-block btn-warning">
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
                                Action: Delete Read Edit
                            </li>

                            <li>
                                <i class="ace-icon fa fa-times red"></i>
                                Extra operation: effect other tables
                            </li>

                            <li>
                                <i class="ace-icon fa fa-times red"></i>
                                Related to other tables
                            </li>

                            <li>
                                <i class="ace-icon fa fa-commenting blue"></i>
                                Check the specific field to match the rule from the table itself(not other table) before the execute the main action
                            </li>

                            <li>
                                <i class="ace-icon fa fa-info-circle pink"></i>
                                Example: article - this table has a field is marked publish, for protecting un-publish article you can set rule that any action will be execute only when the article has been published
                            </li>
                        </ul>

                        <hr />
                        <div class="price">
                            <span class="label label-white middle">
                                Delete
                            </span>
                            <span class="label label-white middle">
                               Edit
                            </span>
                        </div>
                    </div>

                    <div>
                        <a href="{{url_with_para('relationOpe/adding/selfCheck')}}" class="btn btn-block btn-primary">
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
                                Action: Delete Read Edit
                            </li>

                            <li>
                                <i class="ace-icon fa fa-check green"></i>
                                Extra operation: effect other tables
                            </li>

                            <li>
                                <i class="ace-icon fa fa-check green"></i>
                                Related to other tables
                            </li>

                            <li>
                                <i class="ace-icon fa fa-commenting blue"></i>
                                Custom rules to achieve specific function, need to program your own code, rule's name is the function name
                            </li>

                            <li>
                                <i class="ace-icon fa fa-info-circle pink"></i>
                                Example: After a article get deleted and the number of amount of that author's article will be subtract by one (article table and amount of article may not be the same table)
                            </li>
                        </ul>

                        <hr />
                        <div class="price">
                            <span class="label label-white middle">
                                Delete
                            </span>
                            <span class="label label-white middle">
                               Edit
                            </span>
                        </div>
                    </div>

                    <div>
                        <a href="{{url_with_para('relationOpe/adding/custom')}}" class="btn btn-block btn-success">
                            <i class="ace-icon fa fa-arrow-right bigger-110"></i>
                            <span>Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div >
    </div>

@endsection