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
                    <div class="card-item">
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
</div>
@endsection
{{-- END:: Pos --}}

{{-- custom script --}}
@section('script')
    <script src="{{ asset('js/pos/index.js') }}"></script>
    <script>
        $(document).ready(function(){

            $('.category-li').on('click', function(){
                var categoryId = $(this).attr('id');

                if(categoryId != 'home'){
                    $('.product-card-wrapper').addClass('d-none');
                    var test = $('.categoryId'+categoryId).removeClass('d-none');
                } else {
                    $('.product-card-wrapper').removeClass('d-none');
                }

            });

        });
    </script>
@endsection
