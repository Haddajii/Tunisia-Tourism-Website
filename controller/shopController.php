<?php
include_once "../config.php";
include_once "../model/shop.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form data
    $name = $_POST['shopName'];
    $price = $_POST['shopPrice'];
    $photo = $_FILES['shopPhoto']['name']; // Assuming file input name is 'shopPhoto'

    // Upload photo to server directory
    $targetDirectory = "../uploads/";
    $targetFilePath = $targetDirectory . basename($photo);
    move_uploaded_file($_FILES['shopPhoto']['tmp_name'], $targetFilePath);

    // Create new Shop object
    $shop = new Shop($name, $price, $photo);

    // Attempt to save shop to database
    if ($shop->save()) {
        // Shop added successfully
        $response = array("success" => true, "message" => "Shop added successfully.");
    } else {
        // Failed to add shop
        $response = array("success" => false, "message" => "Failed to add shop.");
    }

    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
