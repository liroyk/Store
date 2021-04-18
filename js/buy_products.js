
$(document).ready(function () {
    $(document).on("click", ".update_button", function (e) {
        e.preventDefault();
        e.stopPropagation();
        var button = "buy_button";
        var product_id = $(this).attr('id');       
       // var transaction_price = $(this).parent().siblings().next().text();
        var transaction_price = $(this).closest('tr').find('.price').text();        
        setTimeout(
                function ()
                {

                    $.post("/modules/customer/buy_products.php", {button: button, product_id: product_id, transaction_price: transaction_price})

                            .done(function (data) {
                                alert("Successfully purchased");
                                location.reload();
                            });

                }, 50);
    });

});
