/**
 * Auto call all functions
 * @return void
 */
function executePosIndexJs(){
    onCategoryClickedShowProducts();

}

/**
 * On category clicked show products on list.
 * @return void
 */
function onCategoryClickedShowProducts(){
    $('.category-li').on('click', function(){
        var categoryId = $(this).attr('id');

        if(categoryId != 'home'){
            $('.product-card-wrapper').addClass('d-none');
            var test = $('.categoryId'+categoryId).removeClass('d-none');
        } else {
            $('.product-card-wrapper').removeClass('d-none');
        }

    });
}

/**
 * Generate product variant table body on modual popup content.
 * @param [Object] productVariantObjects
 * @return void
 */
 function generateProductVariantTableBody(productVariantObjects){
    // clean table rows
    $('#list-productvariants-body').empty();

    // filter create table body records
    productVariantObjects.filter(function(item){

        // add productvariants into table list
        var tbody = $('#list-productvariants-body');

        // productvariant row
        var tr = $("<tr></tr>")
            .attr('id', item.id)
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

    onVariantSelectAddToSideBar();
}

/**
 * Add selected product variant from modal popup into pos product variant 
 * list sidebar.
 * @return void
 */
function onVariantSelectAddToSideBar(){
    $('.addVariant').on('click', function(){
        var currentRow = $(this);
        var pvId  = currentRow.attr('id');
        var price = currentRow.attr('price');
        var name  = currentRow.attr('productVariantName');
        
        // disable order is empty sidebar view
        $('.empty-cart-img-wrapper').addClass('d-none');
        // enable product order list view
        $('.order-product-list-wrapper').removeClass('d-none');
        $('.grand-total-wrapper').removeClass('d-none');


        // check duplicate product variant items
        var isDuplicate = false;
        $('.productvariant-row').each(function(index, object){
            if(object.id == pvId){
                // increase product variant item quantity by one
                var priceTagId = '#'+pvId+'-price-text';
                var oldQtn = parseInt( $(priceTagId).text() );
                
                // change quantity text
                $(priceTagId).text(oldQtn+=1);

                // modified total price
                changeTotalPriceText( $(object).attr('price') );

                isDuplicate = true;
                return false;
            }
        });

        if(!isDuplicate){
            generateSidebarProductVariantItem(pvId, name, price);
        }
        
        $('#products-modal').modal('hide');

        onSideBarProductVariantRowClickActive();

    });    
}

/**
 * Generate product variant item into pos sidebar.
 * @param [String] name 
 * @param [String] price
 * @return void
 */
function generateSidebarProductVariantItem(pvId, name, price){
    // generate productvariant item list
    var productVariantSideBarListWrapper = $('#order-product-list-wrapper');

    var div_productVarRow = $('<div></div>')
        .attr('id', pvId)
        .attr('price', price)
        .addClass('productvariant-row cursor-pointer');

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
            .html('Quantity: ');
            var p_productVarPriceSmall = $('<small id="'+pvId+'-price-text" style="font-size: 14px;"></small>')
                .html(1)
                .appendTo(p_productVarPrice);
        div_productVarRow.append(p_productVarPrice);
        
    productVariantSideBarListWrapper.append(div_productVarRow);

    // replace total price
    changeTotalPriceText(price);
}

/**
 * Modified product variant total price.
 * @param [Integer] price
 * @return void
 */
function changeTotalPriceText(price){
    var p_totalText = $('#total-text');
    var newPrice = parseFloat(price);
    var currentTotalPrice = parseFloat( p_totalText.text() );

    var newTotalPrice = parseFloat(currentTotalPrice + newPrice).toFixed(2);
    
    p_totalText.text(newTotalPrice);
}

/**
 * Activated selected product variant item on pos sidebar.
 * @return void
 */
function onSideBarProductVariantRowClickActive(){
    // on productvariant row click active current row
    $('.productvariant-row').on('click', function(){
        var currentRow = $(this);

        // remove previous active row and apply corruent
        $('.productvariant-row').removeClass('productvariant-row-active');
        currentRow.addClass('productvariant-row-active');
        // console.log(currentRow.attr('price'));
    });    
}

/**
 * Modified product variants order quantity and total based on 
 * selected number pad.
 * @param [String] numberPadValue
 * @return void
 */
function changePrVaQtn(numberPadValue){
    var activeProductVariantItem = $('.productvariant-row-active')[0];
    
    // modified total only if row selected (row activated)
    if(activeProductVariantItem){
        var itemId = $(activeProductVariantItem).attr('id');
        var itemPrice = $(activeProductVariantItem).attr('price');

        var currentItemQtn = $('#'+itemId+'-price-text').text();
        var currentActiveUnitTotalPrice = parseFloat(currentItemQtn*itemPrice).toFixed(2);

        if(numberPadValue != 'Del'){
            var newItemQtn = parseInt(currentItemQtn + numberPadValue);
            // get current total price based on current quantity plus new number pad value
            var currentUnitTotalPrice = parseFloat(itemPrice*newItemQtn);
            
            var p_totalText = $('#total-text');
            var sidebarTotalValue = parseFloat( p_totalText.text() );
            var oldPvTotal = parseFloat(sidebarTotalValue-currentActiveUnitTotalPrice);
    
            var newPvTotal = parseFloat(oldPvTotal + currentUnitTotalPrice).toFixed(2);

        } else {
            // delete last quantity digit of selected product variant list
            if(currentItemQtn.length != 1){
                newItemQtn = currentItemQtn.slice(0,-1);
            } else if(currentItemQtn.length == 1) {
                newItemQtn = 0;
            }
            
            // delte row
            if (currentItemQtn == '0') {
                activeProductVariantItem.remove();
            }

            var p_totalText = $('#total-text');
            var sidebarTotalValue = parseFloat( p_totalText.text() );
            var oldPvTotal = parseFloat(sidebarTotalValue-currentActiveUnitTotalPrice);

            var currentUnitTotalPrice = (itemPrice*newItemQtn);
            var newPvTotal = parseFloat(oldPvTotal + currentUnitTotalPrice).toFixed(2);
            
        }

        // change quantity text value
        $('#'+itemId+'-price-text').text(newItemQtn);

        // set new total price
        $('#total-text').text(newPvTotal);
    }

}

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

                if(currentMadeTotal.length != 1){
                    newMadeTotal = currentMadeTotal.slice(0,-1);
                } else if(currentMadeTotal.length == 1) {
                    newMadeTotal = '0';
                }

            }

            calculatePaymentRemainNChange(newMadeTotal, subTotal);

            break;
        default:
            var isActive = $('#dot').hasClass('active-payment-dot');
            
            // check active deciaml pad
            if(isActive) {   // update current total input, after the dot
                currentMadeTotal = parseFloat(currentMadeTotal);
                currentMadeTotal = currentMadeTotal.toString();

                if( currentMadeTotal.indexOf('.') == -1 ) {
                    console.log('add without check digit');
                    var newMadeTotal = (currentMadeTotal + '.' + paymentNumberPadValue);
                    calculatePaymentRemainNChange(newMadeTotal, subTotal);
                    
                } else {
                    var currentMadeTotalBeforeDecimalValue = currentMadeTotal.split('.')[0];
                    var currentMadeTotalAfterDecimalValue = currentMadeTotal.split('.')[1];

                    if(currentMadeTotalAfterDecimalValue.length < 2) {
                        currentMadeTotalAfterDecimalValue = (currentMadeTotalAfterDecimalValue + paymentNumberPadValue);
                        var newMadeTotal = (currentMadeTotalBeforeDecimalValue + '.' + currentMadeTotalAfterDecimalValue);

                        calculatePaymentRemainNChange(newMadeTotal, subTotal);
                    }

                }

            } else {        // update current total input, before the dot
                currentMadeTotal = currentMadeTotal.split('');
                currentMadeTotal.splice(indexAfterDot, 0, paymentNumberPadValue);
                var newMadeTotal = currentMadeTotal.join('');

                calculatePaymentRemainNChange(newMadeTotal, subTotal);

            }
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

/**
 * 
 */