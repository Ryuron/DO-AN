<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" href="/Product/">Danh sách sản phẩm</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/Product/add">Thêm sản phẩm</a>
    </li>

    <?php if(SessionHelper::isLoggedIn()): ?>
        <?php if ($_SESSION['role'] === 'admin'): ?>
            <li class="nav-item">
                <a class="nav-link" href="/account/quanLyTaiKhoan">Quản lý tài khoản</a>
            </li>
        <?php endif; ?>
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
