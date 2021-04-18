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


        <title>Admin Login</title>

        <style>
            .form-signin {
                width: 100%;
                max-width: 330px;
                padding: 15px;
                margin: auto;
            }
        </style>



    </head>
    <body>
        <?php
        require_once (__DIR__) . '/handlers/login_handler_admin.php';
        ?>

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
                            <h5 class="card-title text-center" style="text-decoration: underline;">Login:</h5>
                            <div class="row justify-content-center">
                                <div class="row justify-content-center col-lg-8 text-center">
                                    <a href="register.php" style="none"><p class="p-0 m-0">(Not registered? Click here to create an account)</p></a>
                                </div>
                            </div>    
                        </div>
                        <div class="card-body">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, "utf-8"); ?>" method="POST" class="mx-auto>">
                                <div class="row justify-content-center">
                                    <div class="col-lg-3">
                                        <div class="form-group is-invalid">
                                            <input type="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" name="email" id="email" placeholder="Your email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>" required>
                                            <div class="invalid-feedback password_err"><?php echo $email_err; ?></div>
                                        </div>                   
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <input type="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" name="password" id="password" placeholder="Password" required>
                                            <div class="invalid-feedback password_err"><?php echo $password_err; ?></div>
                                        </div>                   
                                    </div>
                                </div>
                                <div class="row justify-content-center text-center" role="alert">
                                    <div class="col-lg-3 <?php echo (!empty($login_err)) ? 'alert alert-danger' : ''; ?>">
                                        <?php echo $login_err; ?>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-lg-3">
                                        <input class="btn btn-primary btn-block btn-lg rounded-0 submit-button" type="submit" value="Login" onclick="this.disabled = true;this.value = 'Logging in...'; this.form.submit();">    
                                    </div>
                                </div>
                            </form>
                        </div>
                        <hr>
                        <div class="row justify-content-center">
                        </div>        
                    </div>

                </main>
            </div>
        </div>




        <script src="/js/jquery-3.6.0.min.js"></script>
        <script src="/js/bootstrap.bundle.min.js"></script>
        <script src="/js/update_category_information.js"></script>
    </body>
</html>
