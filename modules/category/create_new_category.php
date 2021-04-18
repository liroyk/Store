<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require_once (__DIR__) . '/../../configs/config.php';
require_once (__DIR__) . '/../../functions/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    echo "ok";
    $sql = "INSERT INTO category (category_name) VALUES (:category_name)";
    $stmt = $conn->prepare($sql);

    $category_name = trim(filter_input(INPUT_POST, 'category_name', FILTER_SANITIZE_STRING));
    echo $category_name;
    $empty_error = false;

    if (empty($category_name)) {
        $empty_error = true;
        echo $empty_error;
        echo "Empty";
        exit;
    }
    echo "here";
    echo $empty_error;
    
    if (!$empty_error) {
        echo "Hi";
        
        $stmt->bindParam(':category_name', $category_name, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $url = '/admin_category_page.php';
            redirect($url);
        }
    } else {
       echo "why im here?";
    }
}
    