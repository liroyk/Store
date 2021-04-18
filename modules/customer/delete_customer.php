<?php

require_once (__DIR__) . '/customer.php';
// Initialize the session
if (!isset($_SESSION)) {
    session_start();
  
}

$customer_id = getCustomerID($conn);
$sql1 = "DELETE FROM customer WHERE customer_id = :customer_id";
$stmt = $conn->prepare($sql1);
$stmt->bindParam(':customer_id', $customer_id, PDO::PARAM_INT);
if ($stmt->execute()) {
    $sql2 = "DELETE FROM transaction WHERE customer_id = :customer_id";
    $stmt = $conn->prepare($sql2);
    $stmt->bindParam(':customer_id', $customer_id, PDO::PARAM_INT);
    if ($stmt->execute()) {
        redirect("/index.php");
    }




//    $url = '/index.php';
//    redirect($url);
// Unset all of the session variables
    $_SESSION = array();

// Destroy the session.
    session_destroy();

// Redirect to login page
    header("location: /");
}
?>