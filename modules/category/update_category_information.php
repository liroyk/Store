<?php

require_once (__DIR__) . '/../../configs/config.php';
require_once (__DIR__) . '/../../functions/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {



    $button = $_POST['button'];
    $category_id = $_POST['category_id'];

    if (isset($_POST['button'])) {
        if ($button == "update_button") {


            $category_name = $_POST['category_name'];

            $sql = "UPDATE category SET category_name = :category_name WHERE category_id = :category_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
            $stmt->bindParam(':category_name', $category_name, PDO::PARAM_STR);

            if ($stmt->execute()) {
                echo "Updated";
            }
        } else if ($button == "delete_button") {



            $sql1 = "DELETE FROM category WHERE category_id = :category_id";
            $stmt = $conn->prepare($sql1);
            $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
            if ($stmt->execute()) {

                $sql2 = "DELETE FROM product WHERE category_id = :category_id";
                $stmt = $conn->prepare($sql2);
                $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
                if ($stmt->execute()) {
                    echo "Deleted Category Products";
                }
            }
        }
    } else {
        echo "Error?";
    }
}



    