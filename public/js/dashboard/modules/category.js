/**
 * Call to execute validation block of codes for [List] form of category
 * @return void
 */
 function validListCategory(){
    // show confirm delete message
    $('.category-delete-btn').on('click', function(){
        return confirm('Do you really want to delete this category record?');
    });

}

/**
 * Call to execute validation block of codes for [Add] and 
 * [Edit] form of category
 * @return void
 */
 function validAddnEditCategory(){
    // clear all inputs
    clearInputFields('#category-reset-btn', '#category-form');

    // foce to enter only character and number
    mOnInputAllowStringnNumber('#name');

    executeBsToolTips();

 }

 
/**
 * Force to enter only alphanumeric and number.
 * @param [Html_Input_Id_Name] inputId
 */
 function mOnInputAllowStringnNumber(inputId){
    $(inputId).on('input', function(e) {
        $(e.target).val($(e.target).val().replace(/[^a-zA-Z0-9& ]/g, ''))
    })
 }

