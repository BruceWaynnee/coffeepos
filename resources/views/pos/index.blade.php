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

            $('#payment-btn').on('click', function(){
                // replace sub total into payment popup
                var grandTotal = parseFloat( $('#total-text').text() ).toFixed(2);
                $('#payment-order-info-total-text').text(grandTotal);

                // get selected payment option and add into payment body block
                choosePaymentOptions();

            });
 
        });

        /**
         * On payment option button selected add into paymen body block.
         * @return void 
         */
        function choosePaymentOptions(){
            $('.payment-option-btn').on('click', function(){
                var paymentOption = $(this).attr('id');

                // payment option body texts
                var paymentBodyText     = $('#payment-option-text');
                var paymentBodyMadeText = $('#payment-made-text');

                // validate option value
                switch (paymentOption) {
                    case 'cash-payment':
                            paymentBodyText.removeClass('btn-warning');
                            paymentBodyText.addClass('btn-success');
                            paymentBodyText.text('Cash Payment')
                        break;
                    case 'bank-payment':
                            paymentBodyText.removeClass('btn-success');
                            paymentBodyText.addClass('btn-warning');
                            paymentBodyText.text('Bank Payment')
                        break;
                    default:
                        break;
                }
                
            });

        }

        /**
         * On payment number pad selected made a payment based on sub 
         * total of order product variant list. 
         * @param [String] numberPadValue
         * @return void
         */
         function madeChangePayment(numberPadValue){
            // set payment option to cash payment by default if not selected
            var paymentBodyText = $('#payment-option-text');
            if(paymentBodyText.text() == '---'){
                paymentBodyText.addClass('btn-success');
                paymentBodyText.text('Cash Payment')
            }

            // current payment to made total
            var currentMadeTotal = $('#payment-made-text').text();
            var indexAfterDot = currentMadeTotal.indexOf('.');

            // get sub total value
            var subTotal = parseFloat( $('#total-text').text() );

            // payment number pad value
            var paymentNumberPadValue = numberPadValue;
            switch (paymentNumberPadValue) {
                case '+10':
                    // update current total input
                    var paymentNumberPadValue = 10;
                    var newMadeTotal = ( parseFloat(currentMadeTotal) + paymentNumberPadValue );

                    currentInputTotalDigits = ( parseFloat(newMadeTotal).toString() ).split('.')[0];
                    // allow only 7 digits input
                    calculatePaymentRemainNChange(currentInputTotalDigits, subTotal);

                    break;
                case '+20':
                        // update current total input
                        var paymentNumberPadValue = 20;
                        var newMadeTotal = ( parseFloat(currentMadeTotal) + paymentNumberPadValue );

                        currentInputTotalDigits = ( parseFloat(newMadeTotal).toString() ).split('.')[0];
                        // allow only 7 digits input
                        calculatePaymentRemainNChange(currentInputTotalDigits, subTotal);

                    break;
                case '+50':
                    // update current total input
                    var paymentNumberPadValue = 50;
                    var newMadeTotal = ( parseFloat(currentMadeTotal) + paymentNumberPadValue );

                    currentInputTotalDigits = ( parseFloat(newMadeTotal).toString() ).split('.')[0];
                    // allow only 7 digits input
                    calculatePaymentRemainNChange(currentInputTotalDigits, subTotal);

                    break;
                case '.':
                    var dotPad = $('#dot');
                    var isActive = dotPad.hasClass('active-payment-dot');

                    // active or de-active dot
                    if(isActive) {
                        dotPad.removeClass('active-payment-dot');
                    } else {
                        dotPad.addClass('active-payment-dot');
                    }

                    break;
                case 'Del':
                    currentMadeTotal = parseFloat(currentMadeTotal);
                    currentMadeTotal = currentMadeTotal.toString();

                    if( currentMadeTotal.indexOf('.') >= 0 ){
                        var currentMadeTotalBeforeDecimalValue = currentMadeTotal.split('.')[0];
                        var currentMadeTotalAfterDecimalValue = currentMadeTotal.split('.')[1];

                        currentMadeTotalAfterDecimalValue = parseInt( parseInt(currentMadeTotalAfterDecimalValue)/10 );
                        var newMadeTotal = currentMadeTotalBeforeDecimalValue + '.' + currentMadeTotalAfterDecimalValue;

                    } else {
                        console.log(currentMadeTotal.length);

                        if(currentMadeTotal.length != 1){
                            newMadeTotal = currentMadeTotal.slice(0,-1);
                        } else if(currentMadeTotal.length == 1) {
                            newMadeTotal = '0';
                        }

                    }

                    calculatePaymentRemainNChange(newMadeTotal, subTotal);

                    break;
                default:
                    // update current total input
                    currentMadeTotal = currentMadeTotal.split('');
                    currentMadeTotal.splice(indexAfterDot, 0, paymentNumberPadValue);
                    var newMadeTotal = currentMadeTotal.join('');

                    // allow only 7 digits input
                    calculatePaymentRemainNChange(newMadeTotal, subTotal);

                    break;
            }

        }

        /**
         * Check limit digit total payment value, calculate to find remainning total payment,
         * change payment and update into the payment modal popup.
         * @param [String] newMadeTotal
         * @param [String] subTotal
         * @return void
         */
        function calculatePaymentRemainNChange(newMadeTotal, subTotal){
            // allow only 7 digits input
            currentInputTotalDigits = newMadeTotal.split('.')[0];
            if(currentInputTotalDigits.length > 7){
                alert('Payment digits reach limit!');

            } else {
                $('#payment-made-text').text( parseFloat(newMadeTotal).toFixed(2) );

                // find remain total and update the value
                var reaminTotal = parseFloat( newMadeTotal - subTotal );
                if( reaminTotal < 0 ){ // if payment due (remain)
                    var paymentChangeText = $('#payment-order-info-change-text').text('0.00');
                    var paymentRemainText = $('#payment-order-info-remain-text').text( parseFloat( Math.abs(reaminTotal) ).toFixed(2) );

                } else {               // if paid and change back
                    var paymentRemainText = $('#payment-order-info-remain-text').text('0.00');
                    var paymentChangeText = $('#payment-order-info-change-text').text( parseFloat(reaminTotal).toFixed(2) );

                }

            }

        }

    </script>
@endsection
