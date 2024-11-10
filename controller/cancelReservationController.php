<?php
include_once "../config.php";
include_once "../model/reservation.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['bookingId'])) {
    $bookingId = $_POST["bookingId"];
    
   
    session_start();
    $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    
  
    if ($userId) {
        
        $reservation = Reservation::getReservationByUserIdAndBookingId($userId, $bookingId);
        if ($reservation) {
           
            $result = Reservation::deleteReservation($reservation['id']);
            if ($result["success"]) {
                echo json_encode(["success" => true, "message" => "Reservation deleted successfully"]);
            } else {
                echo json_encode(["success" => false, "message" => "Failed to delete reservation"]);
            }
        } else {
           
            echo json_encode(["success" => false, "message" => "No reservation found"]);
        }
    } else {
       
        echo json_encode(["success" => false, "message" => "User not logged in"]);
    }
} else {
    
    echo json_encode(["success" => false, "message" => "Invalid request"]);
}
?>
