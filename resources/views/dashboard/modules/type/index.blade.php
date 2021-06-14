@extends('dashboard.layout.app')

{{-- page title --}}
@section('dashboard_page_title', 'Type List')

{{-- custom stylesheet --}}
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/dashboard/modules/type.css') }}">
@endsection

{{-- breadcrumb links --}}
@section('dashboard_breadcrumb')
    <li class="breadcrumb-item" aria-current="page">
        <a href="{{ url('/dashboard') }}" class="breadcrumb-link">Dashboard</a>
    </li>
@endsection

@section('content')
{{-- BEGIN:: Type --}}
<div class="type-content-wrapper">
    <table class="table type-table-listing-wrapper">
        {{-- table head --}}
        <thead>
            <tr>
                <th>Type N°</th>
                <th>Type Name</th>
                <th>Date Creation</th>
                <th>Action</th>
            </tr>
        </thead>
        {{-- table body --}}
        <tbody>
            @foreach ($types as $key => $type)                        
            <tr>
                <td>{{$key+1}}</td>
                <td>{{ ucwords($type->name) }}</td>
                <td>{{$type->created_at}}</td>
                {{-- action dropdown menu --}}
                <td>
                    <img type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src="{{ asset('img/dashboard/logo/action.png') }}" alt="action icon">
                    {{-- dropdown items --}}
                    <div class="dropdown-menu dropdown-menu-left">
                        {{-- edit --}}
                        @can('edit product-type')
                        <div class="action-edit-wrapper">
                            <a class="dropdown-item" href="{{url("dashboard/types/$type->id/edit")}}">Edit</a>
                        </div>
                        @endcan                    
                        {{-- delete --}}
                        @can('delete product-type')
                        <div class="action-delete-wrapper">
                            <form action="{{ route('type-delete', ['id' => $type->id]) }}" method="POST">
                                @method('delete')
                                @csrf
                                <button class="type-delete-btn dropdown-item">
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
    {{-- create new type --}}
    @can('create product-type')
    <div class="create-type-link-wrapper">
        <a href="{{ route('type-add') }}" class="btn btn-sm btn-outline-success">
            Add New Type
        </a>
    </div>
    @endcan
</div>
{{-- END:: Type --}}
@endsection

{{-- custom script --}}
@section('script')
    <script src="{{ asset('js/dashboard/modules/type.js') }}"></script>
    <script>
        $(document).ready(function(){
            validListType();
        });
    </script>    
@endsection
