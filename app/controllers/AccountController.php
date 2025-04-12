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
    public function edit()
    {
        require_once 'app/helpers/SessionHelper.php';
        SessionHelper::start();
    
        $accountId = $_SESSION['account_id'] ?? null;
        if (!$accountId) {
            echo "⛔ Bạn cần đăng nhập để chỉnh sửa thông tin.";
            return;
        }
    
        $account = $this->accountModel->findById($accountId);
        if (!$account) {
            echo "Không tìm thấy tài khoản!";
            return;
        }
    
        include_once 'app/views/account/edit.php';
    }
    
    public function update()
    {
        require_once 'app/helpers/SessionHelper.php';
        SessionHelper::start();
    
        $accountId = $_SESSION['account_id'] ?? null;
        if (!$accountId) {
            echo "⛔ Bạn cần đăng nhập để cập nhật thông tin.";
            return;
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fullname = $_POST['fullname'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $address = $_POST['address'] ?? '';
    
            $currentPassword = $_POST['current_password'] ?? '';
            $newPassword = $_POST['new_password'] ?? '';
            $confirmNewPassword = $_POST['confirm_new_password'] ?? '';
    
            $errors = [];
    
            // Kiểm tra thông tin cá nhân
            if (empty($fullname)) {
                $errors['fullname'] = "Vui lòng nhập họ tên!";
            } elseif (mb_strlen($fullname) < 4 || mb_strlen($fullname) > 70) {
                $errors['fullname'] = "Họ tên phải từ 4 đến 70 ký tự!";
            }
    
            if (empty($phone)) {
                $errors['phone'] = "Vui lòng nhập số điện thoại!";
            } elseif (!preg_match('/^(0|\+84)[0-9]{9}$/', $phone)) {
                $errors['phone'] = "Số điện thoại không hợp lệ!";
            }
    
            // Lấy thông tin tài khoản từ DB
            $account = $this->accountModel->findById($accountId);
    
            // Xử lý đổi mật khẩu nếu người dùng nhập vào
            if (!empty($currentPassword) || !empty($newPassword) || !empty($confirmNewPassword)) {
                if (empty($currentPassword)) {
                    $errors['current_password'] = "Vui lòng nhập mật khẩu hiện tại!";
                } elseif (!password_verify($currentPassword, $account->password)) {
                    $errors['current_password'] = "Mật khẩu hiện tại không chính xác!";
                }if (empty($newPassword)) {
                    $errors['new_password'] = "Vui lòng nhập mật khẩu mới!";
                } elseif (mb_strlen($newPassword) < 6 || !preg_match('/[a-z]/', $newPassword) || !preg_match('/[A-Z]/', $newPassword)) {
                    $errors['new_password'] = "Mật khẩu mới phải có ít nhất 6 ký tự, bao gồm chữ hoa và chữ thường!";
                }
                
    
                if ($newPassword !== $confirmNewPassword) {
                    $errors['confirm_new_password'] = "Mật khẩu xác nhận không khớp!";
                }
            }
    
            // Nếu có lỗi → quay lại form
            if (count($errors) > 0) {
                $account->fullname = $fullname;
                $account->phone = $phone;
                $account->address = $address;
                include_once 'app/views/account/edit.php';
            } else {
                // Cập nhật thông tin cá nhân
                $this->accountModel->updateInfo($accountId, $fullname, $phone, $address);
    
                // Cập nhật mật khẩu nếu có
                if (!empty($currentPassword) && !empty($newPassword) && empty($errors['current_password'])) {
                    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                    $this->accountModel->updatePassword($accountId, $hashedPassword);
                }
    
                header('Location: /account/quanLyTaiKhoan');
                exit;
            }
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
