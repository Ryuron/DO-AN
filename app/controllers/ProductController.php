<?php
require_once('app/helpers/SessionHelper.php');
require_once('app/config/database.php');
require_once('app/models/ProductModel.php');
require_once('app/models/CategoryModel.php');
require_once 'app/models/AccountModel.php'; // Đảm bảo đường dẫn chính xác
require_once 'app/models/Order.php';
require_once 'app/models/AccountModel.php';

class ProductController
{
    private $productModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->productModel = new ProductModel($this->db);
    }

    public function index()
    {
        $products = $this->productModel->getProducts();
        include 'app/views/product/list.php';
    }

    public function show($id)
{
    $product = $this->productModel->getProductById($id);
    $galleryImages = $this->productModel->getProductImages($id); // 💡 lấy ảnh phụ

    if ($product) {
        include 'app/views/product/show.php'; // hoặc detail.php nếu bạn đặt tên khác
    } else {
        echo "Không tìm thấy sản phẩm.";
    }
}

    
    public function add()
    {
        SessionHelper::requireAdmin();
        $categories = (new CategoryModel($this->db))->getCategories();
        include_once 'app/views/product/add.php';
    }
    public function save()
    {
        SessionHelper::requireAdmin();
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $price = $_POST['price'] ?? '';
            $category_id = $_POST['category_id'] ?? null;
    
            // Xử lý ảnh chính
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $image = $this->uploadImage($_FILES['image']);
            } else {
                $image = "";
            }
    
            // Thêm sản phẩm và lấy ID mới
            $result = $this->productModel->addProduct($name, $description, $price, $category_id, $image);
    
            if (is_array($result)) {
                $errors = $result;
                $categories = (new CategoryModel($this->db))->getCategories();
                include 'app/views/product/add.php';
            } else {
                $productId = $result; // Nếu addProduct trả về ID
    
                // Xử lý nhiều ảnh phụ
                if (!empty($_FILES['gallery_images']['name'][0])) {
                    foreach ($_FILES['gallery_images']['tmp_name'] as $key => $tmpName) {
                        if ($_FILES['gallery_images']['error'][$key] === 0) {
                            $galleryImage = [
                                'name' => $_FILES['gallery_images']['name'][$key],
                                'type' => $_FILES['gallery_images']['type'][$key],
                                'tmp_name' => $tmpName,
                                'error' => $_FILES['gallery_images']['error'][$key],
                                'size' => $_FILES['gallery_images']['size'][$key],
                            ];
                            $imagePath = $this->uploadImage($galleryImage);
    
                            // Lưu vào bảng product_images
                            $this->productModel->addProductImage($productId, $imagePath);
                        }
                    }
                }
    
                header('Location: /Product');
            }
        }
    }
    

    public function edit($id)
    {
        SessionHelper::requireAdmin();
        $product = $this->productModel->getProductById($id);
        $categories = (new CategoryModel($this->db))->getCategories();
        if ($product) {
            include 'app/views/product/edit.php';
        } else {
            echo "Không thấy sản phẩm.";
        }
    }

    public function update()
    {
        SessionHelper::requireAdmin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category_id = $_POST['category_id'];

            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $image = $this->uploadImage($_FILES['image']);
            } else {
                $image = $_POST['existing_image'];
            }

            $edit = $this->productModel->updateProduct($id, $name, $description, $price, $category_id, $image);
            if ($edit) {
                header('Location: /Product');
            } else {
                echo "Đã xảy ra lỗi khi lưu sản phẩm.";
            }
        }
    }

    public function delete($id)
    {
        SessionHelper::requireAdmin();
        if ($this->productModel->deleteProduct($id)) {
            header('Location: /Product');
        } else {
            echo "Đã xảy ra lỗi khi xóa sản phẩm.";
        }
    }

    private function uploadImage($file)
    {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $target_file = $target_dir . basename($file["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($file["tmp_name"]);
        if ($check === false) {
            throw new Exception("File không phải là hình ảnh.");
        }

        if ($file["size"] > 10 * 1024 * 1024) {
            throw new Exception("Hình ảnh có kích thước quá lớn.");
        }

        if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
            throw new Exception("Chỉ cho phép các định dạng JPG, JPEG, PNG và GIF.");
        }

        if (!move_uploaded_file($file["tmp_name"], $target_file)) {
            throw new Exception("Có lỗi xảy ra khi tải lên hình ảnh.");
        }

        return $target_file;
    }

    public function addToCart($id)
    {
        if (!SessionHelper::isLoggedIn()) {
            header('Location: /Account/login'); // Hoặc có thể chuyển hướng về trang hiện tại kèm thông báo
            exit;
        }
    
        $product = $this->productModel->getProductById($id);
        if (!$product) {
            echo "Không tìm thấy sản phẩm.";
            return;
        }
    
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['quantity']++;
        } else {
            $_SESSION['cart'][$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image
            ];
        }
    
        header('Location: /Product/cart');
        exit;
    }
    // Hiển thị giỏ hàng  

    public function cart()
    {
        $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
        $isLoggedIn = isset($_SESSION['user']);
        include 'app/views/product/cart.php';
    }
    public function updateCart()
    {
        $id = $_POST['id'];
        $action = $_POST['action'];

        if (isset($_SESSION['cart'][$id])) {
            if ($action === 'increase') {
                $_SESSION['cart'][$id]['quantity']++;
            } elseif ($action === 'decrease') {
                $_SESSION['cart'][$id]['quantity']--;
                if ($_SESSION['cart'][$id]['quantity'] <= 0) {
                    unset($_SESSION['cart'][$id]);
                }
            }
        }

        header('Location: /Product/cart');
        exit;
    }

    // Xóa sản phẩm khỏi giỏ
    public function deleteCart()
    {
        $id = $_POST['id'];
        unset($_SESSION['cart'][$id]);
        header('Location: /Product/cart');
        exit;
    }


    public function checkout()
    {
        SessionHelper::allowCartActions();

        $account_id = $_SESSION['account_id'] ?? null;
     
        $account = null;
        if ($account_id) {
            // gọi model lấy thông tin user từ DB
            $accountModel = new AccountModel($this->db);
            $account = $accountModel->getAccountById($account_id);
        }
    
        include 'app/views/product/checkout.php';
    }

    public function processCheckout()
    {
        SessionHelper::allowCartActions();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];

            if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
                echo "Giỏ hàng trống.";
                return;
            }

            $this->db->beginTransaction();
            try {
                $account_id = $_SESSION['account_id'] ?? null;

                $total = 0;
                foreach ($_SESSION['cart'] as $item) {
                    $total += $item['price'] * $item['quantity'];
                }

                $query = "INSERT INTO orders (account_id, name, phone, address, total) 
                      VALUES (:account_id, :name, :phone, :address, :total)";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':account_id', $account_id);
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':phone', $phone);
                $stmt->bindParam(':address', $address);
                $stmt->bindParam(':total', $total);
                $stmt->execute();
                $order_id = $this->db->lastInsertId();

                $cart = $_SESSION['cart'];
                foreach ($cart as $product_id => $item) {
                    $query = "INSERT INTO order_details (order_id, product_id, quantity, price) 
                          VALUES (:order_id, :product_id, :quantity, :price)";
                    $stmt = $this->db->prepare($query);
                    $stmt->bindParam(':order_id', $order_id);
                    $stmt->bindParam(':product_id', $product_id);
                    $stmt->bindParam(':quantity', $item['quantity']);
                    $stmt->bindParam(':price', $item['price']);
                    $stmt->execute();
                }

                unset($_SESSION['cart']);
                $this->db->commit();
                header('Location: /Product/orderConfirmation');
            } catch (Exception $e) {
                $this->db->rollBack();
                echo "Đã xảy ra lỗi khi xử lý đơn hàng: " . $e->getMessage();
            }
        }
    }
    public function orderConfirmation()
    {
        SessionHelper::allowCartActions();
        include 'app/views/product/orderConfirmation.php';
    }
    public function orderHistory()
    {
        SessionHelper::requireLogin();
        $account_id = $_SESSION['account_id'];
        $orders = $this->productModel->getOrdersByAccount($account_id);
        include 'app/views/product/order_history.php';
    }
    public function orderDetails($order_id)
    {
        SessionHelper::requireLogin();
        $order = $this->productModel->getOrderDetails($order_id);
        if ($order) {
            include 'app/views/product/order_details.php';
        } else {
            echo "Không tìm thấy đơn hàng.";
        }
    }
    

    // Tìm kiếm sản phẩm
    public function search()
    {
        $keyword = $_GET['keyword'] ?? '';
        $category_id = $_GET['category_id'] ?? '';
    
        $products = $this->productModel->searchProducts($keyword, $category_id);
    
        include 'app/views/product/search_results.php';
    }

    public function listOrders() {
        // Hiển thị danh sách đơn hàng đang chờ duyệt
        $orders = Order::getByStatus('O');
        include 'app/views/product/listOrders.php';
    }
    
    public function approve($id) {
        if ($_SESSION['role'] !== 'admin') {
            die('Bạn không có quyền duyệt đơn hàng.');
        }
        Order::updateStatus($id, 'Y');
        header('Location: /product/listOrders');
    }
    
    public function cancel($id) {
        if ($_SESSION['role'] !== 'admin') {
            die('Bạn không có quyền hủy đơn hàng.');
        }
        Order::updateStatus($id, 'N');
        header('Location: /product/listOrders');
    }
    
    public function order()
    {
        SessionHelper::requireLogin();
        
        $account_id = $_SESSION['account_id'];
        $role = $_SESSION['role'] ?? 'user'; // Mặc định là user nếu không có
        
        if ($role === 'admin') {
            // admin xem tất cả đơn hàng
            $orders = $this->productModel->getAllOrders(); 
        } else {
            // user chỉ xem đơn hàng của mình
            $orders = $this->productModel->getOrdersByAccount($account_id);
        }
        
        include 'app/views/product/order.php';
    }
    
}
