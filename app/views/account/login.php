<?php include 'app/views/shares/header.php'; ?>

<?php
$errors = $errors ?? [];
$_POST = $_POST ?? [];
?>

<style>
    .login-container {
        width: 400px;
        background-color: #2c3e50;
        color: white;
        margin: 100px auto;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0px 0px 10px #000;
        text-align: center;
    }

    .login-container input {
        width: 100%;
        padding: 12px;
        margin: 10px 0;
        border: none;
        border-radius: 8px;
        font-size: 16px;
    }

    .login-container button {
        padding: 10px 30px;
        border: 1px solid white;
        background: none;
        color: white;
        border-radius: 6px;
        font-size: 16px;
        cursor: pointer;
        margin-top: 20px;
    }

    .login-container a {
        color: #bdc3c7;
        text-decoration: none;
    }

    .login-container a:hover {
        color: #ffffff;
    }

    .text-danger {
        color: #e74c3c !important;
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

<div class="login-container">
    <h2>LOGIN</h2>
    <p>Vui lòng nhập thông tin đăng nhập!</p>

    <form action="/account/checklogin" method="post">
        <!-- Username -->
        <input type="text" name="username" placeholder="Username" value="<?= $_POST['username'] ?? '' ?>">
        <?php if (!empty($errors['username'])): ?>
            <small class="text-danger"><?= $errors['username'] ?></small>
        <?php endif; ?>

        <!-- Password -->
        <div class="password-container">
            <input type="password" name="password" placeholder="Password" id="password">
            <span class="toggle-password" onclick="togglePassword('password', this)">👁</span>
        </div>
        <?php if (!empty($errors['password'])): ?>
            <small class="text-danger"><?= $errors['password'] ?></small>
        <?php endif; ?>

        <div class="text-start mb-3">
            <a href="/account/forgot">Quên mật khẩu?</a>
        </div>

        <button type="submit">Đăng nhập</button>

        <p class="mt-3">Bạn chưa có tài khoản? <a href="/account/register">Đăng ký</a></p>
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
