<?php include 'app/views/shares/header.php'; ?>

<?php
$errors = $errors ?? [];
$_POST = $_POST ?? [];
?>

<style>
    .register-container {
        width: 500px;
        background-color: #2c3e50;
        color: white;
        margin: 50px auto;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0px 0px 10px #000;
        text-align: center;
    }

    .register-container input {
        width: 100%;
        padding: 12px;
        margin: 10px 0;
        border: none;
        border-radius: 8px;
        font-size: 16px;
    }

    .register-container button {
        padding: 10px 30px;
        border: 1px solid white;
        background: none;
        color: white;
        border-radius: 6px;
        font-size: 16px;
        cursor: pointer;
        margin-top: 20px;
    }

    .register-container a {
        color: #bdc3c7;
        text-decoration: none;
    }

    .register-container a:hover {
        color: #ffffff;
    }

    .text-danger {
        color: #e74c3c !important;
        font-size: 14px;
        display: block;
        text-align: left;
        margin-top: -5px;
    }

    .password-container {
        position: relative;
    }

    .toggle-password {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        font-size: 18px;
        color: #aaa;
        user-select: none;
    }
</style>

<div class="register-container">
    <h2>REGISTER</h2>
    <p>Vui lòng nhập đầy đủ thông tin để đăng ký</p>

    <form action="/account/save" method="post">
        <!-- Username -->
        <input type="text" name="username" placeholder="Username" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
        <?php if (!empty($errors['username'])): ?>
            <small class="text-danger"><?= $errors['username'] ?></small>
        <?php endif; ?>

        <!-- Họ và tên -->
        <input type="text" name="fullname" placeholder="Họ và tên" value="<?= htmlspecialchars($_POST['fullname'] ?? '') ?>">
        <?php if (!empty($errors['fullname'])): ?>
            <small class="text-danger"><?= $errors['fullname'] ?></small>
        <?php endif; ?>
        <!-- Số điện thoại -->
        <input type="text" name="phone" placeholder="Số điện thoại" value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">
        <?php if (!empty($errors['phone'])): ?>
            <small class="text-danger"><?= $errors['phone'] ?></small>
        <?php endif; ?>

        <!-- Mật khẩu -->
        <div class="password-container">
            <input type="password" name="password" placeholder="Mật khẩu tối thiểu 6 kí tự, gồm chữ hoa chữ thường"
                id="password" value="<?= htmlspecialchars($_POST['password'] ?? '') ?>">
            <span class="toggle-password" onclick="togglePassword('password', this)">👁</span>
        </div>
        <?php if (!empty($errors['password'])): ?>
            <small class="text-danger"><?= $errors['password'] ?></small>
        <?php endif; ?>
        <!-- Xác nhận mật khẩu -->
        <div class="password-container">
            <input type="password" name="confirmpassword" placeholder="Xác nhận mật khẩu" id="confirmpassword">
            <span class="toggle-password" onclick="togglePassword('confirmpassword', this)">👁</span>
        </div>
        <?php if (!empty($errors['confirmPass'])): ?>
            <small class="text-danger"><?= $errors['confirmPass'] ?></small>
        <?php endif; ?>

        <?php if (!empty($errors['account'])): ?>
            <small class="text-danger"><?= $errors['account'] ?></small>
        <?php endif; ?>

        <button type="submit">Đăng ký</button>
        <p class="mt-3">Đã có tài khoản? <a href="/account/login">Đăng nhập</a></p>
    </form>
</div>

<script>
    function togglePassword(id, icon) {
        const input = document.getElementById(id);
        if (input.type === "password") {
            input.type = "text";
            icon.textContent = "🙈";
        } else {
            input.type = "password";
            icon.textContent = "👁";
        }
    }
</script>

<?php include 'app/views/shares/footer.php'; ?>