@extends('dashboard.layout.app')

{{-- page title --}}
@section('dashboard_page_title')
    Edit Product Variant Of [ {{ ucwords($product->name) }} ] 
@endsection

{{-- custom stylesheet --}}
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/dashboard/modules/product_variant.css') }}">
@endsection

{{-- breadcrumb links --}}
@section('dashboard_breadcrumb')
    <li class="breadcrumb-item" aria-current="page">
        <a href="{{ url('/dashboard') }}" class="breadcrumb-link">Dashboard / </a>
    </li>
@endsection

@section('content')
{{-- BEGIN:: Product Variant Edit --}}
<div class="edit-product-variant-content-wrapper">
    <form id="product-variant-form" action="{{ route('productvariant-update', ['productId' => $product->id]) }}" method="POST" enctype="multipart/form-data">
        @method('patch')
        @csrf
        {{-- general information --}}
        <div class="general-info-wrapper">
            <p class="font-weight-bold">General Information</p>
            <hr>
            {{-- product name --}}
            <div class="form-row">
                {{-- name --}}
                <div class="form-group col-md-4">
                    <label for="name">From Product</label>
                    <input class="form-control" value="{{ ucwords($product->name) }}" type="text" minlength="2" maxlength="20" name="name" id="name" disabled>
                </div>
            </div>
            {{-- product variant name --}}
            <div class="form-row">
                {{-- product variant name --}}
                <div class="form-group col-md-4">
                    <label for="pv-name">Product Variant Name (preview)</label>
                    <small id="pv-name" class="form-control text-success">
                        <span id="pv-product-name">-</span>
                        <span id="pv-type-name">-</span>
                        <span id="pv-size-name">-</span>
                    </small>
                </div>
            </div>
            {{-- type --}}
            <div class="form-row">
                {{-- type --}}
                <div class="form-group col-md-4">
                    <label for="type">Type</label>
                    <select class="custom-select" name="type" id="type">
                        <option selected hidden value=''>Choose Type</option>
                        @foreach ($types as $type)
                            <option value="{{$type->id}}">{{ ucwords($type->name) }}</option>
                        @endforeach
                    </select>
                </div>                
            </div>
            {{-- size and price --}}
            <div class="form-row">
                {{-- size --}}
                <div class="form-group col-md-4">
                    <label for="size">Size</label>
                    <select class="custom-select" name="size" id="size">
                        <option selected hidden value=''>Choose Size</option>
                        @foreach ($sizes as $size)
                            <option value="{{$size->id}}">{{ ucwords($size->name) }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- price --}}
                <div class="form-group col-md-4">
                    <label for="price">Price ($)</label>
                    <input type="number" class="form-control" min="0.00" step="0.01" name="price" id="price">
                </div>                
            </div>
            {{-- description --}}
            <div class="form-row">
                {{-- description --}}
                <div class="form-group col-md-8">
                    <label for="description">Product Description</label>
                    <textarea class="form-control" name="description" id="description" cols="30" rows="5" disabled>{{$product->description}}</textarea>
                </div>
            </div>
            {{-- add to table button --}}
            <div class="form-row my-2">
                <div class="form-group col-md-8 text-right">
                    <input id="add-variant-btn" type="button" class="btn btn-sm btn-outline-success mr-2" value="Add Variant">
                </div>
            </div>            
            <hr>
            {{-- product variant table --}}
            <div class="form-row">
                <div class="form-group col-md-12">
                    <input type="hidden" id="json-productvariants" value="{{$productVariants}}">
                    <input type="hidden" id="edit" value="yes">
                    <label for="list-product-variant-thead" style="font-size: 20px;">List Of Product Variants</label>
                    <table id="list-product-variant-thead" class="table product-variant-table-listing-wrapper">
                        {{-- table head --}}
                        <thead>
                            <tr>
                                <th>Product Variant Name</th>
                                <th>Type</th>
                                <th>Size</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="list-product-variant-tbody">
                            {{-- Js Injections --}}
                        </tbody>
                    </table>  
                </div>
            </div>
            {{-- add --}}
            <div class="product-btn-wrapper form-row">
                <input type="submit" class="btn btn-sm btn-outline-success mr-2" value="Update Product Variant">
            </div>
        </div>
    </form>
</div>
{{-- END:: Product Variant Edit --}}
@endsection

{{-- custom script --}}
@section('script')
    <script src="{{ asset('js/dashboard/modules/product_variant.js') }}"></script>
    <script>
        $(document).ready(function(){
            validAddnEditProductVariant('edit');
        })
    </script>    
@endsection
