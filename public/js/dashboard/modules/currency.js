/**
 * Call to execute validation block of code for [List] form of currency
 * @return void
 */
function validListCurrency(){
    // show confirm delete message
    $('.currency-delete-btn').on('click', function(){
        return confirm('Do you really want to delete this currency record?');
    });
}

/**
 * Call to execute validation block of codes for [Add] and [Edit]
 * form of currency
 * @return void
 */
function validAddnEditCurrency(){
    // clear all inputs
    clearInputFields('#currency-reset-btn', '#currency-form');

    executeBsToolTips();

    // force to enter only character and number
    mOnInputAllowStringnNumber('#name');

    // force to enter only character, number and '-' symbol only.
    mOnInputAllowStringnNumberSymbol('#code');

    // force to enter only number on exchange rate.
    onInputAllowNumber('#exchange_rate');

    // force to enter the correct exchange rate value.
    mOnInputCheckNumberRange('#exchange_rate');

}

/**
 * Force exchange rate to stay in the range of 0.01 to 99999999.
 * @param [Html_Input_Id_Name] inputId
 */
function mOnInputCheckNumberRange( inputId ){
    $(inputId).on('input', function( event ){
        if( $(event.target).val() > 99999999 ) {
            $(event.target).val( 99999999 );
        }
    });
}

/**
 * Force to enter only alphanumeric and number.
 * @param [Html_Input_Id_Name] inputId
 */
function mOnInputAllowStringnNumber( inputId ){
    $(inputId).on('input', function(e) {
        $(e.target).val($(e.target).val().replace(/[^a-zA-Z0-9 ]/g, ''))
    })
}

/**
 * Force to enter only alphanumeric and number and - symbol only.
 * @param [Html_Input_Id_Name] inputId
 */
 function mOnInputAllowStringnNumberSymbol( inputId ){
    $(inputId).on('input', function(e) {
        $(e.target).val($(e.target).val().replace(/[^a-zA-Z0-9-]/g, ''))
    })
}

/**
 * 
 */
