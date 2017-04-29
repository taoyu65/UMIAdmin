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

    {!! $header !!}

    {!! $tableBody !!}

    {!! $footer !!}

    <script type="text/javascript">
        jQuery(function($) {
        });

        function umiTableDelete(tableName, id, activeFields) {
            var urlActiveFields = (activeFields === '') ? '' : '/' + activeFields;
            var url = "<?php echo e(url('deleting')); ?>/" + tableName + '/' + id + urlActiveFields;
            var delConfirm = layer.open ({
                type: 2,
                title: 'Deleting',
                maxmin: true,
                shadeClose: true,
                area : ['800px' , '520px'],
                content: url
            });
        };
    </script>
@endsection