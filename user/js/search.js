$(document).ready(function() {
   
    $('.search-box input[type="search"]').on("keyup input", function() {
        /* Get input value on change */
        var inputVal = $(this).val();

        var resultDropdown = $(this).siblings(".result");
        
        
        if (inputVal.length) {
            $.get("../admin/search.php", {
                term: inputVal
            }).done(function(data) {
                resultDropdown.html(data);
                
            });
        } else {
            resultDropdown.empty();
        }
    
    });


    // Set search input value on click of result item
    $(document).on("click", ".result p", function() {
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});