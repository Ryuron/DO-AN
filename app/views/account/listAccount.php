<?php 
require_once 'app/helpers/SessionHelper.php'; 
SessionHelper::start(); 
include 'app/views/shares/header.php'; 
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật thông tin tài khoản</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-image: url('https://tipsmake.com/data/images/beautiful-technology-background-picture-4-1xJsgdLW6.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
            color: white;
            position: relative;
            z-index: 1;
        }

        /* Lớp phủ làm mờ nền */
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: -1;
        }
    </style>
</head>

<h2>Danh sách tài khoản</h2>
<?php if (SessionHelper::isAdmin()): ?>
    <form method="GET" action="/account/list" class="mb-3">
        <div class="input-group">
            <input 
                type="text" 
                name="keyword" 
                class="form-control" 
                placeholder="🔍 Tìm username hoặc họ tên..." 
                value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>"
                aria-label="Từ khóa tìm kiếm"
            >
            <button class="btn btn-primary" type="submit">Tìm kiếm</button>
        </div>
    </form>
<?php endif; ?>


<table class="table table-bordered">
    <thead class="table-light">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Họ và tên</th>
            <th>Quyền</th>
            <th>Lịch sử mua hàng</th>
            <th>Chỉnh sửa</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($accounts)): ?>
            <?php foreach ($accounts as $acc): ?>
                <tr>
                    <td style="color:aliceblue"><?= htmlspecialchars($acc->id) ?></td>
                    <td style="color:aliceblue"><?= htmlspecialchars($acc->username) ?></td>
                    <td style="color:aliceblue"><?= htmlspecialchars($acc->fullname) ?></td>
                    <td style="color:aliceblue"><?= htmlspecialchars($acc->role) ?></td>
                    <td>
                        <a href="/account/detail?id=<?= $acc->id ?>" class="btn btn-sm btn-info">Xem chi tiết</a>
                    </td>
                    <td>
                        <?php if (SessionHelper::isAdmin() || ($_SESSION['account_id'] ?? null) == $acc->id): ?>
                            <a 
                                href="/account/edit<?= SessionHelper::isAdmin() ? '?id=' . $acc->id : '' ?>" 
                                class="btn btn-sm btn-warning"
                            >
                                Sửa
                            </a>
                        <?php else: ?>
                            <span class="text-muted">Không khả dụng</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" class="text-center">Không tìm thấy tài khoản nào.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
<a href="/Product" class="btn btn-secondary mt-2">Quay lại trang chủ</a>