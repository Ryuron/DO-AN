<?php
require_once('app/config/database.php');
require_once('app/models/CategoryModel.php');

class CategoryController
{
    private $categoryModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->categoryModel = new CategoryModel($this->db);
    }

    // Danh sách danh mục
    public function list()
    {
        $categories = $this->categoryModel->getCategories();
        include 'app/views/category/list.php';
    }

    // Hiển thị form thêm danh mục
    public function add()
    {
        include 'app/views/category/add.php';
    }

    // Xử lý thêm danh mục
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $description = trim($_POST['description'] ?? '');
            if (!empty($name)) {
                $this->categoryModel->addCategory($name, $description);
            }
            header('Location: /category/list');
            exit;
        }
    }

    // Hiển thị form sửa danh mục
    public function edit($id)
    {
        $category = $this->categoryModel->getCategoryById($id);
        include 'app/views/category/edit.php';
    }

    // Xử lý cập nhật danh mục
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $name = trim($_POST['name'] ?? '');
            $description = trim($_POST['description'] ?? '');

            if (!empty($id) && !empty($name)) {
                $this->categoryModel->updateCategory($id, $name, $description);
            }
            header('Location: /category/list');
            exit;
        }
    }

    // Xử lý xóa danh mục
    public function delete($id)
    {
        if (!empty($id)) {
            $this->categoryModel->deleteCategory($id);
        }
        header('Location: /category/list');
        exit;
    }
}
