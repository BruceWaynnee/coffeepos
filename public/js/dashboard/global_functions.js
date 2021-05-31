/**
 * ======================================
 * | List Of Available Global Functions |
 * ======================================
 * 
 *  - clearInputFields
 *  - onInputAllowStringnNumber
 */

/**
 * Clear all fillable fields from html form.
 * @param [Html_Element_Id_Name] resetBtnId
 * @param [Html_Element_Id_Name] formId
 * @param [String] message
 * @return void
 */
 function clearInputFields(resetBtnId, formId, message){
    // set alert message
    message != null ? message : message = 'Are you sure to clear all input fields?';

    $(resetBtnId).on('click', function(e){
        e.preventDefault();
        if( confirm(message) ){
            $(formId)[0].reset();
        };
    });
}

/**
 * Force to enter only alphanumeric and number.
 * @param [Html_Input_Id_Name] inputId
 */
 function onInputAllowStringnNumber(inputId){
    $(inputId).on('input', function(e) {
        $(e.target).val($(e.target).val().replace(/[^a-zA-Z0-9]/g, ''))
    })
 }

 /**
 * Force to enter only alphanumeric and whitespace.
 * @param [Html_Input_Id_Name] inputId
 */
  function onInputAllowStringNumbernWhitespace(inputId){
    $(inputId).on('input', function(e) {
        $(e.target).val($(e.target).val().replace(/[^a-zA-Z0-9 ]/g, ''))
    })
 }

 /**
  * Enable bootstrap tool tips
  * @return void
  */
 function executeBsToolTips() {
     $('[data-toggle="tooltip"]').tooltip();
 }