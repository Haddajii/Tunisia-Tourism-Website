<?php

include_once "../config.php";

class Booking {
    private $id;
    private $name;
    private $description;
    private $price;
    private $date;
    private $photo;
    private $number ;

    public function __construct($name, $description, $price, $date, $photo,$number, $id = null) {
        $this->id = $id ?? $this->generateUniqueId();
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->date = $date;
        $this->photo = $photo;
        $this->number = $number ; 
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function getPhoto() {
        return $this->photo;
    }

    public function setPhoto($photo) {
        $this->photo = $photo;
    }
    public function getNumber($number){
        return  $this->number = $number ; 
    }
    public function setNumber($number){
        $this->number = $number ;
    }
    

    public function save() {
        try {
            $pdo = config::getConnexion();
            $stmt = $pdo->prepare("INSERT INTO bookings (id, name, description, price, date, photo,number) VALUES (?, ?, ?, ?, ?, ?,?)");
            $stmt->execute([$this->id, $this->name, $this->description, $this->price, $this->date, $this->photo,$this->number]);
            return true; 
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function getAllBookings() {
        try {
            $pdo = config::getConnexion();
            $stmt = $pdo->query("SELECT * FROM bookings");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function getBookingById($id) {
        try {
            $pdo = config::getConnexion();
    
             $stmt = $pdo->prepare("SELECT * FROM bookings WHERE id = :id");
    
             $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    
            
            $stmt->execute();
    
            
            $booking = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($booking) {
                return $booking;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            
            return null;
        }
    }

    


    public function delete() {
        try {
            $pdo = config::getConnexion();
            $stmt = $pdo->prepare("DELETE FROM bookings WHERE id = ?");
            $stmt->execute([$this->id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function update() {
        try {
            $pdo = config::getConnexion();
            $stmt = $pdo->prepare("UPDATE bookings SET name = ?, description = ?, price = ?, date = ?, photo = ? , number = ? WHERE id = ?");
            $stmt->execute([$this->name, $this->description, $this->price, $this->date, $this->photo,$this->number, $this->id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function updateSlots($decrement = false) {
        try {
            $pdo = config::getConnexion();
            if ($decrement) {
               
                $stmt = $pdo->prepare("UPDATE bookings SET number = number - 1 WHERE id = ?");
                $stmt->execute([$this->id]);
    
               
                $stmt = $pdo->prepare("SELECT number FROM bookings WHERE id = ?");
                $stmt->execute([$this->id]);
                $number = $stmt->fetchColumn();
               // if ($number === 0) {
                 //   $this->delete();
                   // return false; 
                //}
            } else {
                
                $stmt = $pdo->prepare("UPDATE bookings SET number = number + 1 WHERE id = ?");
                $stmt->execute([$this->id]);
            }
            return true; 
        } catch (PDOException $e) {
            return false; 
        }
    }
    
    

    private function generateUniqueId() {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 4);
    }
}

?>
