<?php include 'app/views/shares/header.php'; ?>
<h1>Giỏ hàng</h1>

<?php if (!SessionHelper::isLoggedIn()): ?>
    <!-- Nếu chưa đăng nhập thì hiện popup -->
    <div id="popup">
        <div class="popup-content">
            <span class="close-btn" onclick="closePopup()">×</span>
            <p>Vui lòng đăng nhập tài khoản để thêm vào giỏ hàng và thanh toán dễ dàng hơn.</p>
            <a href="/Account/register" class="register-btn">Đăng ký</a>
            <a href="/Account/login" class="login-btn">Đăng nhập</a>
        </div>
    </div>
<?php endif; ?>

<?php if (!empty($cart)): ?>
    <ul class="list-group">
        <?php $total = 0; ?>
        <?php foreach ($cart as $id => $item): ?>
            <?php $itemTotal = $item['price'] * $item['quantity']; ?>
            <?php $total += $itemTotal; ?>
            <li class="list-group-item">
                <h2><?php echo htmlspecialchars($item['name']); ?></h2>

                <?php if (!empty($item['image'])): ?>
                    <img src="/<?php echo htmlspecialchars($item['image']); ?>" style="max-width: 100px;">
                <?php endif; ?>

                <p>Giá: <?php echo number_format($item['price']); ?> VND</p>

                <div style="display: flex; gap: 10px; align-items: center;">
                    <form action="/Product/updateCart" method="post">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="action" value="decrease">
                        <button class="btn btn-warning btn-sm">−</button>
                    </form>

                    <strong><?php echo $item['quantity']; ?></strong>

                    <form action="/Product/updateCart" method="post">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="action" value="increase">
                        <button class="btn btn-success btn-sm">+</button>
                    </form>

                    <form action="/Product/deleteCart" method="post">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <button class="btn btn-danger btn-sm">Xóa</button>
                    </form>
                </div>

                <p>Tạm tính: <?php echo number_format($itemTotal); ?> VND</p>
            </li>
        <?php endforeach; ?>
    </ul>

    <h3 class="mt-3">Tổng tiền: <?php echo number_format($total); ?> VND</h3>

    <a href="/Product/checkout" class="btn btn-primary mt-3">Thanh Toán</a>
<?php else: ?>
    <p>Giỏ hàng của bạn đang trống.</p>
<?php endif; ?>

<a href="/Product" class="btn btn-secondary mt-2">Tiếp tục mua sắm</a>

<style>
    #popup {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.4);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    .popup-content {
        background: white;
        padding: 30px;
        border-radius: 10px;
        text-align: center;
        position: relative;
        width: 320px;
    }

    .close-btn {
        position: absolute;
        top: 10px;
        right: 15px;
        font-size: 24px;
        cursor: pointer;
    }

    .register-btn,
    .login-btn {
        display: inline-block;
        margin: 10px 5px;
        padding: 10px 20px;
        border-radius: 8px;
        text-decoration: none;
    }

    .register-btn {
        border: 1px solid #ff4b2b;
        color: #ff4b2b;
        background: white;
    }

    .login-btn {
        background: linear-gradient(to right, #ff4b2b, #ff416c);
        color: white;
        border: none;
    }
</style>

<script>
    function closePopup() {
        document.getElementById("popup").style.display = "none";
    }
</script>

<?php include 'app/views/shares/footer.php'; ?>