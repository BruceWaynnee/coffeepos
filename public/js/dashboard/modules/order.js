/**
 * Call to execute validation block of codes for [List] form of order
 * @return void
 */
 function validListOrder(){
    // show confirm delete message
    $('.order-delete-btn').on('click', function(){
        return confirm('Do you really want to delete this order history record?');
    });

}
