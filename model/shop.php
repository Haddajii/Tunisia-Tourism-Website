<?php
include_once "../config.php";

class Shop {
    private $id;
    private $name;
    private $price;
    private $photo;

    public function __construct($name, $price, $photo, $id = null) {
        $this->id = $id ?? $this->generateUniqueId();
        $this->name = $name;
        $this->price = $price;
        $this->photo = $photo;
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

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function getPhoto() {
        return $this->photo;
    }

    public function setPhoto($photo) {
        $this->photo = $photo;
    }

    public function save() {
        try {
            $pdo = config::getConnexion();
            $stmt = $pdo->prepare("INSERT INTO shop (id, name, price, photo) VALUES (?, ?, ?, ?)");
            $stmt->execute([$this->id, $this->name, $this->price, $this->photo]);
            return true; 
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function getAllShops() {
        try {
            $pdo = config::getConnexion();
            $stmt = $pdo->query("SELECT * FROM shop");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function getShopById($id) {
        try {
            $pdo = config::getConnexion();
            $stmt = $pdo->prepare("SELECT * FROM shop WHERE id = :id");
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $shop = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($shop) {
                return $shop;
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
            $stmt = $pdo->prepare("DELETE FROM shop WHERE id = ?");
            $stmt->execute([$this->id]);
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
