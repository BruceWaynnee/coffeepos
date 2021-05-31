/**
 * Call to execute validation block of codes for [List] form of product
 * @return void
 */
 function validListProduct(){
    // show confirm delete message
    $('.product-delete-btn').on('click', function(){
        return confirm('Are you sure you really want to delete this product record? All associate product variants will be delete too!');
    });

}

/**
 * Call to execute validation block of codes for [Add] and 
 * [Edit] form of product
 * @param [String] formType [ add ,edit ]
 * @return void
 */
function validAddnEditProduct(formType){
    // clear all inputs
    clearInputFields('#product-reset-btn', '#product-form');

    // execute product image file
    imageFileUpload('#browse-btn', '#image-file', '#image-name-text');

    // foce to enter only character and number
    onInputAllowStringNumbernWhitespace('#name');

    executeBsToolTips();

    // validate data on form submit
    $('#product-form').on('submit', function(){

        // image file
        if(formType != 'edit'){
            if( !$('#image-file').val() ){
                return confirm('Submit without uploading image? click cancel to upload, ok to continue!');
            }
        }
        
    });

}

/**
 * Trigger openning file upload form by clicking on provided button id,
 * validat provided file and and show file name on text place holder on success.
 * @return void
 */
function imageFileUpload(fileUploadBtnId, fileInputId, fileNameTextHolderId) {
    // trigger file input base on browse button
    $(fileUploadBtnId).on('click', function(){
        $(fileInputId).trigger('click');
    });
    
    // check file extension ( png, jpeg )
    $(fileInputId).on('change', function(){            
        var input = this;
        var imgPath = $(this).val();
        var imageFileNameOnly = imgPath.replace(/C:\\fakepath\\/i, '');

        // check extension
        // var ext = myFile.split('.').pop();
        var ext = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();

        if(input.files && input.files[0] && (ext=="png" || ext=='jpeg') ){
            reader = new FileReader();
            reader.onload = function(e){
                $('#product-image-preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);

            $(fileNameTextHolderId).text( imageFileNameOnly.replace(/[^a-zA-Z0-9]/g,'_').toLowerCase() );
        } else {
            alert('Image extension not match the requirement, accept ( png, jpeg  ) only!');
        } 
    });

}
