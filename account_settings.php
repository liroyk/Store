<?php

define("LOGGED_IN_ONLY", "LOGGED_IN_ONLY");
define("USERS_ONLY", "USERS_ONLY");
require_once (__DIR__) . '/handlers/redirecter.php';

require_once (__DIR__) . '/configs/config.php';
require_once (__DIR__) . '/functions/functions.php';
require_once (__DIR__) . '/modules/category/get_category_list.php';
require_once (__DIR__) . '/modules/product/get_product_list.php';
require_once (__DIR__) . '/modules/customer/customer.php';
require_once (__DIR__) . '/modules/customer/update_customer_information.php';
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/sidebar.css" rel="stylesheet">

        <title>Account Settings</title>


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
                    <div class="card card-inner">
                        <div class="card-header text-center">
                            <h5 class="card-title text-center" style="text-decoration: underline;">Update Customer Details:</h5>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, "utf-8"); ?>" method="POST" id="update_user_details">
                                <div class="row justify-content-center">
                                    <div class="col-lg-3">
                                        <div class="form-group is-invalid">  
                                            <label for="email">Email address:</label>
                                            <input type="email" disabled class="form-control" name="email" id="email" value="<?php echo$_SESSION['email']; ?>" required>

                                        </div>                   
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-lg-3">
                                        <div class="form-group is-invalid"> 
                                            <label for="first_name">First Name:</label>
                                            <input type="text" class="form-control <?php echo (!empty($first_name_err)) ? 'is-invalid' : ''; ?>" name="first_name" id="first_name" placeholder="First name" value="<?php echo getCustomerFirstName($conn); ?>" maxlength="50">
                                            <div id="first_name_err" class="invalid-feedback"><?php echo $first_name_err; ?></div>
                                        </div>                   
                                    </div>
                                </div>

                                <div class="row justify-content-center">
                                    <div class="col-lg-3">
                                        <div class="form-group is-invalid">
                                            <label for="last_name">Last Name:</label>
                                            <input type="text" class="form-control <?php echo (!empty($last_name_err)) ? 'is-invalid' : ''; ?>" name="last_name" id="last_name" placeholder="Last name" value="<?php echo getCustomerLastName($conn); ?>" maxlength="50">
                                            <div id="last_name_err" class="invalid-feedback"><?php echo $last_name_err; ?></div>
                                        </div>                   
                                    </div>
                                </div>         
                                <div class="row justify-content-center">
                                    <div class="col-lg-3">
                                        <input class="btn btn-primary btn-block btn-lg register_btn rounded-0 submit-button" type="submit" value="Update" onclick="this.disabled = true;this.value = 'Submitting...'; this.form.submit();">                            
                                    </div>
                                </div>
                            </form> 
                        </div> 
                    </div>


                    <div class="card card-inner">
                        <div class="card-header text-center">
                            <h5 class="card-title text-center" style="text-decoration: underline;">Delete your account:</h5>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-lg-3">
                                    <form action="/modules/customer/delete_customer.php">
                                        <input class="btn btn-danger btn-block btn-lg rounded-0 submit-button" type="submit" value="Delete" onclick="this.disabled = true;this.value = 'Deleting...'; this.form.submit();">
                                    </form>
                                </div>
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
