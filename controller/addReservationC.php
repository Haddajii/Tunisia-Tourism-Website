<?php
include_once "../config.php";
session_start(); 
include_once "../model/reservation.php";
include_once "../model/booking.php" ;

function isLoggedIn() {
    return isset($_SESSION['user_id']); 
}


if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    if(isLoggedIn()) {
        
        $userId = $_SESSION['user_id']; 
        
        
        if(isset($_POST['bookingId'])) {
            $bookingId = $_POST['bookingId'];
            
            
            $pdo = config::getConnexion();
            $stmt = $pdo->prepare("SELECT username, email FROM users WHERE id = ?");
            $stmt->execute([$userId]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if($user) {
            
                $userName = $user['username'];
                $userEmail = $user['email'];
                
                
                
                $existingReservation = Reservation::getReservationByUserIdAndBookingId($userId, $bookingId);
                if ($existingReservation) {
                    echo json_encode(array('success' => false, 'message' => 'You have already made a reservation for this booking.'));
                    exit();
                }
                
                
                $reservation = new Reservation($userId, $userName, $userEmail, $bookingId);
                
               
                $result = $reservation->save();
                
               
                if($result) {
                   
                    $booking = Booking::getBookingById($bookingId);
                    if ($booking) {
                        $booking = new Booking($booking['name'], $booking['description'], $booking['price'], $booking['date'], $booking['photo'], $booking['number'], $bookingId);
                        if ($booking->updateSlots(true)) {
                            
                            echo json_encode(array('success' => true, 'message' => 'Reservation successful!'));
                        } else {
                           
                            echo json_encode(array('success' => false, 'message' => 'Failed to update booking slots.'));
                        }
                    } else {
                        
                        echo json_encode(array('success' => false, 'message' => 'Booking details not found.'));
                    }
                } else {
                    
                    echo json_encode(array('success' => false, 'message' => 'Reservation failed.'));
                }
            } else {
                
                echo json_encode(array('success' => false, 'message' => 'User details not found.'));
            }
        } else {
           
            echo json_encode(array('success' => false, 'message' => 'Booking ID is missing.'));
        }
    } else {
       
        echo json_encode(array('success' => false, 'message' => 'You are not logged in.'));
    }
} else {
    
    exit();
}

?>
