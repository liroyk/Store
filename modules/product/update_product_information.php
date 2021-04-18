<?php

require_once (__DIR__) . '/../../configs/config.php';
require_once (__DIR__) . '/../../functions/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //  $product_id = trim(filter_input(INPUT_POST, 'product_id', FILTER_SANITIZE_NUMBER_INT));
    //    $price = trim(filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_INT));

    $button = $_POST['button'];
    $product_id = $_POST['product_id'];

    if (isset($_POST['button'])) {
        if ($button == "update_button") {


            $price = $_POST['price'];

            $sql = "UPDATE product SET price = :price WHERE product_id = :product_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            $stmt->bindParam(':price', $price, PDO::PARAM_INT);

            if ($stmt->execute()) {
                echo "ok";

//            $url = '/product_update.php';
//            redirect($url);
            }
        } else if ($button == "delete_button") {
            $sql = "DELETE FROM product WHERE product_id = :product_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            if ($stmt->execute()) {
//                
//                $url = '/product_update.php';
//                redirect($url);
            }
        }
    } else {
        echo "wtf?";
    }
}



    