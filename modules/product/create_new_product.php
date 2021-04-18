<?php

require_once (__DIR__) . '/../../configs/config.php';
require_once (__DIR__) . '/../../functions/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $sql = "INSERT INTO product (category_id, product_name, price)"
            . " VALUES (:category_id, :product_name, :price)";
    $stmt = $conn->prepare($sql);

    $category_id = trim(filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_STRING));
    $product_name = trim(filter_input(INPUT_POST, 'product_name', FILTER_SANITIZE_STRING));
    $price = trim(filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_INT));

    $empty_error = false;
    
    if (empty($category_id) || empty($product_name) || empty($price)) {
        $empty_error = true;        
        echo "Empty";
        exit;
    }

    if (!$empty_error) {
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        $stmt->bindParam(':product_name', $product_name, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $url = '/admin_product_page.php';
            redirect($url);
        }
    }
}
    