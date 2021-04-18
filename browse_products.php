<?php
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

        <title>Browse Products</title>


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

                    <h5>
                        Buy products
                    </h5>
                    <table class="table">
                        <thead>
                            <tr>                                    
                                <th scope="col">Name</th>                                    
                                <th scope="col">Price($)</th>
                                <th scope="col"></th>                                   
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            if (!isset($_SESSION)) {
                                session_start();
                            }

                            if (isset($_SESSION['is_admin'])) {
                                $admin_id = getAdminID($conn);
                            } else {
                                $customer_id = getCustomerID($conn);
                            }



                            $category_name = $_GET['category_name'];
                            $products = getProductListByCategory($conn, $category_name);

                            if (!isset($_SESSION['is_admin']) && isset($_SESSION['email'])) {
                                echo '<form action="modules/product/update_product_information.php" method="POST">';
                                foreach ($products as $row) {
                                    echo
                                    '<tr> 
                                    <td scope="row">' . $row['product_name'] . '</td>                                                                     
                                    <td class="price">' . $row['price'] . '</td> 
                                    <td><input type="submit" class="btn btn-success update_button" id="' . $row['product_id'] . '" value="Buy now"></td>   
                                </tr>';
                                }
                                echo '</form>';
                            } elseif (isset($_SESSION['is_admin']) && isset($_SESSION['email'])) {
                                foreach ($products as $row) {
                                    echo
                                    '<tr> 
                                    <td scope="row">' . $row['product_name'] . '</td>                                                                     
                                    <td class="price">' . $row['price'] . '</td> 
                                    <td><input type="submit" class="btn btn-success" id="' . $row['product_id'] . '" value="Buy now"></td>   
                                </tr>';
                                }
                            } else {
                                foreach ($products as $row) {
                                    echo
                                    '<tr> 
                                    <td scope="row">' . $row['product_name'] . '</td>                                                                     
                                    <td class="price">' . $row['price'] . '</td> 
                                    <td><input type="submit" class="btn btn-success" disabled value="Log in to buy"></td>   
                                </tr>';
                                }
                            }
                            ?>                               

                        </tbody>
                    </table>

                </main>
            </div>
        </div>




        <script src="/js/jquery-3.6.0.min.js"></script>
        <script src="/js/bootstrap.bundle.min.js"></script>
        <script src="/js/buy_products.js"></script>
    </body>
</html>
