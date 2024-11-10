<?php
session_start(); 
include_once "../config.php";
include_once "../model/order.php";
include_once "../model/shop.php";


if (!isset($_SESSION['user_id']) || !isset($_SESSION['username']) || !isset($_SESSION['user_email'])) {
  
    echo json_encode(array("success" => false, "message" => "User not logged in."));
    exit; 
}


$userId = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['shopId']) && isset($_POST['quantity'])) {

    $shopId = $_POST['shopId'];
    $quantity = $_POST['quantity'];

    if (!is_numeric($quantity) || $quantity <= 0) {
        echo json_encode(array("success" => false, "message" => "Invalid input data."));
        exit;
    }

   
    $shop = Shop::getShopById($shopId);
    if ($shop) {
        $shopName = $shop['name'];
        $shopPrice = $shop['price'];

        
        $total = $shopPrice * $quantity;

       
        $order = new Order($shopId, $userId, $shopName, $_SESSION['username'], $_SESSION['user_email'], $quantity,$total);

        // Save order to database
        $success = $order->save();

        if ($success) {
            // Return success message
            echo json_encode(array("success" => true, "message" => "Order placed successfully!"));
        } else {
            // Return error message if order failed to save
            echo json_encode(array("success" => false, "message" => "Failed to place order."));
        }
    } else {
        // Return error message if shop details are not found
        echo json_encode(array("success" => false, "message" => "Shop not found."));
    }
} else {
    // Return error message if required parameters are not provided
    echo json_encode(array("success" => false, "message" => "Invalid request."));
}
?>
