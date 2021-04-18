<?php

// Include config file
require_once (__DIR__) . '/../configs/config.php';
require_once (__DIR__) . '/../functions/functions.php';

// Define variables and initialize with empty values
$email = $password = $confirm_password = $first_name = $last_name = "";
$email_err = $password_err = $confirm_password_err = $first_name_err = $last_name_err = $country_err = "";
$empty_fname = $empty_lname = false;
// Processing form data when form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $param_email = trim(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL));
    $param_first_name = trim(filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING));
    $param_last_name = trim(filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING));
    $param_country = trim(filter_input(INPUT_POST, 'country'));


    if (empty($param_first_name)) {
        $first_name_err = "Required";
        $empty_fname = true;
    }
    if (strlen($param_first_name) > 50) {
        $first_name_err = "50 Letters max.";
    }
    if (empty($param_last_name)) {
        $last_name_err = "Required";
        $empty_lname = true;
    }

    if (strlen($param_country) == 0) {
        $country_err = "Required";
    }

    if (strlen($param_last_name) > 50) {
        $first_name_err = "50 Letters max.";
    }

    if (!$empty_fname && !preg_match("/^(\p{L}+(?: \p{L}+)*)$/u", $param_first_name)) {
        $first_name_err = "Only alphabeticald letters allowed";
    }
    ///^(\p{L}+)$/u
    if (!$empty_lname && !preg_match("/^(?>\pL+ ?\b)+$/u", $param_last_name)) {
        $last_name_err = "Only alphabetical letters allowed";
    }



    // Validate email
    if (empty(trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL)))) {
        $email_err_err = "Required";
    } else {
        if (($param_email) == false) {
            $email_err = "Invalid email address";
        } else {
            if ($param_email != (trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL)))) {
                $email_err = "Oops! Something went wrong. Please try again later.";
            } else {
                // Prepare a select statement
                $sql = "SELECT customer_id FROM customer WHERE email = :email";

                if ($stmt = $conn->prepare($sql)) {
                    // Bind variables to the prepared statement as parameters
                    $stmt->bindParam(':email', $param_email, PDO::PARAM_STR);

                    // Set parameters
                    $param_email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));

                    // Attempt to execute the prepared statement
                    if ($stmt->execute()) {
                        if ($stmt->rowCount() == 1) {
                            $email_err = "This email is taken!";
                            //  echo "TAKEN!";
                        } else {
                            $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
                        }
                    } else {
                        $email_err = "Oops! Something went wrong. Please try again later.";
                    }
                }
                // Close statement
                unset($stmt);
            }
        }
    }
    // Validate password
    if (empty(trim($_POST['password']))) {
        $password_err = "Choose a password";
    } elseif (strlen(trim($_POST['password'])) < 8) {
        $password_err = "At least 8 characters!";
    } else {
        $password = trim($_POST['password']);
    }

    if (empty($gender_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err) && empty($first_name_err) && empty($last_name_err) && empty($country_err)) {

        // Prepare an insert statement
        $sql = "INSERT INTO customer (email, password, first_name, last_name, country)
                VALUES (:email, :password, :first_name, :last_name, :country)";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(':email', $param_email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $param_password, PDO::PARAM_STR);
            $stmt->bindParam(':first_name', $param_first_name, PDO::PARAM_STR);
            $stmt->bindParam(':last_name', $param_last_name, PDO::PARAM_STR);
            $stmt->bindParam(':country', $param_country, PDO::PARAM_STR);
            // Set parameters
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                //send welcome email
                //  sendWelcomeEmail($param_email);
                // Redirect to login page
                header("Location: /");
            } else {
                header("Location: index.php");
                //echo "Something went wrong. Please try again later.";
            }
        }

        // Close statement
        unset($stmt);
    }

    // Close connection
}    