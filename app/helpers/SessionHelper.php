<?php
class SessionHelper {
    // Khởi động session nếu chưa bắt đầu
    public static function start() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Kiểm tra người dùng đã đăng nhập chưa
    public static function isLoggedIn() {
        self::start();
        return isset($_SESSION['username']);
    }

    // Kiểm tra người dùng có phải admin không
    public static function isAdmin() {
        self::start();
        return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
    }

    // Lấy vai trò hiện tại của người dùng (mặc định: guest)
    public static function getRole() {
        self::start();
        return $_SESSION['role'] ?? 'guest';
    }

    // ✅ Chỉ cho phép admin thực hiện hành động quản lý sản phẩm
    public static function requireAdmin() {
        self::start();
        if (!self::isAdmin()) {
            die("⛔ Chỉ quản trị viên mới được thực hiện chức năng này.");
        }
    }

    // ✅ Cho phép user hoặc admin xem danh sách / chi tiết sản phẩm
    public static function allowViewProduct() {
        self::start();
        $role = self::getRole();
        if (!in_array($role, ['admin', 'user'])) {
            die("⛔ Bạn cần đăng nhập để xem sản phẩm.");
        }
    }

    // ✅ Cho phép user hoặc admin thêm vào giỏ hàng / thanh toán
    public static function allowCartActions() {
        self::start();
        $role = self::getRole();
        if (!in_array($role, ['admin', 'user'])) {
            die("⛔ Bạn cần đăng nhập để thực hiện hành động này.");
        }
    }

    // Đăng xuất
    public static function logout() {
        self::start();
        session_destroy();
    }
}
?>
