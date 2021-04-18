<?php

define("LOGGED_IN_ONLY", "LOGGED_IN_ONLY");
define("USERS_ONLY", "USERS_ONLY");
require_once (__DIR__) . '/handlers/redirecter.php';


require_once (__DIR__) . '/configs/config.php';
require_once (__DIR__) . '/functions/functions.php';
require_once (__DIR__) . '/modules/category/get_category_list.php';
require_once (__DIR__) . '/modules/product/get_product_list.php';
require_once (__DIR__) . '/modules/customer/customer.php';
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/sidebar.css" rel="stylesheet">


        <title>Purchase History</title>


    </head>
    <body>

        <?php
        include 'navbar.php';
        ?>
        <div class="container-fluid">
            <div class="row">
                <?php
                include 'sidebar.php';
                ?>

                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">

                    <table id="purchase_history" class="table table-striped table-hover table-bordered col-md-9">
                        <thead>
                        <th colspan="2">Purchase History</th>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Product</th>
                                <th>Amount Paid($)</th>                                                             
                            </tr>
                            <?php
                            $transaction_history = getTransactionsHistoryByCustomer($conn);

                            if (empty($transaction_history)) {
                                echo '<tr>
                                <td colspan="3">You haven\'t bought anything yet</td>                                

                                </tr>';
                            } else {

                                foreach ($transaction_history as $row) {
                                    echo '<tr>
                                <td>' . $row['product_name'] . '</td>                                
                                <td>' . $row['transaction_price'] . '</td>
                                </tr>';
                                }
                                ?>    
                                <tr>
                                    <th colspan="3">Total: <?php echo getTransactionsTotal($conn); ?>$</th>                                
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>        
                </main>
            </div>
        </div>




        <script src="/js/jquery-3.6.0.min.js"></script>
        <script src="/js/bootstrap.bundle.min.js"></script>

    </body>
</html>
