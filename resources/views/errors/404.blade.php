@extends('umi::layouts.model')

@section('body')
    <div class="error-container">
        <div class="well">
            <h1 class="grey lighter smaller">
                <span class="blue bigger-125">
                    <i class="ace-icon fa fa-caret-right"></i>
                    404
                </span>
                {{$exception->getMessage()}}
            </h1>
            <hr />
            <h3 class="lighter smaller">
                We looked everywhere but we couldn't find it!
            </h3>
            <div class="space"></div>
            <div>
                <h4 class="lighter smaller">Meanwhile, try one of the following:</h4>
                <ul class="list-unstyled spaced inline bigger-110 margin-15">
                    <li>
                        <i class="ace-icon fa fa-hand-o-right blue"></i>
                        contact administrator
                    </li>
                </ul>
            </div>
            <hr />
            <div class="space"></div>
            <div class="center">
                <a href="javascript:history.back()" class="btn btn-grey">
                    <i class="ace-icon fa fa-arrow-left"></i>
                    Go Back
                </a>
                <a href="{{route('dashboard')}}" class="btn btn-primary">
                    <i class="ace-icon fa fa-tachometer"></i>
                    Dashboard
                </a>
            </div>
        </div>
    </div>
@endsection
