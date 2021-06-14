@extends('dashboard.layout.app')

{{-- page title --}}
@section('dashboard_page_title')
    {{ ucwords($category->name) }} Product
@endsection

{{-- custom stylesheet --}}
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/dashboard/modules/product.css') }}">
@endsection

{{-- breadcrumb links --}}
@section('dashboard_breadcrumb')
    <li class="breadcrumb-item" aria-current="page">
        <a href="{{ url('/dashboard') }}" class="breadcrumb-link">Dashboard</a>
    </li>
@endsection

@section('content')
{{-- BEGIN:: Product --}}
<div class="product-content-wrapper">
    <table class="table product-table-listing-wrapper">
        {{-- table head --}}
        <thead>
            <tr>
                <th>Product N°</th>
                <th>Product Name</th>
                <th>Description</th>
                <th>Date Creation</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        {{-- table body --}}
        <tbody>
            @foreach ($products as $key => $product)                        
            <tr>
                <td>{{$key+1}}</td>
                <td>{{ ucwords($product->name) }}</td>
                <td>{{ ucwords($product->description) }}</td>
                <td>{{$product->created_at}}</td>
                <td> {{-- image --}}
                    @if ($product->image != null)
                        <img style="width: 80px; max-height: 130px;" src="{{ asset('storage/'.$product->image) }}" alt="product image">
                    @else
                        <img style="width: 80px; max-height: 130px;" src="{{ asset('img/product/default-img.png') }}" alt="product image">
                    @endif 
                </td>
                <td> {{-- action dropdown menu --}}
                    <img type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src="{{ asset('img/dashboard/logo/action.png') }}" alt="action icon">
                    {{-- dropdown items --}}
                    <div class="dropdown-menu dropdown-menu-left">
                        {{-- edit --}}
                        @can('edit product')
                        <div class="action-edit-wrapper">
                            <a class="dropdown-item" href="{{url("dashboard/products/$product->id/edit")}}">Edit</a>
                        </div>
                        @endcan
                        {{-- delete --}}
                        @can('delete product')
                        <div class="action-delete-wrapper">
                            <form action="{{ route('product-delete', ['id' => $product->id]) }}" method="POST">
                                @method('delete')
                                @csrf
                                <button class="product-delete-btn dropdown-item">
                                    Delete
                                </button>
                            </form>
                        </div>
                        @endcan
                        @can('view product-variant')
                        {{-- product variants --}}
                        <div class="action-edit-wrapper">
                            <a class="dropdown-item" href="{{ route('product-productvariants-list', ['productId' => $product->id]) }}">View Variants</a>
                        </div>
                        @endcan                    
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination-link-wrapper d-flex justify-content-center">
        {{ $products->links() }}
    </div>
    {{-- create new product --}}
    @can('create product')
    <div class="create-product-link-wrapper">
        <a href="{{ route('product-add') }}" class="btn btn-sm btn-outline-success">
            Add New Product
        </a>
    </div>
    @endcan
</div>
{{-- END:: Product --}}
@endsection

{{-- custom script --}}
@section('script')
    <script src="{{ asset('js/dashboard/modules/product.js') }}"></script>
    <script>
        $(document).ready(function(){
            validListProduct();
        });
    </script>    
@endsection
