/**
 * Call to execute validation block of codes for [List] form of product variant
 * @return void
 */
 function validListProductVariant(){
    // show confirm delete message
    $('.product-variant-delete-btn').on('click', function(){
        return confirm('Do you really want to delete this product variant record?');
    });

}

/**
 * Call to execute validation block of codes for [Add] and 
 * [Edit] form of product variant
 * @param [String] options [ add, edit ]
 * @return void
 */
 function validAddnEditProductVariant(options){
    // clear all inputs
    clearInputFields('#product-variant-reset-btn', '#product-variant-form');

    // product
    onAttributeSelectedUpdatePreviewText('#name', '#pv-product-name', 'yes');
    // type
    onAttributeSelectedUpdatePreviewText('#type', '#pv-type-name', 'no');
    // size
    onAttributeSelectedUpdatePreviewText('#size', '#pv-size-name', 'no');

    autoGenerateProductVariantTable('#json-productvariants', options);

    // generate product variant table
    onAddVariantBtnClickedGenerateTable();

    // validate datas on form submit
    $('#product-variant-form').on('submit', function(){
        // check if table is empty
        tableRowLengthValue = document.querySelectorAll('#list-product-variant-tbody tr').length;
        
        var isEdit = $('#edit').val();
        if(isEdit != 'yes'){
            productVariantsCounter = JSON.parse( $('#json-productvariants').val() ).length;
            productVariantsCounter != 0 ? tableRowLengthValue-=productVariantsCounter : tableRowLengthValue;
        }
        if(tableRowLengthValue == 0){
            alert("Can't submit with empty product variant, please add product variant and try again!");
            return false;
        }

    });

 }

 /**
  * Auto generate productvariants records from database
  * @param [Html_Element_Id_Name] jsonTypeProductVariantsIdName 
  * @param [String] options [ add, edit ]
  * @return void
  */
function autoGenerateProductVariantTable(jsonTypeProductVariantsIdName, options){
    productVariantsObject = JSON.parse( $(jsonTypeProductVariantsIdName).val() );

    if(productVariantsObject.length != 0) {
        // filter create table row based on product variants
        productVariantsObject.filter(function(productVariant){
            generateProductVariantTableBody(productVariant, options);
        });
    }

}

 /**
  * Update product variant preview name if changing associated 
  * attribute selected option.
  * @param [Html_Element_Id_Name] selectedTagIdName
  * @param [Html_Element_Id_Name] previewTextIdName
  * @param [String] autoReplacePreview [ yes, no ] ### for product
  * @return void
  */
function onAttributeSelectedUpdatePreviewText(selectedTagIdName, previewTextIdName, autoReplacePreview){
    if (autoReplacePreview == 'yes'){
        var productName = $(selectedTagIdName).val();
        $(previewTextIdName).empty();
        $(previewTextIdName).append(productName);
    }

    $(selectedTagIdName).on('change', function(){
        var currentValue = $('option:selected', this).text();

        if(currentValue.length != 0){
            $(previewTextIdName).empty();
            $(previewTextIdName).append(currentValue);
        } else {
            $(previewTextIdName).empty();
            $(previewTextIdName).append('-');
        }

    });
}

/**
 * Generate product variant table body data on button clicked.
 * @return void
 */
function onAddVariantBtnClickedGenerateTable (){
    $('#add-variant-btn').on('click', function(e){
        e.preventDefault();

        // validate all variant attribute values [type, size, price]
        var validationResult = validateAttributeValues('#type', '#size', '#price');
        if(!validationResult.data){
            alert(validationResult.message);
            return false;
        }

        // generate product variant table body
        validationResult.product = $('#name').val();
        
        // prevent duplicate product variant data
        var isDuplicate = false;
        var currentName = validationResult.product +' '+ validationResult.typeText +' '+ validationResult.sizeText;
        $('#list-product-variant-thead tr').each(function(){
            if( $(this).find('td').eq(0).text() == currentName ){
                isDuplicate = true;
                return false;
            }
        });

        if(!isDuplicate){
            generateProductVariantTableBody(validationResult, 'edit');
    
            // clear all inputs
            $('#product-variant-form')[0].reset();
            $('#pv-type-name').empty();
            $('#pv-size-name').empty();
            $('#pv-type-name').append('-');
            $('#pv-size-name').append('-');
        } else {
            alert('Product variant already added in the list, please choose another variant!')
        }
    });
}

/**
 * Validate all input product variant attribute values
 * @param  [Html_Element_Id] type 
 * @param  [Html_Element_Id] size 
 * @param  [Html_Element_Id] price 
 * @return [ObjectRespond]   respond
 */ 
function validateAttributeValues(type, size, price){

    // validate type value
    typeValue = $(type).val();
    typeText  = $('option:selected', type).text();
    if( typeValue.length == 0 ){
        var respond = { 
            data: false, 
            message: 'Type value must be selected before create variant!', 
        };
        return respond;
    }

    // validate size value
    sizeValue = $(size).val();
    sizeText  = $('option:selected', size).text();
    if( sizeValue.length == 0 ){
        var respond = { 
            data: false, 
            message: 'Size value must be selected before create variant!', 
        };
        return respond;
    }

    // validate price value
    priceValue = $(price).val();
    if( isNaN(priceValue) ){ // if data not a number
        var respond = { 
            data: false, 
            message: 'Price value must be a number!', 
        };
        return respond;
    } else if( priceValue.length == 0) {
        var respond = { 
            data: false, 
            message: 'Please fill in price before add variant!', 
        };
        return respond;
    }

    respond = {
        data:      true,
        price:     priceValue,
        typeValue: typeValue,
        sizeValue: sizeValue,
        typeText:  typeText,
        sizeText:  sizeText,
        message:   'All attribute values are valided',
    };

    return respond;
}

/**
 * Generate product variant table body based on given attribute object params.
 * @param [Object] attributeObject 
 * @param [String] options [ add, edit ]
 */
function generateProductVariantTableBody(attributeObject, options){
    // table body
    var tbody = $('#list-product-variant-tbody');
    // table row
    var tr = $('<tr></tr>');

    // product variant name [ product + type + size]
    var td_productVariantName = $("<td style='vertical-align: middle;'></td>")
        .html( attributeObject.product +' '+ attributeObject.typeText +' '+ attributeObject.sizeText )
        .appendTo(tr);
    
    // product variant type
    var td_productVariantType = $("<td style='vertical-align: middle;'></td>")
        .html( attributeObject.typeText )
        .appendTo(tr);

    // product variant type
    var td_productVariantSize = $("<td style='vertical-align: middle;'></td>")
        .html( attributeObject.sizeText )
        .appendTo(tr);

    // product variant price
    var td_productVariantSize = $("<td style='vertical-align: middle;'></td>")
        .html( '$'+ attributeObject.price )
        .appendTo(tr);

    // actions (delete)
    if(options == 'edit'){
        var td_deleteBtn = $("<td style='vertical-align: middle; color: red;'></td>")
            .addClass('cursor-pointer')
            .html('Delete')
            .appendTo(tr);
    } else {
        var tb_preview = $("<td style='vertical-align: middle;'></td>")
            .html('[ Preview Only ]')
            .appendTo(tr);
    }
    
    // ##########################
    //  Hidden Data For Backend
    // ##########################

    if(options == 'edit'){
        // typeIds
        var typeIdInput = $('<input>')
            .attr('type', 'hidden')
            .attr('name', 'typeId[]')
            .attr('value', attributeObject.typeValue)
            .appendTo(tr);
        
        // sizeIds
        var typeIdInput = $('<input>')
            .attr('type', 'hidden')
            .attr('name', 'sizeId[]')
            .attr('value', attributeObject.sizeValue)
            .appendTo(tr);
    
        // price values
        var typeIdInput = $('<input>')
            .attr('type', 'hidden')
            .attr('name', 'price[]')
            .attr('value', attributeObject.price)
            .appendTo(tr);
    
        //bind delete product variant
        $(td_deleteBtn).on('click',function(){
            $(this).closest('tr').remove();
        });
    }

    // bind everything into tr
    tbody.append(tr);
}
