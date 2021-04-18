<?php

define("LOGGED_IN_ONLY", "LOGGED_IN_ONLY");
define("ADMINS_ONLY", "ADMINS_ONLY");
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

        <title>Admin Product Page</title>


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

                    <form action="modules/product/create_new_product.php" method="POST">
                        <h5>
                            Create a new product
                        </h5>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Price($)</th>
                                    <th scope="col"></th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row"><input type="text" name="product_name"></th>
                                    <td>
                                        <select id="categoryId" name="category_id">
                                             <option value="" selected disabled>Please select</option>
                                            <?php
                                            $categories = getCategoryList($conn);
                                            foreach ($categories as $row) {
                                                echo "<option value='" . $row['category_id'] . "'>" . $row['category_name'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </td> 
                                    <td><input type="text" name="price"></td> 
                                    <td><input class="btn btn-success" type="submit" value="Create new product"></td>  
                                </tr>
                            </tbody>
                        </table>
                    </form>

                    <form action="modules/product/update_product_information.php" method="POST">
                        <h5>
                            Update product information
                        </h5>
                        <table class="table">
                            <thead>
                                <tr>                                    
                                    <th scope="col">Name</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Price($)</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $products = getProductList($conn);
                                foreach ($products as $row) {
                                    echo
                                    '<input type="hidden" id="' . $row['product_id'] . '" value="' . $row['product_id'] . '">                                           
                                    <tr> 
                                    <td scope="row">' . $row['product_name'] . '</td>
                                    <td>' . getCategoryName($row['category_id'], $conn) . '</td>                                    
                                    <td><input type="text" class="price" value="' . $row['price'] . '"></td>
                                    <td><input type="submit" class="btn btn-primary update_button" id="' . $row['product_id'] . '" value="Update"></td>    
                                    <td><input type="submit" class="btn btn-danger delete_button" id="' . $row['product_id'] . '" value="Delete"></td>  
                                </tr>';
                                }
                                ?>                               

                            </tbody>
                        </table>

                </main>
            </div>
        </div>




        <script src="/js/jquery-3.6.0.min.js"></script>
        <script src="/js/bootstrap.bundle.min.js"></script>
        <script src="/js/update_product_information.js"></script>
    </body>
</html>
