/**
 * Call to execute validation block of codes for [List] form of size
 * @return void
 */
 function validListSize(){
    // show confirm delete message
    $('.size-delete-btn').on('click', function(){
        return confirm('Do you really want to delete this size record?');
    });

}

/**
 * Call to execute validation block of codes for [Add] and 
 * [Edit] form of size
 * @return void
 */
 function validAddnEditSize(){
    // clear all inputs
    clearInputFields('#size-reset-btn', '#size-form');

    // foce to enter only character and number
    onInputAllowStringnNumber('#name');

    executeBsToolTips();

 }

