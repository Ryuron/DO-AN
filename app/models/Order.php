<?php
require_once 'app/config/database.php';

class Order
{
    private static function getDb()
    {
        return (new Database())->getConnection();
    }

    public static function getByStatus($status)
    {
        $db = self::getDb();
        $stmt = $db->prepare("SELECT * FROM orders WHERE status = :status ORDER BY created_at DESC");
        $stmt->bindParam(':status', $status);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getAll()
    {
        $db = self::getDb();
        $stmt = $db->query("SELECT * FROM orders ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function findById($id)
    {
        $db = self::getDb();
        $stmt = $db->prepare("SELECT * FROM orders WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function updateStatus($id, $status)
    {
        $db = self::getDb();
        $stmt = $db->prepare("UPDATE orders SET status = :status WHERE id = :id");
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public static function delete($id)
    {
        $db = self::getDb();
        $stmt = $db->prepare("DELETE FROM orders WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public static function getByAccountId($account_id)
    {
        $db = self::getDb();
        $stmt = $db->prepare("SELECT * FROM orders WHERE account_id = :account_id ORDER BY created_at DESC");
        $stmt->bindParam(':account_id', $account_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
