<?php
require_once('app/config/database.php');
require_once('app/models/AccountModel.php');

class AccountController
{
    private $accountModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->accountModel = new AccountModel($this->db);
    }

    public function register()
    {
        include_once 'app/views/account/register.php';
    }

    public function save()
    {
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
            if (empty($fullName)) {
                $errors['fullname'] = "Vui lòng nhập họ tên!";
            } elseif (mb_strlen($fullName) < 4) {
                $errors['fullname'] = "Họ tên phải có ít nhất 4 ký tự!";
            } elseif (mb_strlen($fullName) > 70) {
                $errors['fullname'] = "Họ tên không được vượt quá 70 ký tự!";
            }

            if (empty($password)) {
                $errors['password'] = "Vui lòng nhập mật khẩu!";
            } elseif (strlen($password) < 6 || !preg_match('/[a-z]/', $password) || !preg_match('/[A-Z]/', $password)) {
                $errors['password'] = "Mật khẩu cần ít nhất 6 ký tự, bao gồm chữ hoa và chữ thường!";
            }
             else {
                if (strlen($password) < 6 || 
                    !preg_match('/[A-Z]/', $password) || 
                    !preg_match('/[a-z]/', $password)) {
                    $errors['password'] = "Mật khẩu cần ít nhất 6 ký tự, bao gồm chữ hoa và chữ thường!";
                }
            }
    
            if (empty($confirmPassword)) {
                $errors['confirmPass'] = "Vui lòng xác nhận mật khẩu!";
            } elseif ($password !== $confirmPassword) {
                $errors['confirmPass'] = "Mật khẩu và xác nhận không khớp!";
            }
    
            if (empty($phone)) {
                $errors['phone'] = "Vui lòng nhập số điện thoại!";
            } elseif (!preg_match('/^(0|\+84)[0-9]{9}$/', $phone)) {
                $errors['phone'] = "Số điện thoại không hợp lệ!";
            }

            if (!in_array($role, ['admin', 'user'])) $role = 'user';

            if ($this->accountModel->getAccountByUsername($username)) {
                $errors['account'] = "Tài khoản này đã được đăng ký!";
            }

            if (count($errors) > 0) {
                include_once 'app/views/account/register.php';
            } else {
                $result = $this->accountModel->save($username, $fullName, $password, $phone, $address, $role);

                if ($result) {
                    header('Location: /account/login');
                    exit;
                }
            }
        }
    }
    

    public function login()
    {
        include_once 'app/views/account/login.php';
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
                $_SESSION['account_id'] = $account->id;
                $_SESSION['user'] = $account;
                header('Location: /product');
                exit;
            } else {
                $_POST['username'] = $username;
                include_once 'app/views/account/login.php';
            }
        }
    }

    public function logout()
    {
        session_start();
        unset($_SESSION['username']);
        unset($_SESSION['role']);
        unset($_SESSION['user']); 
        unset($_SESSION['account_id']);
        
        header('Location: /product');
        exit;
    }
    
    public function quanLyTaiKhoan()
    {
        require_once 'app/helpers/SessionHelper.php';
        SessionHelper::start();
    
        if (SessionHelper::isAdmin()) {
            // Admin: xem tất cả tài khoản
            $accounts = $this->accountModel->getAllAccounts();
        } else {
            // User: chỉ xem tài khoản của mình
            $accountId = $_SESSION['account_id'] ?? null;
            if (!$accountId) {
                die("⛔ Bạn cần đăng nhập để xem thông tin.");
            }
    
            $account = $this->accountModel->findById($accountId);
            $accounts = $account ? [$account] : [];
        }
    
        include_once 'app/views/account/listAccount.php';
    }
    


    public function detail()
    {
        $id = $_GET['id'] ?? null;

        if ($id) {
            $account = $this->accountModel->findById($id);
            $orderHistory = $this->accountModel->getOrderHistoryByAccountId($id);
            include_once 'app/views/account/detail.php';
        } else {
            echo "Không tìm thấy tài khoản!";
        }
    }

    public function orderDetail()
    {
        $orderId = $_GET['order_id'] ?? null;

        if ($orderId) {
            $orderDetails = $this->accountModel->getOrderDetailByOrderId($orderId);
            include_once 'app/views/account/order_detail.php';
        } else {
            echo "Không tìm thấy đơn hàng!";
        }
    }
    
    public function list()
    {
        $keyword = $_GET['keyword'] ?? '';
    
        if ($keyword) {
            $accounts = $this->accountModel->searchByKeyword($keyword);
        } else {
            $accounts = $this->accountModel->getAllAccounts(); // dùng đúng tên hàm
        }
    
        require 'app/views/account/listAccount.php';
    }
    
}
