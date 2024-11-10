<?php
include_once "../config.php";
include_once "../model/shop.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] === 'delete_shop') {
    $id = $_POST["shopId"];
    $shop = new Shop(null, null, null, $id);
    $success = $shop->delete();

    if ($success) {
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            
            header('Content-Type: application/json');
            echo json_encode(["message" => "Shop deleted successfully!"]);
        } else {
            
            echo "Shop deleted successfully!";
        }
    } else {
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            
            header('Content-Type: application/json');
            echo json_encode(["error" => "Failed to delete shop."]);
        } else {
            
            echo "Failed to delete shop.";
        }
    }
}

?>
