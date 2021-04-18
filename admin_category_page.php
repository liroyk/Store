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

        <title>Admin Category Page</title>


    </head>
    <body>

        <?php
        include 'navbar.php';
        ?>
        <div class="container-fluid">
            <div class="row">
                <?php include 'sidebar.php'; ?>






                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">


                    <h5>
                        Create a new category
                    </h5>
                    <hr/>

                    <form class="form-inline" action="modules/category/create_new_category.php" method="POST">                            
                        <input type="text" name="category_name" class="form-control mb-2 mr-sm-2" placeholder="Enter category name">                        
                        <input type="submit" class="btn btn-success"  value="Create new category">
                    </form>

                    <form action="modules/category/update_category_information.php" method="POST">
                        <h5>
                            Update category information
                        </h5>
                        <table class="table">
                            <thead>
                                <tr>                                    
                                    <th scope="col">Name</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($categories as $row) {
                                    echo
                                    '<tr>                                    
                                    <td scope="row"> <input type="text" class="category_name" value="' . $row['category_name'] . '"></td>
                                     <td><input type="submit" class="btn btn-primary update_button" id="' . $row['category_id'] . '" value="Update"></td>    
                                    <td><input type="submit" class="btn btn-danger delete_button" id="' . $row['category_id'] . '" value="Delete"></td>  
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
        <script src="/js/update_category_information.js"></script>
    </body>
</html>
