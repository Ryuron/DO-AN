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

        /* Nổi bật phần tên sản phẩm */
        .product-name {
            font-size: 2rem;
            color: #fff;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.7);
            /* Đổ bóng chữ */
            font-weight: bold;
            margin-bottom: 15px;
        }

        /* Nổi bật phần mô tả sản phẩm */
        .product-description {
            color: #ddd;
            font-size: 1.1rem;
            text-shadow: 1px 1px 8px rgba(0, 0, 0, 0.5);
            /* Đổ bóng chữ cho mô tả */
            margin-bottom: 20px;
        }

        .text-white,
        .btn-glass,
        .btn-secondary,
        .btn-success {
            color: white;
        }

        .btn-glass {
            border: 1px solid rgba(255, 255, 255, 0.3);
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(5px);
            transition: all 0.3s;
        }

        .btn-glass:hover {
            background: rgba(255, 255, 255, 0.15);
            color: #fff;
        }

        .btn-secondary {
            border: 1px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(5px);
        }

        .img-thumbnail {
            object-fit: cover;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="glass-card">
            <h2 class="text-center mb-4"><i class="fa-solid fa-list"></i> Chi tiết sản phẩm</h2>

            <div class="row">
                <div class="col-md-6">
                    <?php if ($product->image): ?>
                        <div class="text-center mb-3">
                            <img src="/<?php echo htmlspecialchars($product->image, ENT_QUOTES, 'UTF-8'); ?>"
                                class="img-fluid rounded shadow-sm" style="max-height: 400px; object-fit: cover;"
                                alt="<?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>">
                        </div>
                        <?php if (!empty($galleryImages)): ?>
                            <div class="mt-3">
                                <h5>Ảnh khác</h5>
                                <div class="d-flex flex-wrap gap-2 justify-content-center">
                                    <?php foreach ($galleryImages as $img): ?>
                                        <div style="width: 80px; height: 80px;">
                                            <img src="/<?php echo htmlspecialchars($img->image_path); ?>"
                                                class="img-thumbnail w-100 h-100" alt="Ảnh phụ">
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <img src="/images/no-image.png"
                            class="img-fluid rounded" alt="Không có ảnh">
                    <?php endif; ?>
                </div>

                <div class="col-md-6">
                    <!-- Tên sản phẩm với style nổi bật -->
                    <h3 class="product-name">
                        <?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>
                    </h3>

                    <!-- Mô tả sản phẩm với style nổi bật -->
                    <p class="product-description">
                        <?php echo nl2br(htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8')); ?>
                    </p>

                    <!-- Giá sản phẩm -->
                    <p class="text-danger font-weight-bold h4">
                        💰 <?php echo number_format($product->price, 0, ',', '.'); ?> VND
                    </p>

                    <!-- Danh mục sản phẩm -->
                    <p><strong>Danh mục:</strong>
                        <span class="badge bg-info text-white">
                            <?php echo !empty($product->category_name) ? htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8') : 'Chưa có danh mục'; ?>
                        </span>
                    </p>

                    <div class="mt-4">
                        <a href="/Product/addToCart/<?php echo $product->id; ?>" class="btn btn-secondary btn-glass mt-3" style="color:chartreuse"><i class="fa-solid fa-plus"  ; ></i> Thêm vào giỏ</a>
                        <a href="/Product" class="btn btn-secondary btn-glass mt-3"><i class="fa fa-arrow-left"></i> Quay lại trang chủ</a>
                    </div>
                </div>
            </div>

            <?php if (!$product): ?>
                <div class="alert alert-danger text-center mt-4">
                    <h4>Không tìm thấy sản phẩm!</h4>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>