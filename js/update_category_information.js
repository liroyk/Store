
$(document).ready(function () {
    $(document).on("click", ".update_button", function (e) {
        e.preventDefault();
        e.stopPropagation();
        var button = "update_button";
        var category_id = $(this).attr('id');        
        var category_name = $(this).parent().siblings().find(".category_name").val();
       
        setTimeout(
                function ()
                {
                    
                    $.post("/modules/category/update_category_information.php", {button: button, category_id: category_id, category_name: category_name})

                            .done(function (data) {
                                
                                location.reload();
                            });

                }, 50);
    });

    $(document).on("click", ".delete_button", function (e) {
        e.preventDefault();
        e.stopPropagation();
        var button = "delete_button";
        var category_id = $(this).attr('id');
        
        setTimeout(
                function ()
                {
                    $.post("/modules/category/update_category_information.php", {button: button, category_id: category_id})

                            .done(function (data) {                              
                                location.reload();
                            });
                }, 50);
    });
});
