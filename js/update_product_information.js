
$(document).ready(function () {
    $(document).on("click", ".update_button", function (e) {
        e.preventDefault();
        e.stopPropagation();
        var button = "update_button";
        var product_id = $(this).attr('id');        
        var price = $(this).parent().siblings().find(".price").val();
        
        setTimeout(
                function ()
                {
                    $.post("/modules/product/update_product_information.php", {button: button, product_id: product_id, price: price})

                            .done(function (data) {
                               document.location.reload(true);
                            });
                }, 50);
    });

    $(document).on("click", ".delete_button", function (e) {
        e.preventDefault();
        e.stopPropagation();
        var button = "delete_button";
        var product_id = $(this).attr('id');
        
        
        setTimeout(
                function ()
                {
                    $.post("/modules/product/update_product_information.php", {button: button, product_id: product_id})

                            .done(function (data) {
                                
                                
                        document.location.reload(true)
                            });
                }, 50);
    });
});
