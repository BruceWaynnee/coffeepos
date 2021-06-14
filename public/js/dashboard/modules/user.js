/**
 * Call to execute validation block of codes for [List] form of users.
 * @return void
 */
 function validListUser(){

    // show confirm delete message
    $('.user-delete-btn').on('click', function(){
        return confirm('Do you really want to delete this user record?');
    });

}

/**
 * Call to execute validation block of codes for [Add] and [Edit]
 * form of user.
 * @param [String] option [ add, edit ]
 * @return void
 */
 function validAddnEditUser(option){

    // clear all inputs
    clearInputFields('#user-reset-btn', '#user-form');

    if(option == 'edit'){
        // on password reset checkbox checked enable password input
        onResetCheckboxResetPassword('#reset-password-checkbox', '#password');
    }

    // foce to enter only alphanumeric without whitespace
    mOnInputAllowAlpanumericNoneSpace('#username');

    // foce to enter only alphabet
    mOnInputAllowAlphabet('#firstname');
    mOnInputAllowAlphabet('#lastname');


    // validate data on from submit
    $('#user-form').on('submit', function(){
        
        // check valid email address
        emailValue = $('#email').val();
        emailResult = checkValidEmail(emailValue);
        if(!emailResult.data){
            alert(emailResult.message);
            return false;
        }
        
    });

    executeBsToolTips();
    
}

/**
 * Show or hide passowrd using checkbox.
 * @return void; 
 */
 function showPassword() {
    var x = document.getElementById("password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

/**
 * On password reset checkbox checked enable and disable password input.
 * @param [Html_Element_Id_Name] checkboxElementIdName 
 * @param [Html_Element_Id_Name] passwordInputName 
 * @returns void
 */
 function onResetCheckboxResetPassword(checkboxElementIdName, passwordInputIdName){
    $(checkboxElementIdName).on('change', function(){
        if( $(this).is(':checked') ) {
            $(passwordInputIdName).removeAttr('disabled');
            $(passwordInputIdName).prop('required', true);
        } else {
            $(passwordInputIdName).attr('disabled', true);        
            $(passwordInputIdName).removeAttr('required');
        }
    });
}

/**
 * Force to enter only alphanumeric without whitespace.
 * @param [Html_Input_Id_Name] inputId
 */
function mOnInputAllowAlpanumericNoneSpace(inputId){
    $(inputId).on('input', function(e) {
        $(e.target).val($(e.target).val().replace(/[^a-zA-Z0-9]/g, ''))
    })
}

/**
 * Force to enter only alphabet.
 * @param [Html_Input_Id_Name] inputId
 */
function mOnInputAllowAlphabet(inputId){
    $(inputId).on('input', function(e) {
        $(e.target).val($(e.target).val().replace(/[^a-zA-Z]/g, ''))
    })
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
