{{-- BEGIN:: POS Order SideBar --}}
<div class="order-sidebar-wrapper">
    {{-- order info screen --}}
    <div class="order-info-screen-wrapper">
        {{-- empty cart --}}
        <div class="empty-cart-img-wrapper">
            <img src="{{ asset('img/pos/cart.png') }}" alt="empty cart image">
            <p>Order Is Empty</p>
        </div>
        {{-- order product lists --}}
        <div class="order-product-list-wrapper">
            {{-- @for ($i = 0; $i < 10; $i++)
            <div class="product-wrapper">
                <p>product 1</p>
            </div>
            @endfor --}}
        </div>
    </div>
    {{-- order system options --}}
    <div class="order-system-options">
        {{-- action pad block --}}
        <div class="action-pad-block">
            {{-- customer  --}}
            <div class="customer-wrapper">
                {{-- icon --}}
                <div class="icon-wrapper">
                    <img src="{{ asset('img/pos/customer.png') }}" alt="customer icon">
                </div>
                {{-- name --}}
                <div class="name">
                    <p>Walk In Customer</p>
                </div>
            </div>
            {{-- payment --}}
            <div class="payment-wrapper">
                <div class="payment-button-wrapper">
                    <img src="{{ asset('img/pos/arrow.png') }}" alt="payment-btn-img">
                </div>
                <p>Payment</p>
            </div>
        </div>
        {{-- num pad block --}}
        <div class="num-pad-block">
            {{-- row --}}
            <div class="num-pad-row">
                @for ($i = 1; $i < 4; $i++)
                    <div id="{{$i}}" class="num-pad-column"> <p>{{$i}}</p> </div>
                @endfor
                <div id="qtn" class="num-pad-column" style="background-color: rgb(173, 226, 173); color: white;"> <p>Qtn</p> </div>
            </div>
            {{-- row --}}
            <div class="num-pad-row">
                @for ($i = 4; $i < 7; $i++)
                    <div id="{{$i}}" class="num-pad-column"> <p>{{$i}}</p> </div>
                @endfor
                <div id="del" class="num-pad-column"> <p>Del</p> </div>
            </div>
            {{-- row --}}
            <div class="num-pad-row">
                @for ($i = 7; $i < 10; $i++)
                    <div id="{{$i}}" class="num-pad-column"> <p>{{$i}}</p> </div>
                @endfor
                    <div id="0" class="num-pad-column"> <p>0</p> </div>
            </div>            
        </div>
    </div>
</div>
{{-- END:: POS Order SideBar --}}
