
/**
 * Call to execute validation block of codes [List] form of customer
 * @return void 
 */
function validListCustomer(){
    // show confirm delete customer
    $('.customer-delete-btn').on('click', function(){
        return confirm('Do you really want to delete this customer record?');
    });

}

/**
 * Call to execute validation block of codes [Add] and
 * [Edit] form of customer.
 * @return void
 */
function validAddnEditCustomer(){
    // clear all inputs
    clearInputFields('#customer-reset-btn', '#customer-form');

    executeBsToolTips();

    onInputAllowStringNumbernWhitespace('#name');

    validateDiscountValue();

    onInputAllowNumber('#contact');
    
    // validate input fields before submit
    $('#customer-form').on('submit', function(){

        // check valid email address if user input
        emailValue = $('#email').val();
        if(emailValue.length > 0) {
            emailResult = checkValidEmail(emailValue);
            if(!emailResult.data){
                alert(emailResult.message);
                return false;
            }
        }
        
    });

}

/**
 * Auto set discount vale to 100% if input value out of range [ 0% -> 100% ].
 * @return void
 */
function validateDiscountValue(){
    $('#discount').on('input', function(){
        var currentValue = $(this).val();
        if(currentValue > 100){
            $(this).val(100);
        }
    });
}

/**
 * Check regex of valid email address.
 * @param [String] value
 * @return [ObjectRespond] data | message
 */
 function checkValidEmail(value){
    if( !value.match(/^[A-Za-z0-9-.]+\@[A-Za-z]+\.[A-Za-z]{2,6}/) ) {
        var respond = { data: false, message: 'Email is invalid, value should be (xx.xx-xx@xxx.xx)!' }
        return respond;
    } else {
        var respond = { data: value, message: 'Email is valid'};   
        return respond;
    }
}

/**
 * 
 */