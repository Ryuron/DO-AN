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
<h2>Danh sách danh mục</h2>

<a href="index.php?url=category/add" class="btn btn-success" style="margin-bottom: 10px;">➕ Thêm danh mục</a>

<table border="1" cellpadding="8" style="width: 100%; border-collapse: collapse;">
    <thead>
        <tr style="background-color: #f2f2f2;">
            <th>STT</th>
            <th>Tên danh mục</th>
            <th>Mô tả</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php $stt = 1;
        foreach ($categories as $category): ?>
            <tr>
                <td><?= $stt++ ?></td> <!-- STT thay cho ID -->
                <td><?= htmlspecialchars($category->name) ?></td>
                <td><?= htmlspecialchars($category->description) ?></td>
                <td>
                    <a href="index.php?url=category/edit/<?= $category->id ?>" class="btn btn-warning">✏️ Sửa</a>
                    <a href="index.php?url=category/delete/<?= $category->id ?>"
                        onclick="return confirm('Xoá danh mục này?');"
                        class="btn btn-danger">🗑 Xoá</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<a href="/Product" class="btn btn-secondary mt-2">Quay lại danh sách
    sản phẩm</a>