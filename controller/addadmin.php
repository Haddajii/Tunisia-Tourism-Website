<?php
session_start();
include_once "../config.php";
include_once "../model/user.php";
$pdo = config::getConnexion();
$userModel = new User($pdo);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if the form fields are set
    if (isset($_POST['adminUsername']) && isset($_POST['adminEmail']) && isset($_POST['adminPassword']) && isset($_FILES['adminPhoto'])) {
        // Retrieve form data
        $username = $_POST['adminUsername'];
        $email = $_POST['adminEmail'];
        $password = $_POST['adminPassword'];
        $photo = $_FILES['adminPhoto'];

        // Move uploaded photo to the desired location
        $photoPath = '../uploads/' . $photo['name'];
        move_uploaded_file($photo['tmp_name'], $photoPath);

        // Add admin user
      
        $added = $userModel->addAdmin($username, $email, $password, $photoPath);
        
        // Prepare response
        $response = [
            'success' => $added,
            'message' => $added ? 'Admin added successfully!' : 'Failed to add admin.'
        ];

        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        // If any of the form fields are missing, return an error response
        $response = [
            'success' => false,
            'message' => 'Please fill in all the required fields.'
        ];

        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
    }
} else {
    // If the request method is not POST, return an error response
    $response = [
        'success' => false,
        'message' => 'Invalid request method.'
    ];

    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
