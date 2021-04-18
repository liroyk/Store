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


        <title>Register</title>

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
        if (!isset($_SESSION)) {
            session_start();
        }
        require (__DIR__) . '/handlers/register_handler.php';
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
                            <h5 class="card-title text-center" style="text-decoration: underline;">Register:</h5>
                            <div class="row justify-content-center">
                                <div class="row justify-content-center col-lg-8 text-center">
                                    <a href="login.php" style="none"><p class="p-0 m-0">(Already have an account? Click here to login)</p></a>
                                </div>
                            </div>    
                        </div>
                        <div class="card-body">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, "utf-8"); ?>" method="POST" id="register">
                                <div class="row justify-content-center">
                                    <div class="col-lg-3">
                                        <div class="form-group is-invalid">                                    
                                            <input type="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" name="email" id="email" placeholder="Email address" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>" required>
                                            <div id="email_err" class="invalid-feedback"><?php echo $email_err; ?></div>
                                        </div>                   
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-lg-3">
                                        <div class="form-group is-invalid">                                   
                                            <input type="text" class="form-control <?php echo (!empty($first_name_err)) ? 'is-invalid' : ''; ?>" name="first_name" id="first_name" placeholder="First name" value="<?php echo isset($_POST['first_name']) ? $_POST['first_name'] : '' ?>" maxlength="50">
                                            <div id="first_name_err" class="invalid-feedback"><?php echo $first_name_err; ?></div>
                                        </div>                   
                                    </div>
                                </div>

                                <div class="row justify-content-center">
                                    <div class="col-lg-3">
                                        <div class="form-group is-invalid">                                   
                                            <input type="text" class="form-control <?php echo (!empty($last_name_err)) ? 'is-invalid' : ''; ?>" name="last_name" id="last_name" placeholder="Last name" value="<?php echo isset($_POST['last_name']) ? $_POST['last_name'] : '' ?>" maxlength="50">
                                            <div id="last_name_err" class="invalid-feedback"><?php echo $last_name_err; ?></div>
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
                                <div class="row justify-content-center">
                                    <div class="col-lg-3">
                                        <div class="form-group is-invalid">                                   
                                            <select id="country" name="country" class="form-control <?php echo (!empty($country_err)) ? 'is-invalid' : ''; ?>">
                                                <option selected value="">Select country</option>
                                                <?php
                                                $json = file_get_contents('https://restcountries.eu/rest/v2/all?fields=name');
                                                $obj = json_decode($json);
                                                foreach ($obj as $country) {
                                                    echo "<option value=\"$country->name\">  $country->name  </option>";
                                                }
                                                ?>                                 
                                            </select>
                                            <div class="invalid-feedback password_err"><?php echo $country_err; ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-lg-3">
                                        <input class="btn btn-primary btn-block btn-lg register_btn rounded-0 submit-button" type="submit" value="Register" onclick="this.disabled = true;this.value = 'Submitting...'; this.form.submit();">                            
                                    </div>
                                </div>
                            </form> 
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
