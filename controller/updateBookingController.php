<?php

include_once "../config.php";
include_once "../model/booking.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] === 'update_booking') {
    $id = $_POST["id"];
   
    $existingBooking = Booking::getBookingById($id);

    if ($existingBooking) {
        
        $name = isset($_POST["name"]) ? $_POST["name"] : $existingBooking['name'];
        $description = isset($_POST["description"]) ? $_POST["description"] : $existingBooking['description'];
        $price = isset($_POST["price"]) ? $_POST["price"] : $existingBooking['price'];
        $date = isset($_POST["date"]) ? $_POST["date"] : $existingBooking['date'];
        $photo = isset($_FILES["photo"]["name"]) ? $_FILES["photo"]["name"] : $existingBooking['photo'];
        $number = isset($_POST["number"]) ? $_POST["number"] : $existingBooking['number']; 

       
        $updatedBooking = new Booking($name, $description, $price, $date, $photo, $number, $id); 
        $success = $updatedBooking->update();

        if ($success) {
           
            if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                
                header('Content-Type: application/json');
                echo json_encode(["message" => "Booking updated successfully!"]);
            } else {
                
                echo "Booking updated successfully!";
            }
        } else {
           
            if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                
                header('Content-Type: application/json');
                echo json_encode(["error" => "Failed to update booking."]);
            } else {
                
                echo "Failed to update booking.";
            }
        }
    } else {
      
      
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
           
            header('Content-Type: application/json');
            echo json_encode(["error" => "Booking not found."]);
        } else {
            
            echo "Booking not found.";
        }
    }
}

?>
