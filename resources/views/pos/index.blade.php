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

            function generateProductVariantTableBody(productVariantObjects){
                // clean table rows
                $('#list-productvariants-body').empty();

                // filter create table body records
                productVariantObjects.filter(function(item){

                    // add productvariants into table list
                    var tbody = $('#list-productvariants-body');
    
                    // productvariant row
                    var tr = $("<tr></tr>")
                        .attr('price', item.price)
                        .attr('productVariantName', item.name)
                        .addClass('addVariant cursor-pointer');
    
                    // productvariant name
                    var td_productVariantName = $("<td style='vertical-align: middle;' ></td>")
                        .html(item.name)
                        .appendTo(tr);

                    // productvariant type
                    var td_productVariantType = $("<td style='vertical-align: middle;' ></td>")
                        .html(item.type.name)
                        .appendTo(tr);

                    // productvariant size
                    var td_productVariantType = $("<td style='vertical-align: middle;' ></td>")
                        .html(item.size.name)
                        .appendTo(tr);

                    // productvariant price
                    var td_productVariantName = $("<td style='vertical-align: middle;' ></td>")
                        .html(item.price)
                        .appendTo(tr);
                    
                    // bind everything into quotation product list
                    tbody.append(tr);

                });

                $('.addVariant').on('click', function(){
                    var currentRow = $(this);
                    var price = currentRow.attr('price');
                    var name = currentRow.attr('productVariantName');
                    
                    // remove order is empty sidebar message
                    $('.empty-cart-img-wrapper').addClass('d-none');

                    console.log(price +'<br>'+ name);
                    
                    var productVariantSideBarListWrapper = $('#order-product-list-wrapper');

                    var div_productVarRow = $('<div></div>')
                        .addClass('productvariant-row');

                        // name
                        var p_productVarName = $('<p></p>')
                            .html(name)
                            .appendTo(div_productVarRow);

                        // price
                        var p_productVarPrice = $('<p></p>')
                            .html(price +' $')
                            .appendTo(div_productVarRow);
                        
                        // quantity
                        var p_productVarPrice = $('<p></p>')
                            .html('Quantity: 1')
                            .appendTo(div_productVarRow);
                        
                    productVariantSideBarListWrapper.append(div_productVarRow);

                    $('#products-modal').modal('hide');

                });

            }

        });
    </script>
@endsection
