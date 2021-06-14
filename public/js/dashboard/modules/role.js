/**
 * Call to execute validation block of codes for [List] form of roles.
 * @return void
 */
 function validListRole(){

    // show confirm delete message
    $('.role-delete-btn').on('click', function(){
        return confirm('Do you really want to delete this role record?');
    });

}


/**
 * Call to execute validation block of codes for [Add] and [Edit]
 * form of roles.
 * @return void
 */
 function validAddnEditRole(){

    // clear all inputs    
    $('#role-reset-btn').on('click', function(e){
        e.preventDefault();
        if( confirm('Are you sure to clear all input fields?') ){
            // reset all possible inputs
            $('#role-form')[0].reset();
            // clear permission selected option
            $('.filter-option-inner-inner').empty();
            $('.filter-option-inner-inner').html('Nothing Selected');
        };
    });

    // foce to enter only character and number
    mOnInputAllowStringnNumber('#name');

    executeBsToolTips();

    // validate data on from submit
    $('#role-form').on('submit', function(){

        // check permissions value
        permissionArrLength = $('select[name="permissions[]"]').val().length;
        if(permissionArrLength == 0){
            alert('Role should at least has one or more permission, please assign permission for this role!');
            return false;
        }
        
    });

}

/**
 * Auto selected permissions of current role provided from database.
 * @return void
 */
function autoSelectPermissionsOfCurrentRole(){
    // auto selected permissions based on current role
    permissionsIdsArr =  JSON.parse( $('#role-permissions').val() );
    // check permissions selected option
    $('select[name="permissions[]"]').val(permissionsIdsArr);
}

/**
 * Force to enter only alphanumeric without whitespace.
 * @param [Html_Input_Id_Name] inputId
 */
function mOnInputAllowStringnNumber(inputId){
    $(inputId).on('input', function(e) {
        $(e.target).val($(e.target).val().replace(/[^a-zA-Z0-9]/g, ''))
    })
}
