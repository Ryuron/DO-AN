<?php include 'app/views/shares/header.php'; ?>

<?php
$errors = $errors ?? [];
$_POST = $_POST ?? [];
?>

<style>
    .register-container {
        width: 400px;
        background-color: #2c3e50;
        color: white;
        margin: 80px auto;
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

    .register-container small {
        display: block;
        text-align: left;
        font-size: 12px;
        margin-top: -5px;
        margin-bottom: 10px;
        color: #ccc;
    }

    .text-danger {
        color: #e74c3c !important;
    }

    .register-container a {
        color: #bdc3c7;
        text-decoration: none;
    }

    .register-container a:hover {
        color: #ffffff;
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
    <p>Vui lòng điền thông tin của bạn!</p>

    <form action="/account/save" method="post" id="registerForm">
        <!-- Fullname -->
        <input type="text" name="fullname" placeholder="Full Name" value="<?= $_POST['fullname'] ?? '' ?>">
        <small>Vui lòng nhập họ và tên đầy đủ.</small>
        <?php if (!empty($errors['fullname'])): ?>
            <small class="text-danger"><?= $errors['fullname'] ?></small>
        <?php endif; ?>

        <!-- Username -->
        <input type="text" name="username" placeholder="Username" value="<?= $_POST['username'] ?? '' ?>">
        <small>Vui lòng nhập tên đăng nhập.</small>
        <?php if (!empty($errors['username'])): ?>
            <small class="text-danger"><?= $errors['username'] ?></small>
        <?php endif; ?>

        <!-- Password -->
        <div class="password-container">
            <input type="password" name="password" placeholder="Password" id="password"
                   value="<?= empty($errors['password']) ? ($_POST['password'] ?? '') : '' ?>">
            <span class="toggle-password" onclick="togglePassword('password', this)">👁</span>
        </div>
        <small>Mật khẩu phải có ít nhất 1 chữ hoa, 1 chữ thường và tối thiểu 6 ký tự.</small>
        <?php if (!empty($errors['password'])): ?>
            <small class="text-danger"><?= $errors['password'] ?></small>
        <?php endif; ?>

        <!-- Confirm Password -->
        <div class="password-container">
            <input type="password" name="confirmpassword" placeholder="Confirm Password" id="confirmpassword">
            <span class="toggle-password" onclick="togglePassword('confirmpassword', this)">👁</span>
        </div>
        <small>Vui lòng nhập lại mật khẩu.</small>
        <?php if (!empty($errors['confirmPass'])): ?>
            <small class="text-danger"><?= $errors['confirmPass'] ?></small>
        <?php endif; ?>

        <!-- Tài khoản trùng -->
        <?php if (!empty($errors['account'])): ?>
            <small class="text-danger"><?= $errors['account'] ?></small>
        <?php endif; ?>

        <button type="submit">Sign Up</button>

        <p>Already have an account? <a href="/account/login">Login</a></p>
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

    document.getElementById('registerForm').addEventListener('submit', function (e) {
        const password = document.getElementById('password').value;
        const confirm = document.getElementById('confirmpassword').value;
        const regex = /^(?=.*[a-z])(?=.*[A-Z]).{6,}$/;

        // Xóa các cảnh báo cũ
        document.querySelectorAll('.text-danger.client-error').forEach(el => el.remove());

        let valid = true;

        if (!regex.test(password)) {
            const warning = document.createElement('small');
            warning.classList.add('text-danger', 'client-error');
            warning.innerText = "Mật khẩu không hợp lệ!";
            document.getElementById('password').insertAdjacentElement('afterend', warning);
            valid = false;
        }

        if (password !== confirm) {
            const warning = document.createElement('small');
            warning.classList.add('text-danger', 'client-error');
            warning.innerText = "Mật khẩu và xác nhận chưa khớp!";
            document.getElementById('confirmpassword').insertAdjacentElement('afterend', warning);
            valid = false;
        }

        if (!valid) e.preventDefault();
    });
</script>
