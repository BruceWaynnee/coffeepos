/**
 * Auto call all functions
 * @return void
 */
function executePosIndexJs(){
    onCategoryClickedShowProducts();

}

/**
 * On category clicked show products on list.
 * @return void
 */
function onCategoryClickedShowProducts(){
    $('.category-li').on('click', function(){
        var categoryId = $(this).attr('id');

        if(categoryId != 'home'){
            $('.product-card-wrapper').addClass('d-none');
            var test = $('.categoryId'+categoryId).removeClass('d-none');
        } else {
            $('.product-card-wrapper').removeClass('d-none');
        }

    });
}

/**
 * Generate product variant table body on modual popup content.
 * @param [Object] productVariantObjects
 * @return void
 */
 function generateProductVariantTableBody(productVariantObjects){
    // clean table rows
    $('#list-productvariants-body').empty();

    // filter create table body records
    productVariantObjects.filter(function(item){

        // add productvariants into table list
        var tbody = $('#list-productvariants-body');

        // productvariant row
        var tr = $("<tr></tr>")
            .attr('price', item.price)
            .attr('productVariantName', item.name)
            .addClass('addVariant cursor-pointer');

        // productvariant name
        var td_productVariantName = $("<td style='vertical-align: middle;' ></td>")
            .html(item.name)
            .appendTo(tr);

        // productvariant type
        var td_productVariantType = $("<td style='vertical-align: middle;' ></td>")
            .html(item.type.name)
            .appendTo(tr);

        // productvariant size
        var td_productVariantType = $("<td style='vertical-align: middle;' ></td>")
            .html(item.size.name)
            .appendTo(tr);

        // productvariant price
        var td_productVariantName = $("<td style='vertical-align: middle;' ></td>")
            .html(item.price)
            .appendTo(tr);
        
        // bind everything into quotation product list
        tbody.append(tr);

    });

    // on add variant row click add to sidebar
    $('.addVariant').on('click', function(){
        var currentRow = $(this);
        var price = currentRow.attr('price');
        var name = currentRow.attr('productVariantName');
        
        // disable order is empty sidebar view
        $('.empty-cart-img-wrapper').addClass('d-none');
        // enable product order list view
        $('.order-product-list-wrapper').removeClass('d-none');
        $('.grand-total-wrapper').removeClass('d-none');

        console.log(price +'<br>'+ name);
        
        var productVariantSideBarListWrapper = $('#order-product-list-wrapper');

        var div_productVarRow = $('<div></div>')
            .addClass('productvariant-row cursor-pointer');

            // name
            var p_productVarName = $('<p></p>')
                .html(name)
                .appendTo(div_productVarRow);

            // price
            var p_productVarPrice = $('<p></p>')
                .html(price +' $')
                .appendTo(div_productVarRow);
            
            // quantity
            var p_productVarPrice = $('<p></p>')
                .html('Quantity: 1')
                .appendTo(div_productVarRow);
            
        productVariantSideBarListWrapper.append(div_productVarRow);

        $('#products-modal').modal('hide');

        // on productvariant row click active current row
        $('.productvariant-row').on('click', function(){
            var currentRow = $(this);

            // remove previous active row and apply corruent
            $('.productvariant-row').removeClass('productvariant-row-active');
            currentRow.addClass('productvariant-row-active');


        });

    });

}

