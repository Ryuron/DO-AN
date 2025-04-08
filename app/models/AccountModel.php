<?php
class AccountModel {
    private $conn;
    private $table_name = "account";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAccountByUsername($username) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE username = :username LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    // ✅ Cập nhật hàm lưu user (đăng ký) với thêm phone & address
    public function save($username, $fullName, $password, $phone, $address, $role = 'user') {
        if ($this->getAccountByUsername($username)) {
            return false;
        }

        $query = "INSERT INTO " . $this->table_name . "
            SET username = :username,
                fullname = :fullname,
                password = :password,
                phone = :phone,
                address = :address,
                role = :role";

        $stmt = $this->conn->prepare($query);
        
        $username = htmlspecialchars(strip_tags($username));
        $fullName = htmlspecialchars(strip_tags($fullName));
        $password = password_hash($password, PASSWORD_BCRYPT);
        $phone = htmlspecialchars(strip_tags($phone));
        $address = htmlspecialchars(strip_tags($address));
        $role = htmlspecialchars(strip_tags($role));

        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":fullname", $fullName);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":phone", $phone);
        $stmt->bindParam(":address", $address);
        $stmt->bindParam(":role", $role);

        return $stmt->execute();
    }
    // ✅ Lấy danh sách đơn hàng theo tài khoản
    public function getOrdersByAccount($accountId) {
        $query = "SELECT * FROM orders WHERE account_id = :account_id ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":account_id", $accountId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // ✅ Lấy danh sách tất cả tài khoản
public function getAllAccounts() {
    $query = "SELECT id, username, fullname, phone, address, role FROM " . $this->table_name;
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}
public function findById($id) {
    $sql = "SELECT * FROM account WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function getOrderHistoryByAccountId($accountId) {
    $sql = "SELECT 
                a.fullname AS account_name,
                o.created_at,
                p.name AS product_name,
                od.price AS product_price,
                od.quantity,
                (od.quantity * od.price) AS line_total,
                o.total AS order_total
            FROM orders o
            JOIN account a ON o.account_id = a.id
            JOIN order_details od ON o.id = od.order_id
            JOIN product p ON od.product_id = p.id
            WHERE o.account_id = :accountId
            ORDER BY o.created_at DESC";
    
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['accountId' => $accountId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



}
?>
