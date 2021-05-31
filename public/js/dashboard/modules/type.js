/**
 * Call to execute validation block of codes for [List] form of type
 * @return void
 */
 function validListType(){
    // show confirm delete message
    $('.type-delete-btn').on('click', function(){
        return confirm('Do you really want to delete this type record?');
    });

}

/**
 * Call to execute validation block of codes for [Add] and 
 * [Edit] form of type
 * @return void
 */
 function validAddnEditType(){
    // clear all inputs
    clearInputFields('#type-reset-btn', '#type-form');

    // foce to enter only character and number
    onInputAllowStringnNumber('#name');

    executeBsToolTips();

 }

