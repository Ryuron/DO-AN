<?php include 'app/views/shares/header.php'; ?>

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
<h2>Cập nhật thông tin tài khoản</h2>

<form method="POST" action="/account/update">
    <label>Họ tên:</label><br>
    <input type="text" name="fullname" value="<?= htmlspecialchars($account->fullname ?? '') ?>"><br>
    <span style="color:red"><?= $errors['fullname'] ?? '' ?></span><br>

    <label>Số điện thoại:</label><br>
    <input type="text" name="phone" value="<?= htmlspecialchars($account->phone ?? '') ?>"><br>
    <span style="color:red"><?= $errors['phone'] ?? '' ?></span><br>

    <label>Địa chỉ:</label><br>
    <textarea name="address"><?= htmlspecialchars($account->address ?? '') ?></textarea><br>

    <hr>

    <h4>Đổi mật khẩu</h4>

    <label>Mật khẩu hiện tại:</label><br>
    <input type="password" name="current_password" autocomplete="off"><br>
    <span style="color:red"><?= $errors['current_password'] ?? '' ?></span><br>

    <label>Mật khẩu mới:</label><br>
    <input type="password" name="new_password" autocomplete="off"><br>
    <span style="color:red"><?= $errors['new_password'] ?? '' ?></span><br>

    <label>Xác nhận mật khẩu mới:</label><br>
    <input type="password" name="confirm_new_password" autocomplete="off"><br>
    <span style="color:red"><?= $errors['confirm_new_password'] ?? '' ?></span><br>

    <br>
    <button type="submit">Lưu thay đổi</button>
</form>
<a href="/Account/quanLyTaiKhoan" class="btn btn-secondary mt-2">Quay lại</a>