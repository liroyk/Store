<?php

if (!isset($_SESSION)) {
    session_start();
}

require_once (__DIR__) . '/../../configs/config.php';
require_once (__DIR__) . '/../../functions/functions.php';
require_once (__DIR__) . '/customer.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $sql = "INSERT INTO transaction (customer_id, product_name, transaction_price)"
            . " VALUES (:customer_id, :product_name, :transaction_price)";
    $stmt = $conn->prepare($sql);

    $customer_id = getCustomerID($conn);
    $product_id = trim(filter_input(INPUT_POST, 'product_id', FILTER_SANITIZE_NUMBER_INT));
    $transaction_price = trim(filter_input(INPUT_POST, 'transaction_price', FILTER_SANITIZE_NUMBER_INT));

    $product_name = getProductName($product_id, $conn);

    echo $transaction_price;
    $empty_error = false;


    if (!$empty_error) {
        $stmt->bindParam(':customer_id', $customer_id, PDO::PARAM_INT);
        $stmt->bindParam(':product_name', $product_name, PDO::PARAM_STR);
        $stmt->bindParam(':transaction_price', $transaction_price, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $url = '/admin_product_page.php';
            redirect($url);
        }
    }
}
    