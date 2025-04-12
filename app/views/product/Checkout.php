<?php include 'app/views/shares/header.php'; ?>
<h1 style="color:aliceblue">Thanh toán</h1>

<?php
$name = $account['fullname'] ?? '';
$phone = $account['phone'] ?? '';
$address = $account['address'] ?? '';
?>

<form method="POST" action="/Product/processCheckout">
    <div class="form-group">
        <label for="name">Họ tên:</label>
        <input type="text" id="name" name="name" class="form-control" value="<?= htmlspecialchars($name) ?>" required>
    </div>
    <div class="form-group">
        <label for="phone" style="color:aliceblue">Số điện thoại:</label>
        <input type="text" id="phone" name="phone" class="form-control" value="<?= htmlspecialchars($phone) ?>" required>
    </div>
    <div class="form-group">
        <label for="address" style="color:aliceblue">Địa chỉ:</label>
        <textarea id="address" name="address" class="form-control" required><?= htmlspecialchars($address) ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Thanh toán</button>
</form>
<a href="/Product/cart" class="btn btn-secondary mt-2">Quay lại giỏ hàng</a>
<?php include 'app/views/shares/footer.php'; ?>