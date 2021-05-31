@extends('dashboard.layout.app')

{{-- page title --}}
@section('dashboard_page_title', 'Size Add')

{{-- custom stylesheet --}}
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/dashboard/modules/size.css') }}">
@endsection

{{-- breadcrumb links --}}
@section('dashboard_breadcrumb')
    <li class="breadcrumb-item" aria-current="page">
        <a href="{{ url('/dashboard') }}" class="breadcrumb-link">Dashboard / </a>
        <a href="{{ route('size-list') }}" class="breadcrumb-link">Size</a>
    </li>
@endsection

@section('content')
{{-- BEGIN:: Size Add --}}
<div class="add-size-content-wrapper">
    <form id="size-form" action="{{ url('dashboard/sizes/create') }}" method="POST" enctype="multipart/form-data">
        @csrf
        {{-- general information --}}
        <div class="general-info-wrapper">
            <p class="font-weight-bold">General Information</p>
            <hr>
            <div class="form-row">
                {{-- name --}}
                <div class="form-group col-md-4">
                    <label for="name">Size Name</label>
                    <input class="form-control" type="text" minlength="2" maxlength="20" name="name" id="name" required>
                    <small class="text-warning" data-toggle="tooltip" data-placement="right" title="name accept only alphanumeric and number" > [ Size Name ? ]</small>
                </div>
            </div>
            {{-- add & reset button --}}
            <div class="size-btn-wrapper form-row">
                <input type="submit" class="btn btn-sm btn-outline-success mr-2" value="Create Size">
                <button id="size-reset-btn" class="btn btn-sm btn-outline-danger cursor-pointer">Reset</button>
            </div>
        </div>
    </form>
</div>
{{-- END:: Size Add --}}
@endsection

{{-- custom script --}}
@section('script')
    <script src="{{ asset('js/dashboard/modules/size.js') }}"></script>
    <script>
        $(document).ready(function(){
            validAddnEditSize();
            
        })
    </script>    
@endsection
