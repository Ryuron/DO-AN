<?php include 'app/views/shares/header.php'; ?>

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
            <h2 class="text-center mb-4"><i class="fa-solid fa-list"></i> Danh sách danh mục</h2>

            <a href="index.php?url=category/add" class="btn btn-success btn-glass mb-3">➕ Thêm danh mục</a>

            <table class="table table-hover text-white">
                <thead>
                    <tr style="background-color: #f2f2f2;">
                        <th>STT</th>
                        <th>Tên danh mục</th>
                        <th>Mô tả</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $stt = 1; foreach ($categories as $category): ?>
                        <tr>
                            <td><?= $stt++ ?></td>
                            <td><?= htmlspecialchars($category->name) ?></td>
                            <td><?= htmlspecialchars($category->description) ?></td>
                            <td>
                                <a href="index.php?url=category/edit/<?= $category->id ?>" class="btn btn-warning btn-glass">
                                    ✏️ Sửa
                                </a>
                                <a href="index.php?url=category/delete/<?= $category->id ?>"
                                   onclick="return confirm('Xoá danh mục này?');" class="btn btn-danger btn-glass">
                                    🗑 Xoá
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
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
