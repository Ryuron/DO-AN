<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <link
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        rel="stylesheet">
    <style>
        .product-image {
            max-width: 100px;
            height: auto;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Quản lý sản phẩm</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">

            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav">
                <form class="form-inline ml-auto" action="/Product/search" method="GET">
                    <input class="form-control mr-sm-2" type="search" name="keyword"
                        placeholder="Tìm sản phẩm..." aria-label="Search"
                        value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>">

                    <select class="form-control mr-sm-2" name="category_id">
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

                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Tìm</button>
                </form>

                <li class="nav-item">
                    <a class="nav-link" href="/Product/">Danh sách sản phẩm</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/Product/add">Thêm sản phẩm</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/Product/cart">Giỏ hàng</a>
                </li>

                <?php if (SessionHelper::isLoggedIn()): ?>
    <li class="nav-item">
        <a class="nav-link" href="/account/quanLyTaiKhoan">Quản lý tài khoản</a>
    </li>
    <li class="nav-item">
        <a class="nav-link"><?php echo $_SESSION['username']; ?></a>
    </li>
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