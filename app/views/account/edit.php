<h2>Cập nhật thông tin tài khoản</h2>

<form method="POST" action="/account/update">
    <label>Họ tên:</label><br>
    <input type="text" name="fullname" value="<?= htmlspecialchars($account->fullname ?? '') ?>"><br>
    <span style="color:red"><?= $errors['fullname'] ?? '' ?></span><br>

    <label>Số điện thoại:</label><br>
    <input type="text" name="phone" value="<?= htmlspecialchars($account->phone ?? '') ?>"><br>
    <span style="color:red"><?= $errors['phone'] ?? '' ?></span><br>

    <label>Địa chỉ:</label><br>
    <textarea name="address"><?= htmlspecialchars($account->address ?? '') ?></textarea><br>

    <hr>

    <h4>Đổi mật khẩu</h4>
    
    <label>Mật khẩu hiện tại:</label><br>
    <input type="password" name="current_password"><br>
    <span style="color:red"><?= $errors['current_password'] ?? '' ?></span><br>

    <label>Mật khẩu mới:</label><br>
    <input type="password" name="new_password"><br>
    <span style="color:red"><?= $errors['new_password'] ?? '' ?></span><br>

    <label>Xác nhận mật khẩu mới:</label><br>
    <input type="password" name="confirm_new_password"><br>
    <span style="color:red"><?= $errors['confirm_new_password'] ?? '' ?></span><br>

    <br>
    <button type="submit">Lưu thay đổi</button>
</form>
