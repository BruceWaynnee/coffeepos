@extends('pos.layout.app')

{{-- BEGIN:: Pos --}}
@section('content')
<div class="main-pos-container">
    {{-- pos order sidebar --}}
    @include('pos.partials.order_sidebar')

    {{-- pos content --}}
    <div class="pos-content-wrapper">
        {{-- category list --}}
        <div class="pos-category-wrapper">
            <ul class="category-ul">
                <li id="home" class="category-li" style="flex: none;">
                    <a>
                        <img src="{{ asset('img/pos/home.png') }}" alt="home icon">
                    </a>
                </li>
                @foreach ($categories as $category)
                    <li id="{{$category->id}}" class="category-li">
                        <a> {{ ucwords($category->name) }} </a> 
                    </li>
                @endforeach
            </ul>
        </div>
        {{-- product list --}}
        <div class="pos-product-wrapper">
            {{-- product card wrapper --}}
            @foreach ($products as $product)
                <div class="product-card-wrapper categoryId{{$product->category->id}}">
                    {{-- <div id="{{$product->id}}" class="card-item" data-toggle="modal" data-target="#products-modal"> --}}
                    <div id="{{$product->id}}" class="card-item" data-toggle="modal">
                        {{-- image --}}
                        <div class="product-card-image">
                            @if ($product->image != null)
                                <img src="{{ asset('storage/'.$product->image) }}" alt="product image">
                            @else
                                <img src="{{ asset('img/product/default-img.png') }}" alt="product image">
                            @endif
                        </div>
                        {{-- name --}}
                        <div class="product-card-name">
                            <p>{{ ucwords($product->name) }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{-- products modal popup table --}}
    <div id="products-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="productsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                {{-- modal header --}}
                <div class="modal-header">
                    <h5 class="modal-title" id="productsModalLabel">Choose Products To Create Quotation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{-- modal body --}}
                <div class="modal-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Variant Name</th>
                            <th scope="col">Type</th>
                            <th scope="col">Size</th>
                            <th scope="col">Price</th>
                          </tr>
                        </thead>
                        <tbody id="list-productvariants-body">
                            {{-- Js Injections --}}
                        </tbody>
                      </table>
                </div>
                {{-- modal footer where all buttons represent --}}
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger btn-sm modalCancelBtn" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
{{-- END:: Pos --}}

{{-- custom script --}}
@section('script')
    <script src="{{ asset('js/pos/index.js') }}"></script>
    <script>
        $(document).ready(function(){
            executePosIndexJs();

            $('.card-item').on('click', function(){
                ApiUrl = "{!! url('api') !!}";
                ApiToken = "{!! csrf_token() !!}";

                var productId = $(this).attr('id');
                mainUrl = ApiUrl + '/product/'+productId+'/productvariants/';

                // start ajax request
                $.ajax({
                    url: mainUrl,
                    type: 'GET',
                    data: { _token: ApiToken },
                    dataType: 'JSON',
                    error: function (data) {
                        alert('something went wrong, try refreshing the page.');
                    },
                    success: function (response) {
                        var responseResult = response;
                        generateProductVariantTableBody(responseResult.data);
                        $('#products-modal').modal('show');
                    }
                });
                
            });
            
        });

    </script>
@endsection
