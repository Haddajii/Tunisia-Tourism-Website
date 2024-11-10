<?php

include_once "../config.php";

class Reservation {
    private $id;
    private $userId;
    private $userName;
    private $userEmail;
    private $bookingId;
    
    public function __construct($userId, $userName, $userEmail, $bookingId) {
        $this->id = $this->generateUniqueID(); 
        $this->userId = $userId;
        $this->userName = $userName;
        $this->userEmail = $userEmail;
        $this->bookingId = $bookingId;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getUserId() {
        return $this->userId;
    }
    
    public function setUserId($userId) {
        $this->userId = $userId;
    }
    
    public function getUserName() {
        return $this->userName;
    }
    
    public function setUserName($userName) {
        $this->userName = $userName;
    }
    
    public function getUserEmail() {
        return $this->userEmail;
    }
    
    public function setUserEmail($userEmail) {
        $this->userEmail = $userEmail;
    }
    
    public function getBookingId() {
        return $this->bookingId;
    }
    
    public function setBookingId($bookingId) {
        $this->bookingId = $bookingId;
    }
    
    
    private function generateUniqueID() {
        $id = str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);

       
        $pdo = config::getConnexion();
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM reservation WHERE id = ?");
        $stmt->execute([$id]);
        $count = $stmt->fetchColumn();
        
        
        while ($count > 0) {
            $id = str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
            $stmt->execute([$id]);
            $count = $stmt->fetchColumn();
        }

        
        return $id;
    }
    public static function getLastThreeReservations() {
        try {
            $pdo = config::getConnexion();
            $stmt = $pdo->prepare("SELECT * FROM reservation ORDER BY id DESC LIMIT 3");
            $stmt->execute();
            $lastThreeReservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $lastThreeReservations;
        } catch (PDOException $e) {
            error_log("Error fetching last three reservations: " . $e->getMessage());
            return [];
        }
    }
    
    
    public function save() {
        
        $pdo = config::getConnexion();
        
       
        $stmt = $pdo->prepare("INSERT INTO reservation (id, userId, userName, userEmail, bookingId) VALUES (?, ?, ?, ?, ?)");
        
       
        $result = $stmt->execute([$this->id, $this->userId, $this->userName, $this->userEmail, $this->bookingId]);
        
        return $result; 
    }

    public static function deleteReservation($reservationId) {
        try {
           
            $pdo = config::getConnexion();
            $stmt = $pdo->prepare("DELETE FROM reservation WHERE id = ?");
            $stmt->execute([$reservationId]);
    
            return ["success" => true, "message" => "Reservation deleted successfully"];
        } catch (PDOException $e) {
            
            return ["success" => false, "message" => "Failed to delete reservation"];
        }
    }

    public static function getAllReservations() {
        try {
            $pdo = config::getConnexion();
            $stmt = $pdo->query("SELECT * FROM reservation");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function getReservationByUserId($userId) {
        try {
            $pdo = config::getConnexion();
            $stmt = $pdo->prepare("SELECT * FROM reservation WHERE userId = ?");
            $stmt->execute([$userId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function getReservationByUserIdAndBookingId($userId, $bookingId) {
        try {
            $pdo = config::getConnexion();
            $stmt = $pdo->prepare("SELECT * FROM reservation WHERE userId = ? AND bookingId = ?");
            $stmt->execute([$userId, $bookingId]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>
