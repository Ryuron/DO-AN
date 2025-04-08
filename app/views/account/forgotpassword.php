<?php include 'app/views/shares/header.php'; ?>
<div class="container mt-5">
    <h3 class="text-center">Quên mật khẩu</h3>
    <form action="/account/forgotpassword" method="post" class="w-50 mx-auto mt-4">
        <div class="form-group">
            <label>Nhập tên đăng nhập:</label>
            <input type="text" name="username" class="form-control" placeholder="Username">
            <?php if (!empty($error)) echo "<small class='text-danger'>$error</small>"; ?>
        </div>
        <div class="form-group text-center mt-3">
            <button type="submit" class="btn btn-primary">Xác nhận</button>
        </div>
    </form>
</div>
<?php include 'app/views/shares/footer.php'; ?>
