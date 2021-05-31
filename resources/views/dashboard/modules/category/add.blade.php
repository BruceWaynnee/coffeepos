@extends('dashboard.layout.app')

{{-- page title --}}
@section('dashboard_page_title', 'Category Add')

{{-- custom stylesheet --}}
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/dashboard/modules/category.css') }}">
@endsection

{{-- breadcrumb links --}}
@section('dashboard_breadcrumb')
    <li class="breadcrumb-item" aria-current="page">
        <a href="{{ url('/dashboard') }}" class="breadcrumb-link">Dashboard / </a>
        <a href="{{ route('category-list') }}" class="breadcrumb-link">Category</a>
    </li>
@endsection

@section('content')
{{-- BEGIN:: Category Add --}}
<div class="add-category-content-wrapper">
    <form id="category-form" action="{{ url('dashboard/categories/create') }}" method="POST" enctype="multipart/form-data">
        @csrf
        {{-- general information --}}
        <div class="general-info-wrapper">
            <p class="font-weight-bold">General Information</p>
            <hr>
            <div class="form-row">
                {{-- name --}}
                <div class="form-group col-md-4">
                    <label for="name">Category Name</label>
                    <input class="form-control" type="text" minlength="2" maxlength="20" name="name" id="name" required>
                    <small class="text-warning" data-toggle="tooltip" data-placement="right" title="name accept only alphanumeric, whitespace and '&' symbols only" > [ Category Name ? ]</small>
                </div>
            </div>
            {{-- add & reset button --}}
            <div class="category-btn-wrapper form-row">
                <input type="submit" class="btn btn-sm btn-outline-success mr-2" value="Create Category">
                <button id="category-reset-btn" class="btn btn-sm btn-outline-danger cursor-pointer">Reset</button>
            </div>
        </div>
    </form>
</div>
{{-- END:: Category Add --}}
@endsection

{{-- custom script --}}
@section('script')
    <script src="{{ asset('js/dashboard/modules/category.js') }}"></script>
    <script>
        $(document).ready(function(){
            validAddnEditCategory();
            
        })
    </script>    
@endsection
