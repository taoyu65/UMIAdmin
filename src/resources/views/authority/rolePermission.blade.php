@extends('umi::layouts.master')

@section('content')
    <h3 class="header smaller orange">Select a Role: <strong><span id="roleTitle" class="red roleTitle"></span></strong></h3>
    <form class="form-horizontal">
        <div class="form-group has-success">
            <label for="userName" class="col-xs-12 col-sm-2 control-label no-padding-right">Role: </label>

            <div class="col-xs-12 col-sm-5">
                <select id="activeTable" name="activeTable" class="chosen-select form-control" data-placeholder="Select a Role">
                    <option value="">Select a Role...</option>
                    @foreach($roles as $id => $role)
                        <option value="{{$id}}">{{$role}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>
    @include('umi::common.authority.permissionCheckBox')

    <script>
        $(document).ready(function () {
           //todo - need complete when click role list to load permissions and submit to update
        });
    </script>
@endsection