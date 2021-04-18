<?php

if (!isset($_SESSION)) {
    session_start();
}
require_once (__DIR__) . '/../../configs/config.php';
require_once (__DIR__) . '/../../functions/functions.php';

function getCustomerFirstName($conn) {
    $customer_id = getCustomerID($conn);
    $sql = "SELECT first_name FROM customer WHERE customer_id = :customer_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':customer_id', $customer_id, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['first_name'];
}

function getCustomerLastName($conn) {
    $customer_id = getCustomerID($conn);
    $sql = "SELECT last_name FROM customer WHERE customer_id = :customer_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':customer_id', $customer_id, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['last_name'];
}

function getCustomerID($conn) {
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
        $sql = "SELECT customer_id FROM customer WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $customer_id = $stmt->fetch();
        return $customer_id['customer_id'];
    } else {
        unset($_SESSION['email']);
    }
}

function getTransactionsHistoryByCustomer($conn) {
    $customer_id = getCustomerID($conn);
    $sql = "SELECT * FROM transaction WHERE customer_id = :customer_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':customer_id', $customer_id, PDO::PARAM_STR);
    $stmt->execute();
    $transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $transactions;
}

function getFullTransactionsHistory($conn) {    
    $sql = "SELECT * FROM transaction";
    $stmt = $conn->prepare($sql);    
    $stmt->execute();
    $transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $transactions;
}


function getTransactionsTotalByCustomer($conn) {
    $customer_id = getCustomerID($conn);
    $sql = "SELECT transaction_price FROM transaction WHERE customer_id = :customer_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':customer_id', $customer_id, PDO::PARAM_STR);
    $stmt->execute();

    $transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $total = 0;
    foreach ($transactions as $row) {
        $total = $total + (int) $row['transaction_price'];
    }
    return $total;
}

function getTransactionsTotal($conn) {    
    $sql = "SELECT transaction_price FROM transaction";
    $stmt = $conn->prepare($sql);
    
    $stmt->execute();

    $transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $total = 0;
    foreach ($transactions as $row) {
        $total = $total + (int) $row['transaction_price'];
    }
    return $total;
}

