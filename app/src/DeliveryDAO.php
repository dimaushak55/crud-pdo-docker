<?php
require_once 'Database.php';

class DeliveryDAO {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = Database::connect();
    }

    public function create($order_id, $date, $product_number) {
        $stmt = $this->pdo->prepare(
            "INSERT INTO delivery (order_id, date, product_number)
             VALUES (:order_id, :date, :product_number)"
        );
        $stmt->execute([
            ':order_id' => $order_id,
            ':date' => $date,
            ':product_number' => $product_number
        ]);
    }

    public function getAll() {
        return $this->pdo->query(
            "SELECT d.*, o.contract_number
             FROM delivery d
             JOIN `order` o ON d.order_id = o.id
             ORDER BY d.id DESC"
        )->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare(
            "SELECT d.*, o.contract_number
             FROM delivery d
             JOIN `order` o ON d.order_id = o.id
             WHERE d.id = :id"
        );
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function update($id, $order_id, $date, $product_number) {
        $stmt = $this->pdo->prepare(
            "UPDATE delivery
             SET order_id = :order_id,
                 date = :date,
                 product_number = :product_number
             WHERE id = :id"
        );
        $stmt->execute([
            ':id' => $id,
            ':order_id' => $order_id,
            ':date' => $date,
            ':product_number' => $product_number
        ]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare(
            "DELETE FROM delivery WHERE id = :id"
        );
        $stmt->execute([':id' => $id]);
    }
}