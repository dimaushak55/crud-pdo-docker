<?php
require_once 'Database.php';

class ProductDAO {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = Database::connect();
    }

    public function create($name, $price) {
        $stmt = $this->pdo->prepare(
            "INSERT INTO product (name, price)
             VALUES (:name, :price)"
        );
        $stmt->execute([
            ':name' => $name,
            ':price' => $price
        ]);
    }

    public function getAll() {
        return $this->pdo->query(
            "SELECT * FROM product ORDER BY id DESC"
        )->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM product WHERE id = :id"
        );
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function update($id, $name, $price) {
        $stmt = $this->pdo->prepare(
            "UPDATE product
             SET name = :name, price = :price
             WHERE id = :id"
        );
        $stmt->execute([
            ':id' => $id,
            ':name' => $name,
            ':price' => $price
        ]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare(
            "DELETE FROM product WHERE id = :id"
        );
        $stmt->execute([':id' => $id]);
    }

    public function hasOrders($id) {
    $stmt = $this->pdo->prepare(
        "SELECT COUNT(*) FROM `order` WHERE product_id = :id"
    );
    $stmt->execute([':id' => $id]);
    return $stmt->fetchColumn() > 0;
    }
}