<?php

include_once "../config.php";
include_once "../model/booking.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $date = $_POST["date"];
    $photo = $_FILES["photo"]["name"];
    $number = $_POST["number"]; // Add number from form

    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $extensions_arr = array("jpg", "png");
    
    if (in_array($imageFileType, $extensions_arr)) {
        // Create a new booking object with number
        $booking = new Booking($name, $description, $price, $date, $photo, $number);
        $success = $booking->save();
        move_uploaded_file($_FILES['photo']['tmp_name'], $target_file);

        if ($success) {
            if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                header('Content-Type: application/json');
                echo json_encode(["message" => "Booking added successfully!"]);
            } else {
                header("Location: ../view/dashboard.php");
                exit();
            }
        } else {
            if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                header('Content-Type: application/json');
                echo json_encode(["error" => "Failed to add booking."]);
            } else {
                echo "Failed to add booking.";
            }
        }
    } else {
        echo "Invalid file type. Allowed types: jpg, png";
    }
}

?>
