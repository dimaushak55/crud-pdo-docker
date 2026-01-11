<?php
require_once 'Database.php';

class OrderDAO {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = Database::connect();
    }

    /* CREATE */
    public function create(
        $client_id,
        $client_address,
        $product_id,
        $total_amount,
        $order_date,
        $contract_number
    ) {
        $stmt = $this->pdo->prepare(
            "INSERT INTO `order`
             (client_id, client_address, product_id,
              total_amount, order_date, contract_number)
             VALUES
             (:client_id, :client_address, :product_id,
              :total_amount, :order_date, :contract_number)"
        );
        $stmt->execute([
            ':client_id' => $client_id,
            ':client_address' => $client_address,
            ':product_id' => $product_id,
            ':total_amount' => $total_amount,
            ':order_date' => $order_date,
            ':contract_number' => $contract_number
        ]);
    }

    /* READ: list */
    public function getAll() {
        return $this->pdo->query(
            "SELECT o.*, c.name AS client_name, p.name AS product_name
             FROM `order` o
             JOIN client c ON o.client_id = c.id
             JOIN product p ON o.product_id = p.id
             ORDER BY o.id DESC"
        )->fetchAll();
    }

    /* READ: view */
    public function getById($id) {
        $stmt = $this->pdo->prepare(
            "SELECT o.*, c.name AS client_name, p.name AS product_name
             FROM `order` o
             JOIN client c ON o.client_id = c.id
             JOIN product p ON o.product_id = p.id
             WHERE o.id = :id"
        );
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    /* UPDATE */
    public function update(
        $id,
        $client_id,
        $client_address,
        $product_id,
        $total_amount,
        $order_date,
        $contract_number
    ) {
        $stmt = $this->pdo->prepare(
            "UPDATE `order`
             SET client_id = :client_id,
                 client_address = :client_address,
                 product_id = :product_id,
                 total_amount = :total_amount,
                 order_date = :order_date,
                 contract_number = :contract_number
             WHERE id = :id"
        );
        $stmt->execute([
            ':id' => $id,
            ':client_id' => $client_id,
            ':client_address' => $client_address,
            ':product_id' => $product_id,
            ':total_amount' => $total_amount,
            ':order_date' => $order_date,
            ':contract_number' => $contract_number
        ]);
    }

    /* DELETE */
    public function delete($id) {
        $stmt = $this->pdo->prepare(
            "DELETE FROM `order` WHERE id = :id"
        );
        $stmt->execute([':id' => $id]);
    }
}