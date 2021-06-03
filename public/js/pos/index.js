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
 * 
 */
