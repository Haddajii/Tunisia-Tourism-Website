<?php
include_once "../config.php";

class Comment {
    private $id;
    private $postId;
    private $userId;
    private $commentText;
    private $dateCreated;

    public function __construct($postId, $userId, $commentText, $id = null) {
        $this->id = $id ?? $this->generateUniqueId();
        $this->postId = $postId;
        $this->userId = $userId;
        $this->commentText = $commentText;
        $this->dateCreated = date('Y-m-d H:i:s');
    }

    public function getId() {
        return $this->id;
    }

    public function getPostId() {
        return $this->postId;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getCommentText() {
        return $this->commentText;
    }

    public function getDateCreated() {
        return $this->dateCreated;
    }

    public function save() {
        try {
            $pdo = config::getConnexion();
            $stmt = $pdo->prepare("INSERT INTO commments (id, postId, userId, commentText, dateCreated) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$this->id, $this->postId, $this->userId, $this->commentText, $this->dateCreated]);
            
            return true;
        } catch (PDOException $e) {
            // Return JSON response with error message
            header('Content-Type: application/json');
            echo json_encode(["success" => false, "message" => "Error: " . $e->getMessage()]);
            exit(); // Terminate script execution after sending the response
        }
    }
    
    
    

    private function generateUniqueId() {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 4);
    }

    public static function getUsernameByUserId($userId) {
        try {
            $pdo = config::getConnexion();
            $stmt = $pdo->prepare("SELECT username FROM users WHERE id = ?");
            $stmt->execute([$userId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['username'] ?? null;
        } catch (PDOException $e) {
            return null;
        }
    }

    
    public static function getUserPhotoByUserId($userId) {
        try {
            $pdo = config::getConnexion();
            $stmt = $pdo->prepare("SELECT photo FROM users WHERE id = ?");
            $stmt->execute([$userId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['photo'] ?? null;
        } catch (PDOException $e) {
            return null;
        }
    }

   
    public static function getCommentsByPostId($postId) {
        try {
          $pdo = config::getConnexion();
          $stmt = $pdo->prepare("SELECT * FROM comments WHERE postId = ?");
          $stmt->execute([$postId]);
          $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
          return $comments;
        } catch (PDOException $e) {
          
          error_log("Error retrieving comments: " . $e->getMessage());
          return null;  
        }
      }
      
}
?>
