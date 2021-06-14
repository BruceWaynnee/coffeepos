@extends('dashboard.layout.app')

{{-- page title --}}
@section('dashboard_page_title', 'Size List')

{{-- custom stylesheet --}}
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/dashboard/modules/size.css') }}">
@endsection

{{-- breadcrumb links --}}
@section('dashboard_breadcrumb')
    <li class="breadcrumb-item" aria-current="page">
        <a href="{{ url('/dashboard') }}" class="breadcrumb-link">Dashboard</a>
    </li>
@endsection

@section('content')
{{-- BEGIN:: Size --}}
<div class="size-content-wrapper">
    <table class="table size-table-listing-wrapper">
        {{-- table head --}}
        <thead>
            <tr>
                <th>Size N°</th>
                <th>Size Name</th>
                <th>Date Creation</th>
                <th>Action</th>
            </tr>
        </thead>
        {{-- table body --}}
        <tbody>
            @foreach ($sizes as $key => $size)                        
            <tr>
                <td>{{$key+1}}</td>
                <td>{{ ucwords($size->name) }}</td>
                <td>{{$size->created_at}}</td>
                {{-- action dropdown menu --}}
                <td>
                    <img type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src="{{ asset('img/dashboard/logo/action.png') }}" alt="action icon">
                    {{-- dropdown items --}}
                    <div class="dropdown-menu dropdown-menu-left">
                        {{-- edit --}}
                        @can('edit product-size')
                        <div class="action-edit-wrapper">
                            <a class="dropdown-item" href="{{url("dashboard/sizes/$size->id/edit")}}">Edit</a>
                        </div>
                        @endcan                    
                        {{-- delete --}}
                        @can('delete product-size')
                        <div class="action-delete-wrapper">
                            <form action="{{ route('size-delete', ['id' => $size->id]) }}" method="POST">
                                @method('delete')
                                @csrf
                                <button class="size-delete-btn dropdown-item">
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
    {{-- create new size --}}
    @can('create product-size')
    <div class="create-size-link-wrapper">
        <a href="{{ route('size-add') }}" class="btn btn-sm btn-outline-success">
            Add New Size
        </a>
    </div>
    @endcan
</div>
{{-- END:: Size --}}
@endsection

{{-- custom script --}}
@section('script')
    <script src="{{ asset('js/dashboard/modules/size.js') }}"></script>
    <script>
        $(document).ready(function(){
            validListSize();
        });
    </script>    
@endsection
