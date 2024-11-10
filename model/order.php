<?php
include_once "../config.php";

class Order {
    private $id;
    private $shopId;
    private $userId;
    private $shopName;
    private $userName;
    private $userEmail;
    private $quantity ;
    private $total;

    public function __construct($shopId, $userId, $shopName, $userName, $userEmail, $quantity,$total) {
        $this->id =  $this->generateUniqueId();
        $this->shopId = $shopId;
        $this->userId = $userId;
        $this->shopName = $shopName;
        $this->userName = $userName;
        $this->userEmail = $userEmail;
        $this->quantity = $quantity ;
        $this->total = $total;
    }

    public function getId() {
        return $this->id;
    }

    public function getShopId() {
        return $this->shopId;
    }

    public function setShopId($shopId) {
        $this->shopId = $shopId;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function getShopName() {
        return $this->shopName;
    }

    public function setShopName($shopName) {
        $this->shopName = $shopName;
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
    public function getquantity() {
        return $this->quantity;
    }
    public function setquantity() {
        $this->quantity = $quantity;
    }

    public function getTotal() {
        return $this->total;
    }

    public function setTotal($total) {
        $this->total = $total;
    }

    public function save() {
        try {
            $pdo = config::getConnexion();
            $stmt = $pdo->prepare("INSERT INTO orders (id, shopId, userId, shopName, userName, userEmail, quantity,total) VALUES (?, ?, ?, ?, ?, ?, ?,?)");
            $result = $stmt->execute([$this->id, $this->shopId, $this->userId, $this->shopName, $this->userName, $this->userEmail,$this->quantity ,$this->total]);
            return $result;
        } catch (PDOException $e) {
            
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    

    public static function getAllOrders() {
        try {
            $pdo = config::getConnexion();
            $stmt = $pdo->query("SELECT * FROM orders");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function getOrderById($id) {
        try {
            $pdo = config::getConnexion();
            $stmt = $pdo->prepare("SELECT * FROM orders WHERE id = :id");
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $order = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($order) {
                return $order;
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
            $stmt = $pdo->prepare("DELETE FROM orders WHERE id = ?");
            $stmt->execute([$this->id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    public static function getShopPhotoByShopId($shopId) {
        try {
            $pdo = config::getConnexion();
            $stmt = $pdo->prepare("SELECT photo FROM shops WHERE id = :id");
            $stmt->bindValue(':id', $shopId, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['photo'];
        } catch (PDOException $e) {
            return null;
        }
    }
    public static function getShopById($shopId) {
        try {
            $pdo = config::getConnexion();
            $stmt = $pdo->prepare("SELECT * FROM shops WHERE id = :id");
            $stmt->bindValue(':id', $shopId, PDO::PARAM_INT);
            $stmt->execute();
            $shop = $stmt->fetch(PDO::FETCH_ASSOC);
            return $shop;
        } catch (PDOException $e) {
            return null;
        }
    }

    public static function getOrdersByUserId($userId) {
        try {
            $pdo = config::getConnexion();
            $stmt = $pdo->prepare("SELECT * FROM orders WHERE userId = :userId");
            $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }
    private function generateUniqueId() {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 4);
    }
}
?>
