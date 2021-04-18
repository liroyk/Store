<?php

function getProductList($conn) {
    $sql = "SELECT * FROM product";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $products;
}

function getProductListByCategory($conn, $category_name) {
    $category_id = getCategoryId($category_name, $conn);
    $sql = "SELECT * FROM product WHERE category_id = :category_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $products;
}
