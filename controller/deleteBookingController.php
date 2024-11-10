<?php 
include_once "../config.php";
include_once "../model/booking.php";


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] === 'delete_booking') {
    $id = $_POST["id"];
    $booking = new Booking(null, null, null, null, null,null, $id);
    $success = $booking->delete();

    if ($success) {
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            
            header('Content-Type: application/json');
            echo json_encode(["message" => "Booking deleted successfully!"]);
        } else {
            
            echo "Booking deleted successfully!";
        }
    } else {
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            
            header('Content-Type: application/json');
            echo json_encode(["error" => "Failed to delete booking."]);
        } else {
            
            echo "Failed to delete booking.";
        }
    }
}

?>