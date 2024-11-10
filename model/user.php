<?php
include_once '../config.php';

class User {
    private $pdo;
    private $maxAttempts = 10; 
    public function __construct() {
        
        $this->pdo = config::getConnexion();
    }

    public function login($email, $password) {
        $stmt = $this->pdo->prepare("SELECT id, username, photo, email, password, role FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) {
            unset($user['password']);
            return $user;
        }
        return false;
    }

    public function addAdmin($username, $email, $password, $photo) {
        try {
            $id = $this->generateUniqueID();
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
            $stmt = $this->pdo->prepare("INSERT INTO users (id, username, email, password, photo,role) VALUES (?,?, ?, ?,?, 1)");
            return $stmt->execute([$id,$username, $email, $hashedPassword,$photo]);
    
            return true;
        } catch (PDOException $e) {
          
            error_log("Error adding admin: " . $e->getMessage());
            return false;
        }
    }
    public static function getLastThreeUsers($pdo) {
        try {
            // Prepare the SQL query to fetch the last three users
            $stmt = $pdo->prepare("SELECT * FROM users ORDER BY id DESC LIMIT 3");
            $stmt->execute();
            
            // Fetch the results
            $lastThreeUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $lastThreeUsers;
        } catch (PDOException $e) {
            // Handle any errors
            error_log("Error fetching last three users: " . $e->getMessage());
            return false; // Return false to indicate an error
        }
    }
    
    
    

    public function register($name, $email, $password, $photo) {
        
        $id = $this->generateUniqueID();
        
        
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
       
        $stmt = $this->pdo->prepare("INSERT INTO users (id, username, email, password, photo) VALUES (?, ?, ?, ?, ?)");
        
        
        return $stmt->execute([$id, $name, $email, $hashedPassword, $photo]);
    }

    private function generateUniqueID() {
      
        $suffix = bin2hex(random_bytes(8));

       
        $id = uniqid('', true) . $suffix;

        
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $count = $stmt->fetchColumn();
        
       
        $attempts = 1;
        while ($count > 0 && $attempts < $this->maxAttempts) {
            $id = uniqid('', true) . bin2hex(random_bytes(8));
            $stmt->execute([$id]);
            $count = $stmt->fetchColumn();
            $attempts++;
        }

       
        if ($count > 0) {
            throw new Exception("Failed to generate a unique ID after {$this->maxAttempts} attempts.");
        }
        
        
        return $id;
    }

    public function getUserByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateUser($userId, $username, $email, $photo) {
        try {
            $pdo = $this->pdo;
            $stmt = $pdo->prepare("UPDATE users SET username = COALESCE(?, username), email = COALESCE(?, email), photo = COALESCE(?, photo) WHERE id = ?");
            $stmt->execute([$username, $email, $photo, $userId]);
            return true;
        } catch (PDOException $e) {
            // Handle exception
            return false;
        }
    }
    public static function getAllUsers() {
        try {
            $pdo = config::getConnexion();
            $stmt = $pdo->query("SELECT * FROM users");
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $users;
        } catch (PDOException $e) {
            return [];
        }
    }

}

    


?>
