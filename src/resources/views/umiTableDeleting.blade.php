@extends('umi::layouts.model')

@section('body')

    <div class="col-sm-12">
        <h3 class="header smaller lighter red">
            <i class="ace-icon fa fa-bullhorn"></i>
            Delete Confirmation
        </h3>

        @if (!$actionAvailable)
            {!! $message !!}
            <div class="alert alert-danger">
                Currently you can not delete this record until meet the requirement !
                <br /><br /><p>
                    <button class="btn btn-sm btn-danger disabled" disabled>Delete</button>
                    <button class="btn btn-sm btn-info" id="clsDelete">Close</button>
                </p>
            </div>
        @else
            <div class="alert alert-warning">
                Confirm to delete this record?
                <br /><br /><p>
                    <button class="btn btn-sm btn-danger">Delete</button>
                    <button class="btn btn-sm btn-info" id="clsDelete" >Close</button>
                </p>
            </div>
        @endif

    </div>
<script>

    $('#clsDelete').click(function () {
        parent.layer.closeAll();
    });

</script>
@endsection
