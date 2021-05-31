@extends('dashboard.layout.app')

{{-- page title --}}
@section('dashboard_page_title')
    {{ ucwords($product->name) }} Variants
@endsection

{{-- custom stylesheet --}}
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/dashboard/modules/product_variant.css') }}">
@endsection

{{-- breadcrumb links --}}
@section('dashboard_breadcrumb')
    <li class="breadcrumb-item" aria-current="page">
        <a href="{{ url('/dashboard') }}" class="breadcrumb-link">Dashboard</a>
    </li>
@endsection

@section('content')
{{-- BEGIN:: Product Variant --}}
<div class="product-variant-content-wrapper">
    <table class="table product-variant-table-listing-wrapper">
        {{-- table head --}}
        <thead>
            <tr>
                <th>#Id</th>
                <th>From Category</th>
                <th>Product Varaint Name</th>
                <th>Type</th>
                <th>Size</th>
                <th>Price</th>
                <th>Date Creation</th>
                <th>Action</th>
            </tr>
        </thead>
        {{-- table body --}}
        <tbody>
            @foreach ($productVariants as $key => $productVariant)                        
            <tr>
                <td>{{$key+1}}</td>
                <td>{{ ucwords($category->name) }}</td>
                <td>{{ ucwords($productVariant->name) }}</td>
                <td>{{ ucwords($productVariant->type->name) }}</td>
                <td>{{ ucwords($productVariant->size->name) }}</td>
                <td>$ {{ ucwords($productVariant->price) }}</td>
                <td>{{$productVariant->created_at}}</td>
                {{-- action dropdown menu --}}
                <td>
                    <img type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src="{{ asset('img/dashboard/logo/action.png') }}" alt="action icon">
                    {{-- dropdown items --}}
                    <div class="dropdown-menu dropdown-menu-left">
                        {{-- edit --}}
                        <div class="action-edit-wrapper">
                            <a class="dropdown-item" href="{{url("dashboard/products/$product->id/edit")}}">Edit</a>
                        </div>
                        {{-- delete --}}
                        <div class="action-delete-wrapper">
                            <form action="{{ route('category-delete', ['id' => $category->id]) }}" method="POST">
                                @method('delete')
                                @csrf
                                <button class="category-delete-btn dropdown-item">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination-link-wrapper d-flex justify-content-center">
        {{ $productVariants->links() }}
    </div>
    {{-- create new product variant & back to list--}}
    <div class="create-product-variant-link-wrapper">
        <a href="{{ route('productvariant-add', ['productId' => $product->id]) }}" class="btn btn-sm btn-outline-success">
            Add New Variant
        </a>
        <a class="btn btn-sm btn-outline-danger" href="{{ route('category-products-list', ['categoryId' => $product->category->id]) }}">Back To List</a>
    </div>
</div>
{{-- END:: Product Variant --}}
@endsection

{{-- custom script --}}
@section('script')
    <script src="{{ asset('js/dashboard/modules/product_variant.js') }}"></script>
    <script>
        $(document).ready(function(){
            validListProductVariant();
        });
    </script>    
@endsection
