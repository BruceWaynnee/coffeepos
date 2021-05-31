@extends('dashboard.layout.app')

{{-- page title --}}
@section('dashboard_page_title', 'Category Edit')

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
{{-- BEGIN:: Category Edit --}}
<div class="edit-category-content-wrapper">
    <form id="category-form" action="{{ route('category-update', ['id' => $category->id]) }}" method="POST" enctype="multipart/form-data">
        @method('patch')
        @csrf
        {{-- general information --}}
        <div class="general-info-wrapper">
            <p class="font-weight-bold">General Information</p>
            <hr>
            <div class="form-row">
                {{-- name --}}
                <div class="form-group col-md-4">
                    <label for="name">Category Name</label>
                    <input class="form-control" value="{{$category->name}}" type="text" minlength="2" maxlength="20" name="name" id="name" required>
                    <small class="text-warning" data-toggle="tooltip" data-placement="right" title="name accept only alphanumeric, whitespace and '&' symbols only" > [ Category Name ? ]</small>
                </div>
            </div>
            {{-- update & cancel button --}}
            <div class="category-btn-wrapper form-row">
                <input type="submit" class="btn btn-sm btn-outline-success mr-2" value="Update">
                <a class="btn btn-sm btn-outline-danger" href="{{ route('category-list') }}">Cancel</a>
            </div>
        </div>
    </form>
</div>
{{-- END:: Category Edit --}}
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
