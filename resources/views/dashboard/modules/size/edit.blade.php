@extends('dashboard.layout.app')

{{-- page title --}}
@section('dashboard_page_title', 'Size Edit')

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
{{-- BEGIN:: Size Edit --}}
<div class="edit-size-content-wrapper">
    <form id="size-form" action="{{ route('size-update', ['id' => $size->id]) }}" method="POST" enctype="multipart/form-data">
        @method('patch')
        @csrf
        {{-- general information --}}
        <div class="general-info-wrapper">
            <p class="font-weight-bold">General Information</p>
            <hr>
            <div class="form-row">
                {{-- name --}}
                <div class="form-group col-md-4">
                    <label for="name">Size Name</label>
                    <input class="form-control" value="{{$size->name}}" type="text" minlength="2" maxlength="20" name="name" id="name" required>
                    <small class="text-warning" data-toggle="tooltip" data-placement="right" title="name accept only alphanumeric and number" > [ Size Name ? ]</small>
                </div>
            </div>
            {{-- update & cancel button --}}
            <div class="size-btn-wrapper form-row">
                <input type="submit" class="btn btn-sm btn-outline-success mr-2" value="Update Size">
                <a class="btn btn-sm btn-outline-danger" href="{{ route('size-list') }}">Cancel</a>
            </div>
        </div>
    </form>
</div>
{{-- END:: Size Edit --}}
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
