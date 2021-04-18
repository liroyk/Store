<?php

require_once (__DIR__) . '/../../configs/config.php';
require_once (__DIR__) . '/../../functions/functions.php';
require_once (__DIR__) . '/customer.php';

$customer_id = getCustomerID($conn);

$first_name_err = $last_name_err = "";
$param_first_name = $param_last_name = "";
$empty_fname = $empty_lname = false;
// Processing form data when form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate first name
    if (empty(filter_input(INPUT_POST, 'first_name'))) {
        $first_name_err="Empty";
        $param_first_name = null;
        $empty_fname = true;

    } else {
        $param_first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);
    }
// Validate last name
    if (empty(filter_input(INPUT_POST, 'last_name'))) {
        $last_name_err="Empty";
        $param_last_name = null;
        $empty_lname = true;

    } else {
        $param_last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);
    }

///([\p{L}]+)/u
    if (!$empty_fname && !preg_match("/^(\p{L}+)$/u", $param_first_name)) {
        $first_name_err = "Only alphabetical letters allowed";
    }
    if (!$empty_lname && !preg_match("/^(\p{L}+)$/u", $param_last_name)) {
        $last_name_err = "Only alphabetical letters allowed";
    }
    if (empty($first_name_err) && empty($last_name_err)) {

        // Prepare an insert statement
        $sql = '
            UPDATE customer 
            SET 
            first_name = :first_name, 
            last_name = :last_name           
            WHERE customer_id = :customer_id
            ';

        $stmt = $conn->prepare($sql);
        if ($stmt) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(':customer_id', $customer_id, PDO::PARAM_STR);
            $stmt->bindParam(':first_name', $param_first_name, PDO::PARAM_STR);
            $stmt->bindParam(':last_name', $param_last_name, PDO::PARAM_STR);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                redirect("/account_settings.php");
                exit;
            } else {
                echo "Something went wrong. Please try again later.";
            }
        }

        // Close statement
        unset($stmt);
    } else {
        
    }
}


    