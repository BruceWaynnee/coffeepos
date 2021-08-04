/**
 * Call to execute validation block of codes for [List] form of income archive.
 * @return void
 */
function validListIncomeArchive(){

    // show confirm delete message
    $('.income-archive-delete-btn').on('click', function(){
        return confirm('Do you really want to delete this income archive history?');
    });

    tableColumnSearch();
}


/**
 * Call to execute validation block of codes for [Add] and [Edit]
 * form of income archive.
 * @return void
 */
function validAddnEditIncomeArchive(){

}

/**
 * Search income archive row based on all columns.
 * @return void 
 */
 function tableColumnSearch(){
    $("#income-search-box").on("keyup", function(){
        var value = $(this).val().toLowerCase();
        console.clear();
        $("table tr").each(function(index){
            if (index !== 0) {
                $row = $(this);
                $row.find("td").each(function(i, td){
                    var id = $(td).text().toLowerCase();
                    console.log(id + " | " + value + " | " + id.indexOf(value));

                    if (id.indexOf(value) !== -1) {
                        $row.show();
                        return false;
                    } else {
                        $row.hide();
                    }
                });
            }
        });
    });    
}
