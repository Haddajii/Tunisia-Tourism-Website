<?php
session_start();

include_once "../config.php";
include_once "../model/User.php";

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    // Check if the request is sent via Ajax
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateUsername']) && isset($_POST['updateEmail'])) {
        $pdo = config::getConnexion();
        $userModel = new User($pdo);

        // Get form data
        $username = $_POST['updateUsername'];
        $email = $_POST['updateEmail'];

        // Check if photo is uploaded
        $photo = null;
        if (isset($_FILES['updatePhoto']) && $_FILES['updatePhoto']['size'] > 0) {
            // Generate a unique filename for the photo
            $photo = uniqid() . '_' . $_FILES['updatePhoto']['name'];
            // Move uploaded photo to desired location
            move_uploaded_file($_FILES['updatePhoto']['tmp_name'], "../uploads/" . $photo);
        }

        // Update user information
        $success = $userModel->updateUser($userId, $username, $email, $photo);

        // Send response based on update success
        if ($success) {
            $response = array(
                "success" => true,
                "message" => "User information updated successfully."
            );
        } else {
            $response = array(
                "success" => false,
                "message" => "Failed to update user information."
            );
        }

        echo json_encode($response);
    } else {
        // Handle invalid request
        $response = array(
            "success" => false,
            "message" => "Invalid request."
        );
        echo json_encode($response);
    }
} else {
    // Handle unauthorized access
    $response = array(
        "success" => false,
        "message" => "User is not logged in."
    );
    echo json_encode($response);
}
?>
