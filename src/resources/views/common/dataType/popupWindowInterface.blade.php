@extends('umi::layouts.model')

@section('content')

    <?php $assetPath = url(config('umi.assets_path')) ?>
    <?php $path = url($assetPath . '/ace') ?>

    <link rel="stylesheet" href="{{$path}}/css/chosen.min.css" />

    <div class="col-sm-12">
        <h3 class="header blue lighter smaller">
            <i class="ace-icon fa fa-gear smaller-90"></i>
            Generate Popup Window Rules
        </h3>
    </div>

    <form class="form-horizontal" method="post" action="">
        <div class="form-group">
            <label class="control-label col-xs-12 col-sm-2 no-padding-right" for="tableName">Table Name</label>
            <div class="col-xs-12 col-sm-4">
                <select class="form-control" id="tableName" required>
                    <option value="">Select a Table...</option>
                    @foreach($table as $item => $value)
                        <option value="{{$item}}">{{$item}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-xs-12 col-sm-2 no-padding-right" for="returnField">Return Field</label>
            <div class="col-xs-12 col-sm-4">
                <select class="form-control" id="returnField" name="returnField" required>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-xs-12 col-sm-2 no-padding-right" for="searchField">Search Field</label>
            <div class="col-xs-12 col-sm-4">
                <select class="form-control" id="searchField" name="searchField" required>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-xs-12 col-sm-2 no-padding-right" for="showField">Show Field</label>
            <div class="col-xs-12 col-sm-4" id="showFieldParent">
                <select multiple="" class="chosen-select form-control tag-input-style" id="showField" data-placeholder="Choose Fields...">
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-xs-12 col-sm-2 no-padding-right"></label>
            <div class="col-xs-12 col-sm-4">
                <button type="button" class="btn btn-info" id="generate">Generate Role</button>
                <button type="button" class="btn btn-grey" id="close">Close</button>
            </div>
        </div>
    </form>

    <script src="{{$path}}/js/chosen.jquery.min.js"></script>

    <script type="text/javascript">

        $(document).ready(function () {
            if(!ace.vars['touch']) {
                $('.chosen-select').chosen({allow_single_deselect:true});
                //resize the chosen on window resize

                $(window)
                    .off('resize.chosen')
                    .on('resize.chosen', function() {
                        $('.chosen-select').each(function() {
                            var $this = $(this);
                            $this.next().css({'width': $this.parent().width()});
                        })
                    }).trigger('resize.chosen');
            };

            $('#close').click(function () {
                parent.layer.closeAll();
            });

            $('#generate').click(function () {
                var obj = Object();
                obj.tableName = $('#tableName').val();
                obj.returnField = $('#returnField').val();
                obj.searchField = $('#searchField').val();
                obj.showFields = $('#showField').val();
                if (obj.returnField === null || obj.showFields === null) {
                    layer.alert('return and show field can not be empty!', {title: 'wrong'});
                    return false;
                }
                var returnJson = JSON.stringify(obj);
                parent.$('#{{$customValueDomId}}').val(returnJson);
                parent.layer.closeAll();
            });

            $('#tableName').change(function () {

                if ($(this).val() === '') {
                    return false;
                }

                var load = layer.load(3, {shade: [0.5, '#000']});
                //var tableId = $(this).val();
                var tableName = $(this).find("option:selected").text();
                var url = "{{url('api/fields')}}/" + tableName;

                $.ajax({
                    type: 'get',
                    url: url,
                    success: function (data) {
                        $('#showFieldParent').empty();
                        data = JSON.parse(data);
                        $('#showFieldParent').append('<select multiple="" class="chosen-select form-control tag-input-style" id="showField" data-placeholder="Choose Fields...">');
                        $.each(data, function (value, text) {
                            $('#showField').append("<option value='" + text + "'>" + text + "</option>");
                        });
                        $('#showFieldParent').append('</select>');
                        $('.chosen-select').chosen({allow_single_deselect:true});
                        //复制获得的所有字段
                        //clone all the fields
                        var cloneFields = $('#showField option').clone();
                        var cloneFields2 = $('#showField option').clone();

                        $('#returnField').empty();
                        cloneFields.appendTo($('#returnField'));

                        $('#searchField').empty();
                        cloneFields2.appendTo($('#searchField'));

                    },
                    error: function () {
                        layer.alert('Something went wrong!', {title: ''});
                    },
                    complete: function () {
                        layer.close(load);
                    }
                });
            });
        });
    </script>
@endsection