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

        function umiTableDelete(tableName, id) {
            var url = "{{url('deleting')}}/" + tableName + '/' + id;
            layer.open ({
                type: 2,
                title: 'Deleting',
                maxmin: true,
                shadeClose: false,
                area : ['800px' , '520px'],
                content: url
            });
        };
    </script>
@endsection