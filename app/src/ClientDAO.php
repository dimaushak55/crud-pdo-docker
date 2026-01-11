<?php
require_once 'Database.php';

class ClientDAO {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = Database::connect();
    }

    /* CREATE */
    public function create($phone, $name, $address, $email) {
        $stmt = $this->pdo->prepare(
            "INSERT INTO client (phone, name, address, email)
             VALUES (:phone, :name, :address, :email)"
        );
        $stmt->execute([
            ':phone' => $phone,
            ':name' => $name,
            ':address' => $address,
            ':email' => $email
        ]);
    }

    /* READ: list */
    public function getAll() {
        return $this->pdo->query(
            "SELECT * FROM client ORDER BY id DESC"
        )->fetchAll();
    }

    /* READ: view */
    public function getById($id) {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM client WHERE id = :id"
        );
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    /* UPDATE */
    public function update($id, $phone, $name, $address, $email) {
        $stmt = $this->pdo->prepare(
            "UPDATE client
             SET phone = :phone,
                 name = :name,
                 address = :address,
                 email = :email
             WHERE id = :id"
        );
        $stmt->execute([
            ':id' => $id,
            ':phone' => $phone,
            ':name' => $name,
            ':address' => $address,
            ':email' => $email
        ]);
    }

    /* DELETE */

    public function hasOrders($id) {
    $stmt = $this->pdo->prepare(
        "SELECT COUNT(*) FROM `order` WHERE client_id = :id"
    );
    $stmt->execute([':id' => $id]);
    return $stmt->fetchColumn() > 0;
    }
    
    public function delete($id) {
        $stmt = $this->pdo->prepare(
            "DELETE FROM client WHERE id = :id"
        );
        $stmt->execute([':id' => $id]);
    }
}