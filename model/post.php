<?php

include_once "../config.php";

class Post {
    private $id;
    private $userId;
    private $text;
    private $date;
    private $likes;
    private $dislikes;

    public function __construct($userId, $text, $id = null) {
        $this->id = $id ?? $this->generateUniqueId();
        $this->userId = $userId;
        $this->text = $text;
        $this->date = date('Y-m-d H:i:s');
        $this->likes = 0;
        $this->dislikes = 0;
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

    public function getText() {
        return $this->text;
    }

    public function setText($text) {
        $this->text = $text;
    }

    public function getDate() {
        return $this->date;
    }

    public function getLikes() {
        return $this->likes;
    }

    public function setLikes($likes) {
        $this->likes = $likes;
    }

    public function getDislikes() {
        return $this->dislikes;
    }

    public function setDislikes($dislikes) {
        $this->dislikes = $dislikes;
    }

    public function save() {
        try {
            $pdo = config::getConnexion();
            $stmt = $pdo->prepare("INSERT INTO posts (id, text, date, likes, dislikes, userId) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$this->id, $this->text, $this->date, $this->likes, $this->dislikes, $this->userId]);
            
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    public function deletePost($postId) {
        try {
            $pdo = config::getConnexion();
            $stmt = $pdo->prepare("DELETE FROM posts WHERE id = ?");
            $stmt->execute([$postId]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    

    public static function getAllPosts() {
        try {
            $pdo = config::getConnexion();
            $stmt = $pdo->query("SELECT * FROM posts ORDER BY date DESC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function likePost() {
        try {
            $pdo = config::getConnexion();
            $stmt = $pdo->prepare("UPDATE posts SET likes = likes + 1 WHERE id = ?");
            $stmt->execute([$this->id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function dislikePost() {
        try {
            $pdo = config::getConnexion();
            $stmt = $pdo->prepare("UPDATE posts SET dislikes = dislikes + 1 WHERE id = ?");
            $stmt->execute([$this->id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    private function generateUniqueId() {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 4);
    }

    public function getUsername() {
        try {
            $pdo = config::getConnexion();
            $stmt = $pdo->prepare("SELECT username FROM users WHERE id = ?");
            $stmt->execute([$this->userId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $result['username'] : 'Unknown'; // Return 'Unknown' if user not found
        } catch (PDOException $e) {
            return 'Unknown'; // Return 'Unknown' if an error occurs
        }
    }
    
    public function getUserPhoto() {
        try {
            $pdo = config::getConnexion();
            $stmt = $pdo->prepare("SELECT photo FROM users WHERE id = ?");
            $stmt->execute([$this->userId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['photo'];
        } catch (PDOException $e) {
            return null;
        }
    }
    
}

?>
