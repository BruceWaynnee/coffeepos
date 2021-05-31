@extends('dashboard.layout.app')

{{-- page title --}}
@section('dashboard_page_title', 'Type Edit')

{{-- custom stylesheet --}}
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/dashboard/modules/type.css') }}">
@endsection

{{-- breadcrumb links --}}
@section('dashboard_breadcrumb')
    <li class="breadcrumb-item" aria-current="page">
        <a href="{{ url('/dashboard') }}" class="breadcrumb-link">Dashboard / </a>
        <a href="{{ route('type-list') }}" class="breadcrumb-link">Type</a>
    </li>
@endsection

@section('content')
{{-- BEGIN:: Type Edit --}}
<div class="edit-type-content-wrapper">
    <form id="type-form" action="{{ route('type-update', ['id' => $type->id]) }}" method="POST" enctype="multipart/form-data">
        @method('patch')
        @csrf
        {{-- general information --}}
        <div class="general-info-wrapper">
            <p class="font-weight-bold">General Information</p>
            <hr>
            <div class="form-row">
                {{-- name --}}
                <div class="form-group col-md-4">
                    <label for="name">Type Name</label>
                    <input class="form-control" value="{{$type->name}}" type="text" minlength="2" maxlength="20" name="name" id="name" required>
                    <small class="text-warning" data-toggle="tooltip" data-placement="right" title="name accept only alphanumeric and number" > [ Type Name ? ]</small>
                </div>
            </div>
            {{-- update & cancel button --}}
            <div class="type-btn-wrapper form-row">
                <input type="submit" class="btn btn-sm btn-outline-success mr-2" value="Update Type">
                <a class="btn btn-sm btn-outline-danger" href="{{ route('type-list') }}">Cancel</a>
            </div>
        </div>
    </form>
</div>
{{-- END:: Type Edit --}}
@endsection

{{-- custom script --}}
@section('script')
    <script src="{{ asset('js/dashboard/modules/type.js') }}"></script>
    <script>
        $(document).ready(function(){
            validAddnEditType();
            
        })
    </script>    
@endsection
