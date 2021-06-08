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
        <div id="order-product-list-wrapper" class="order-product-list-wrapper d-none">
            {{-- Js Injections --}}
        </div>
        {{-- grand total --}}
        <div class="grand-total-wrapper d-none">
            <p>Total: $</p>
            <p id="total-text">0.00</p>
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
            <div id="payment-btn" class="payment-wrapper" data-toggle="modal" data-target="#payment-modal">
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
                    <div id="{{$i}}" class="num-pad-column" onclick="changePrVaQtn({{$i}})"> <p>{{$i}}</p> </div>
                @endfor
                <div id="qtn" class="num-pad-column" style="background-color: rgb(173, 226, 173); color: white;"> <p>Qtn</p> </div>
            </div>
            {{-- row --}}
            <div class="num-pad-row">
                @for ($i = 4; $i < 7; $i++)
                    <div id="{{$i}}" class="num-pad-column" onclick="changePrVaQtn({{$i}})"> <p>{{$i}}</p> </div>
                @endfor
                <div id="del" class="num-pad-column" onclick="changePrVaQtn('Del')"> <p>Del</p> </div>
            </div>
            {{-- row --}}
            <div class="num-pad-row">
                @for ($i = 7; $i < 10; $i++)
                    <div id="{{$i}}" class="num-pad-column" onclick="changePrVaQtn({{$i}})"> <p>{{$i}}</p> </div>
                @endfor
                    <div id="0" class="num-pad-column" onclick="changePrVaQtn(0)"> <p>0</p> </div>
            </div>            
        </div>
    </div>
</div>
{{-- END:: POS Order SideBar --}}

{{-- BEGIN::Payment Modal Popup --}}
<div id="payment-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="paymentModelLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {{-- modal header --}}
            <div class="modal-header">
                <h3 class="modal-title" id="productsModalLabel">Payment</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{-- modal body --}}
            <div class="modal-body payment-modal-body-container">
                {{-- payment options --}}
                <div class="payment-info-wrapper form-group">
                    {{-- heading block --}}
                    <div class="payment-header-wrapper">
                        <label class="col font-weight-bold" for="payment-options">Please Choose Payment Options:</label>
                        <div id="cash-payment" class="payment-option-btn form-control btn btn-sm btn-success cursor-pointer col-md-5">Cash Payment</div>
                        <div id="bank-payment" class="payment-option-btn form-control btn btn-sm btn-warning cursor-pointer col-md-5">Bank Payment</div>
                        <hr>
                    </div>
                    {{-- body block --}}
                    <div class="payment-body-wrapper">
                        <h4>Pay By: </h4>
                        <div class="payment-method-wrapper">
                            {{-- <p id="payment-option-text" class="mr-3 my-0 btn-sm btn-success">Cash Payment</p>
                            <p id="payment-made-text">0.00</p> --}}
                            <p id="payment-option-text" class="mr-3 my-0 btn-sm">---</p>
                            <p id="payment-made-text">0.00</p>

                        </div>
                    </div>
                </div>
                {{-- payment order info --}}
                <div class="payment-order-info-wrapper">
                    <div class="payment-order-info-total-wrapper">
                        <p class="font-weight-bold mr-2">Total: $</p>
                        <p id="payment-order-info-total-text" class="text-success">0.00</p>
                    </div>
                    <div class="payment-order-info-remain-wrapper">
                        <p class="font-weight-bold mr-2">Remaining: $</p>
                        <p id="payment-order-info-remain-text" class="text-danger">0.00</p>
                    </div>
                    <hr>
                    <div class="payment-order-info-change-wrapper">
                        <p class="font-weight-bold mr-2">Change: $</p>
                        <p id="payment-order-info-change-text" class="text-warning">0.00</p>
                    </div>
                </div>
                {{-- payment number pad --}}
                <div class="payment-number-pad-wrapper">
                    <div class="num-pad-block">
                        {{-- row --}}
                        <div class="num-pad-row">
                            @for ($i = 1; $i < 4; $i++)
                                <div id="{{$i}}" class="num-pad-column" onclick="madeChangePayment({{$i}})"> <p>{{$i}}</p> </div>
                            @endfor
                            <div id="+10" class="num-pad-column" onclick="madeChangePayment('+10')" style="background-color: rgb(173, 226, 173); color: white;"> <p>+10</p> </div>
                        </div>
                        {{-- row --}}
                        <div class="num-pad-row">
                            @for ($i = 4; $i < 7; $i++)
                                <div id="{{$i}}" class="num-pad-column" onclick="madeChangePayment({{$i}})"> <p>{{$i}}</p> </div>
                            @endfor
                            <div id="+20" class="num-pad-column" onclick="madeChangePayment('+20')" style="background-color: rgb(173, 226, 173); color: white;"> <p>+20</p> </div>
                        </div>
                        {{-- row --}}
                        <div class="num-pad-row">
                            @for ($i = 7; $i < 10; $i++)
                                <div id="{{$i}}" class="num-pad-column" onclick="madeChangePayment({{$i}})"> <p>{{$i}}</p> </div>
                            @endfor
                                <div id="+50" class="num-pad-column" onclick="madeChangePayment('+50')" style="background-color: rgb(173, 226, 173); color: white;"> <p>+50</p> </div>
                                <div class="num-pad-column"> <p></p> </div>
                                <div id="dot" class="num-pad-column" onclick="madeChangePayment('.')"> <p>.</p> </div>
                                <div id="0" class="num-pad-column" onclick="madeChangePayment('0')"> <p>0</p> </div>
                                <div id="del" class="num-pad-column" onclick="madeChangePayment('Del')"> <p>Del</p> </div>
                        </div>            
                    </div>            
                </div>                
            </div>
            {{-- modal footer where all buttons represent --}}
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger btn-sm modalCancelBtn" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
{{-- END::Payment Modal Popup --}}
