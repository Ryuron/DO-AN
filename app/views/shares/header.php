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

    <?php if (SessionHelper::isAdmin()): ?>
        <li class="nav-item">
            <a class="nav-link" href="/category/list">Quản lý danh mục</a>
        </li>
    <?php endif; ?>

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
