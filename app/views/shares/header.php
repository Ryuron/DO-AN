<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Quản lý sản phẩm </title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        body {
            background: #f5f5f5;
        }

        .product-image {
            max-width: 100px;
            height: auto;
        }

        .glass-navbar {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: rgba(40, 40, 40, 0.85);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            border-radius: 0 0 12px 12px;
        }

        .glass-navbar .nav-link,
        .glass-navbar .navbar-brand {
            color: #ffffff !important;
        }

        .glass-navbar .form-control {
            background-color: rgba(255, 255, 255, 0.9);
        }

        .glass-navbar .btn-outline-success {
            color: #fff;
            border-color: #28a745;
        }

        .glass-navbar .btn-outline-success:hover {
            background-color: #28a745;
            color: white;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg glass-navbar">
        <a class="navbar-brand font-weight-bold" href="/Product"> Trang chủ </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav w-100 align-items-center">
                <!-- Form tìm kiếm -->
                <form class="form-inline ml-auto mr-3" action="/Product/search" method="GET">
                    <input class="form-control mr-2" type="search" name="keyword"
                        placeholder="Tìm sản phẩm..." aria-label="Search"
                        value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>">

                    <select class="form-control mr-2" name="category_id">
                        <option value="">-- Danh mục --</option>
                        <?php
                        require_once 'app/models/CategoryModel.php';
                        $categoryModel = new CategoryModel((new Database())->getConnection());
                        $categories = $categoryModel->getCategories();
                        foreach ($categories as $cat):
                        ?>
                            <option value="<?= $cat->id ?>" <?= (isset($_GET['category_id']) && $_GET['category_id'] == $cat->id) ? 'selected' : '' ?>>
                                <?= $cat->name ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <button class="btn btn-outline-success" type="submit">Tìm</button>
                </form>

                <!-- Các liên kết menu
              <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownDanhSachSanPham" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Danh sách sản phẩm
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownDanhSachSanPham">
                        Đây là nơi bạn tự điền các mục trong danh sách sản phẩm -->
                <!-- <a class="dropdown-item" href="/Product/show/4">Sản phẩm 1</a>
                        <a class="dropdown-item" href="/Product/show/5">Sản phẩm 2</a>
                        <a class="dropdown-item" href="/Product/show/6">Sản phẩm 3</a>
                     -->
                <!-- Thêm các mục khác tại đây -->
                <!-- </div> -->
                <!-- </li> -->
                <li class="nav-item">
                    <a class="nav-link" href="/Product/cart">Giỏ hàng</a>
                </li>
                <?php if (SessionHelper::isAdmin()): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/category/list">Quản lý danh mục</a>
                    </li>
                <?php endif; ?>
                
                <?php if (SessionHelper::isLoggedIn()): ?>
                    <?php if ($_SESSION['role'] === 'admin'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/account/quanLyTaiKhoan">Quản lý tài khoản</a>
                        </li>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                        <a href="/product/listOrders">Quản lý đơn hàng</a>
                    <?php endif; ?> 
                    <li class="nav-item">
                        <a class="nav-link" href="/Product/order">Trạng thái đơn hàng</a>
                    </li>

                    <?php if (!SessionHelper::isAdmin()): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/account/quanLyTaiKhoan">
                                <i class="fa-solid fa-user"></i> <?php echo $_SESSION['username']; ?>
                            </a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/account/logout">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/account/login">Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">