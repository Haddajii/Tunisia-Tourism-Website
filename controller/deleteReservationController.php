<?php
include_once "../config.php";
include_once "../model/reservation.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action']) && $_POST['action'] === 'delete_reservation') {
    $reservationId = $_POST["id"];
    
   
    $result = Reservation::deleteReservation($reservationId);
  
    if ($result["success"]) {
        echo json_encode(["message" => "Reservation deleted successfully"]);
    } else {
        echo json_encode(["message" => "Failed to delete reservation"]);
    }
} else {
    echo json_encode(["message" => "Invalid request"]);
}
?>
