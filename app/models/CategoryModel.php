<?php
class CategoryModel
{
    private $conn;
    private $table_name = "category";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Lấy tất cả danh mục
    public function getCategories()
    {
        $query = "SELECT id, name, description FROM {$this->table_name}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Lấy danh mục theo ID
    public function getCategoryById($id)
    {
        $query = "SELECT * FROM {$this->table_name} WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":id", (int)$id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    // Thêm danh mục
    public function addCategory($name, $description)
    {
        $query = "INSERT INTO {$this->table_name} (name, description) VALUES (:name, :description)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":name", trim($name), PDO::PARAM_STR);
        $stmt->bindValue(":description", trim($description), PDO::PARAM_STR);
        return $stmt->execute();
    }

    // Cập nhật danh mục
    public function updateCategory($id, $name, $description)
    {
        $query = "UPDATE {$this->table_name} SET name = :name, description = :description WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":id", (int)$id, PDO::PARAM_INT);
        $stmt->bindValue(":name", trim($name), PDO::PARAM_STR);
        $stmt->bindValue(":description", trim($description), PDO::PARAM_STR);
        return $stmt->execute();
    }

    // Xóa danh mục
    public function deleteCategory($id)
    {
        $query = "DELETE FROM {$this->table_name} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":id", (int)$id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
