<?php
require_once('app/config/database.php');
require_once('app/models/AccountModel.php');
class AccountController {
private $accountModel;
private $db;
public function __construct() {
$this->db = (new Database())->getConnection();
$this->accountModel = new AccountModel($this->db);
}
public function register() {
include_once 'app/views/account/register.php';
}
public function login() {
include_once 'app/views/account/login.php';
}
public function save() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'] ?? '';
        $fullName = $_POST['fullname'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirmpassword'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $address = $_POST['address'] ?? '';
        $role = $_POST['role'] ?? 'user';

        $errors = [];

        if (empty($username)) $errors['username'] = "Vui lòng nhập username!";
        if (empty($fullName)) $errors['fullname'] = "Vui lòng nhập họ tên!";
        if (empty($password)) $errors['password'] = "Vui lòng nhập mật khẩu!";
        if ($password != $confirmPassword) $errors['confirmPass'] = "Mật khẩu và xác nhận không khớp!";
        if (empty($phone)) $errors['phone'] = "Vui lòng nhập số điện thoại!";
        if (empty($address)) $errors['address'] = "Vui lòng nhập địa chỉ!";

        if (!in_array($role, ['admin', 'user'])) $role = 'user';

        if ($this->accountModel->getAccountByUsername($username)) {
            $errors['account'] = "Tài khoản này đã được đăng ký!";
        }

        if (count($errors) > 0) {
            include_once 'app/views/account/register.php';
        } else {
            // ✅ Gọi hàm đã cập nhật trong model
            $result = $this->accountModel->save($username, $fullName, $password, $phone, $address, $role);

            if ($result) {
                header('Location: /account/login');
                exit;
            }
        }
    }
}

public function logout() {session_start();
    unset($_SESSION['username']);
    unset($_SESSION['role']);
    header('Location: /product');
    exit;
    }
    public function checkLogin() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $account = $this->accountModel->getAccountByUsername($username);
    if ($account && password_verify($password, $account->password)) {
    session_start();
    if (!isset($_SESSION['username'])) {
    $_SESSION['username'] = $account->username;
    $_SESSION['role'] = $account->role;
    $_SESSION['account_id'] = $account->id; // Thêm dòng này

    }
    public function login()
    {
        include_once 'app/views/account/login.php';
    }
    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $fullName = $_POST['fullname'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirmpassword'] ?? '';
            $role = $_POST['role'] ?? 'user';
            $errors = [];
            if (empty($username)) $errors['username'] = "Vui lòng nhập username!";
            if (empty($fullName)) $errors['fullname'] = "Vui lòng nhập fullname!";
            if (empty($password)) $errors['password'] = "Vui lòng nhập password!";
            if ($password != $confirmPassword) $errors['confirmPass'] = "Mật khẩu và xác nhận chưa khớp!";

            if (!in_array($role, ['admin', 'user'])) $role = 'user';
            if ($this->accountModel->getAccountByUsername($username)) {
                $errors['account'] = "Tài khoản này đã được đăng ký!";
            }
            if (count($errors) > 0) {
                include_once 'app/views/account/register.php';
            } else {
                $result = $this->accountModel->save(
                    $username,
                    $fullName,
                    $password,

                    $role
                );

                if ($result) {
                    header('Location: /account/login');
                    exit;
                }
            }
        }
    }
    public function logout()
    {
        session_start();
        unset($_SESSION['username']);
        unset($_SESSION['role']);
        header('Location: /product');
        exit;
    }
    public function checkLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $account = $this->accountModel->getAccountByUsername($username);
    
            $errors = [];
    
            if (empty($username)) {
                $errors['username'] = "Vui lòng nhập username!";
            } elseif (!$account) {
                $errors['username'] = "Không tìm thấy tài khoản!";
            }
    
            if ($account && !password_verify($password, $account->password)) {
                $errors['password'] = "Mật khẩu không đúng!";
            }
    
            if (empty($errors)) {
                session_start();
                $_SESSION['username'] = $account->username;
                $_SESSION['role'] = $account->role;
                header('Location: /product');
                exit;
            } else {
                // Giữ lại dữ liệu vừa nhập
                $_POST['username'] = $username;
                include_once 'app/views/account/login.php';
            }
        }
    }
<<<<<<< HEAD
    }
    }
    public function quanLyTaiKhoan() {
        $accounts = $this->accountModel->getAllAccounts(); // Hàm này đã có trong model
        include_once 'app/views/account/listAccount.php'; // View hiển thị danh sách

    }
    public function detail() {
        $id = $_GET['id'] ?? null;
    
        if ($id) {
            $account = $this->accountModel->findById($id);
            $orderHistory = $this->accountModel->getOrderHistoryByAccountId($id); // bạn cần viết thêm hàm này
    
            include_once 'app/views/account/detail.php';
        } else {
            echo "Không tìm thấy tài khoản!";
        }
    }
    public function orderDetail() {
        $orderId = $_GET['order_id'] ?? null;
    
        if ($orderId) {
            $orderDetails = $this->accountModel->getOrderDetailByOrderId($orderId);
            include_once 'app/views/account/order_detail.php';
        } else {
            echo "Không tìm thấy đơn hàng!";
        }
    }
    
    
    
    }
    ?>
=======
    
}
>>>>>>> e3fd9b21ef0b00c716a887eced857186c6f10dff
