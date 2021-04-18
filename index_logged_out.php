<?php
define("LOGGED_OUT_ONLY", "LOGGED_OUT_ONLY");

require_once (__DIR__) . '/handlers/redirecter.php';

require_once (__DIR__) . '/configs/config.php';
require_once (__DIR__) . '/functions/functions.php';
require_once (__DIR__) . '/modules/category/get_category_list.php';
require_once (__DIR__) . '/modules/product/get_product_list.php';
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/sidebar.css" rel="stylesheet">

        <title>Dashboard</title>


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
                    <div class="card mt-4 card-inner">
                        <div class="card-body">
                            <div class="row mr-2">                                        
                                <p class="card-text">
                                    <strong>Welcome to my store, <a href="/register.php">Register</a> or <a href="/login.php">Login</a></strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>




        <script src="/js/jquery-3.6.0.min.js"></script>
        <script src="/js/bootstrap.bundle.min.js"></script>

    </body>
</html>
