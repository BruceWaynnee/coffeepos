@extends('dashboard.layout.app')

{{-- page title --}}
@section('dashboard_page_title', 'Category List')

{{-- custom stylesheet --}}
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/dashboard/modules/category.css') }}">
@endsection

{{-- breadcrumb links --}}
@section('dashboard_breadcrumb')
    <li class="breadcrumb-item" aria-current="page">
        <a href="{{ url('/dashboard') }}" class="breadcrumb-link">Dashboard</a>
    </li>
@endsection

@section('content')
{{-- BEGIN:: Category --}}
<div class="category-content-wrapper">
    <table class="table category-table-listing-wrapper">
        {{-- table head --}}
        <thead>
            <tr>
                <th>Category N°</th>
                <th>Category Name</th>
                <th>Date Creation</th>
                <th>Action</th>
            </tr>
        </thead>
        {{-- table body --}}
        <tbody>
            @foreach ($categories as $key => $category)                        
            <tr>
                <td>{{$key+1}}</td>
                <td>{{ ucwords($category->name) }}</td>
                <td>{{$category->created_at}}</td>
                {{-- action dropdown menu --}}
                <td>
                    <img type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src="{{ asset('img/dashboard/logo/action.png') }}" alt="action icon">
                    {{-- dropdown items --}}
                    <div class="dropdown-menu dropdown-menu-left">
                        {{-- edit --}}
                        @can('edit category')
                        <div class="action-edit-wrapper">
                            <a class="dropdown-item" href="{{url("dashboard/categories/$category->id/edit")}}">Edit</a>
                        </div>
                        @endcan
                        {{-- delete --}}
                        @can('delete category')
                        <div class="action-delete-wrapper">
                            <form action="{{ route('category-delete', ['id' => $category->id]) }}" method="POST">
                                @method('delete')
                                @csrf
                                <button class="category-delete-btn dropdown-item">
                                    Delete
                                </button>
                            </form>
                        </div>
                        @endcan
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{-- create new category --}}
    @can('create category')
    <div class="create-category-link-wrapper">
        <a href="{{ route('category-add') }}" class="btn btn-sm btn-outline-success">
            Add New Category
        </a>
    </div>
    @endcan
</div>
{{-- END:: Category --}}
@endsection

{{-- custom script --}}
@section('script')
    <script src="{{ asset('js/dashboard/modules/category.js') }}"></script>
    <script>
        $(document).ready(function(){
            validListCategory();
        });
    </script>    
@endsection
