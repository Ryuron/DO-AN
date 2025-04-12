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

        h1 {
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
        }

        .form-group label {
            color: aliceblue;
            font-weight: bold;
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
        }

        .form-control:focus {
            border-color: #007bff;
            background-color: rgba(255, 255, 255, 0.3);
        }

        .btn-primary, .btn-secondary {
            backdrop-filter: blur(5px);
            transition: all 0.3s;
        }

        .btn-primary:hover, .btn-secondary:hover {
            background-color: rgba(0, 123, 255, 0.8);
            color: white;
        }

        .alert {
            backdrop-filter: blur(5px);
            background-color: rgba(255, 0, 0, 0.6);
            color: white;
            font-weight: bold;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="glass-card">
            <h1 class="text-center mb-4"><i class="fa fa-plus-circle"></i> Thêm sản phẩm mới</h1>

            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="POST" action="/Product/save" enctype="multipart/form-data" onsubmit="return validateForm();">
                <div class="form-group">
                    <label for="name">Tên sản phẩm:</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="description">Mô tả:</label>
                    <textarea id="description" name="description" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label for="price">Giá:</label>
                    <input type="number" id="price" name="price" class="form-control" step="0.01" required>
                </div>
                <div class="form-group">
                    <label for="category_id">Danh mục:</label>
                    <select id="category_id" name="category_id" class="form-control" required>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category->id; ?>"><?= htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="image">Ảnh chính:</label>
                    <input type="file" id="image" name="image" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="gallery_images">Ảnh phụ (có thể chọn nhiều):</label>
                    <input type="file" id="gallery_images" name="gallery_images[]" class="form-control" multiple>
                </div>

                <div class="text-center">
                <a href="/Product" class="btn btn-secondary btn-glass mt-3" style="color:chartreuse">
                    <i class="fa-solid fa-plus" ></i> Thêm sản phẩm mới
                </a>
            </div>
            </form>
            <div class="text-center">
                <a href="/Product" class="btn btn-secondary btn-glass mt-3">
                    <i class="fa fa-arrow-left"></i> Quay lại trang chủ
                </a>
            </div>
        </div>
    </div>
</body>
</html>

<?php include 'app/views/shares/footer.php'; ?>
