<?php

require_once (__DIR__) . '/../configs/config.php';

// Define variables and initialize with empty values
$email = $password = "";
$login_err = $email_err = $password_err = "";

// Processing form data when form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    // Check if email is empty
    if (empty(trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL)))) {
        $email_err = 'Enter email';
    } else {
        $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
    }


    // Check if password is empty
    if (empty(trim($_POST['password']))) {
        $password_err = 'Password can\'t be empty';
    } else {
        $password = trim($_POST['password']);

    }

    // Validate credentials
    if (empty($email_err) && empty($password_err)) {

        // Prepare a select statement
        $sql = "SELECT email, password FROM admin WHERE email = :email";

        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(':email', $param_email, PDO::PARAM_STR);

            // Set parameters
            $param_email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
            try {
                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    // Check if email exists, if yes then verify password
                    if ($stmt->rowCount() == 1) {
                        if ($row = $stmt->fetch()) {
                            $hashed_password = $row['password'];
                            if (password_verify($password, $hashed_password)) {
                                /* Password is correct, so start a new session and
                                  save the email to the session */
                                session_start();
                                $_SESSION['email'] = $email;
                                $_SESSION['is_admin'] = true;
                                header("location: /");
                            } else {
                                // Display an error message if password is not valid
                                $login_err = 'Wrong email and password combination';
                            }
                        }
                    } else {
                        // Display an error message if email doesn't exist
                        $login_err = 'Wrong email and password combination';
                    }
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }

        // Close statement
        unset($stmt);
    } else {
        echo $email_err . "<br/>" . $password_err;
        exit;
    }

    // Close connection
}
