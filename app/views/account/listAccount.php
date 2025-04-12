<?php 
require_once 'app/helpers/SessionHelper.php'; 
SessionHelper::start(); 
include 'app/views/shares/header.php'; 
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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

        .glass-card {
            backdrop-filter: blur(12px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            padding: 30px;
            margin-top: 60px;
        }

        h2 {
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
        }

        .table th, .table td {
            vertical-align: middle;
            color: white;
        }

        .table th {
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }

        .btn-glass {
            border: 1px solid rgba(255, 255, 255, 0.3);
            background: rgba(255, 255, 255, 0.05);
            color: white;
            backdrop-filter: blur(5px);
            transition: all 0.3s;
        }

        .btn-glass:hover {
            background: rgba(255, 255, 255, 0.15);
            color: #fff;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="glass-card">
            <h2 class="text-center mb-4"><i class="fa-solid fa-users"></i> Danh sách tài khoản</h2>

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

            <table class="table table-bordered table-hover text-white">
                <thead class="table-light">
                    <tr>
                        <th style="color:black">ID</th>
                        <th style="color:black">Username</th>
                        <th style="color:black">Họ và tên</th>
                        <th style="color:black">Quyền</th>
                        <th style="color:black">Lịch sử mua hàng</th>
                        <th style="color:black">Chỉnh sửa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($accounts)): ?>
                        <?php foreach ($accounts as $acc): ?>
                            <tr>
                                <td ><?= htmlspecialchars($acc->id) ?></td>
                                <td><?= htmlspecialchars($acc->username) ?></td>
                                <td><?= htmlspecialchars($acc->fullname) ?></td>
                                <td><?= htmlspecialchars($acc->role) ?></td>
                                <td>
                                    <a href="/account/detail?id=<?= $acc->id ?>" class="btn btn-sm btn-info btn-glass">Xem chi tiết</a>
                                </td>
                                <td>
                                    <?php if (SessionHelper::isAdmin() || ($_SESSION['account_id'] ?? null) == $acc->id): ?>
                                        <a 
                                            href="/account/edit<?= SessionHelper::isAdmin() ? '?id=' . $acc->id : '' ?>" 
                                            class="btn btn-sm btn-warning btn-glass"
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

            <div class="text-center">
                <a href="/Product" class="btn btn-secondary btn-glass mt-3">
                    <i class="fa fa-arrow-left"></i> Quay lại trang chủ
                </a>
            </div>
        </div>
    </div>
</body>
</html>
