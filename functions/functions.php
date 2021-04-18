<?php

require_once (__DIR__) . '/../configs/config.php';

//function that redirects to another page to avoid headers issues
function redirect($url) {
    $string = '<script type="text/javascript">';
    $string .= 'window.location = "' . $url . '"';
    $string .= '</script>';
    echo $string;
}

function getCategoryName($category_id, $conn) {
    $sql = "SELECT category_name FROM category WHERE category_id = :category_id";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch();
        $category_name = $row['category_name'];
        
        return $category_name;
    }
}

function getCategoryId($category_name, $conn) {
    $sql = "SELECT category_id FROM category WHERE category_name = :category_name";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bindParam(':category_name', $category_name, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);       
        $category_id = $row['category_id'];
       
        return $category_id;
    }
}

function getProductName($product_id, $conn) {
    $sql = "SELECT product_name FROM product WHERE product_id = :product_id";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);       
        $product_name = $row['product_name'];
       
        return $product_name;
    }
}

function getAdminID($conn) {
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
        $sql = "SELECT admin_id FROM admin WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $admin_id = $stmt->fetch();
        return $admin_id['admin_id'];
    } else {
        unset($_SESSION['email']);
    }
}