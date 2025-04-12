<?php include 'app/views/shares/header.php'; ?>

<div class="glass-cart p-4 mt-4">
    <h1 style="color: #ffffff; text-align: center; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);">Giỏ hàng</h1>

    <?php if (!SessionHelper::isLoggedIn()): ?>
        <div id="popup">
            <div class="popup-content">
                <span class="close-btn" onclick="closePopup()">×</span>
                <p style="color: #333;">Vui lòng đăng nhập tài khoản để thêm vào giỏ hàng và thanh toán dễ dàng hơn.</p>
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
                <li class="list-group-item cart-item">
                    <div>
                        <h2 style="color: #ffffff; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);">
                            <?php echo htmlspecialchars($item['name']); ?>
                        </h2>

                        <?php if (!empty($item['image'])): ?>
                            <img src="/<?php echo htmlspecialchars($item['image']); ?>" style="max-width: 100px; margin-bottom: 10px;">
                        <?php endif; ?>

                        <p style="color: #ffffff; margin: 5px 0;">Giá: <?php echo number_format($item['price']); ?> VND</p>
                    </div>

                    <div class="cart-right">
                        <div class="quantity-top">Số lượng: <?php echo $item['quantity']; ?></div>

                        <div class="action-buttons">
                            <form action="/Product/updateCart" method="post">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <input type="hidden" name="action" value="decrease">
                                <button class="btn btn-warning btn-sm">−</button>
                            </form>

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

                        <div class="item-subtotal">Tạm tính: <?php echo number_format($itemTotal); ?> VND</div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>

        <h3 class="mt-3" style="color: #ffffff; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);">Tổng tiền: <?php echo number_format($total); ?> VND</h3>

        <a href="/Product/checkout" class="btn btn-primary mt-3">Thanh Toán</a>
    <?php else: ?>
        <p style="color: #ffffff;">Giỏ hàng của bạn đang trống.</p>
    <?php endif; ?>

    <a href="/Product" class="btn btn-secondary mt-2">Tiếp tục mua sắm</a>
</div>

<style>
    .glass-cart {
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 12px;
        color: white;
    }

    .list-group-item {
        background: transparent;
        border: 1px solid rgba(255, 255, 255, 0.2);
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 15px;
        padding: 15px;
        position: relative;
        min-height: 180px;
    }

    .btn {
        font-size: 14px;
    }

    .cart-right {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 10px;
        min-width: 180px;
        position: absolute;
        bottom: 15px;
        right: 15px;
    }

    .quantity-top {
        color: #ffffff;
        font-weight: bold;
        font-size: 15px;
    }

    .action-buttons {
        display: grid;
        grid-template-columns: repeat(3, auto);
        gap: 8px;
    }

    .action-buttons form button {
        min-width: 40px;
        font-size: 14px;
        padding: 5px 10px;
        border-radius: 6px;
    }

    .action-buttons form button.btn-warning:hover {
        background-color: #e0a800;
    }

    .action-buttons form button.btn-success:hover {
        background-color: #218838;
    }

    .action-buttons form button.btn-danger:hover {
        background-color: #c82333;
    }

    .item-subtotal {
        color: #ffffff;
        font-style: italic;
        font-size: 15px;
    }

    /* Popup */
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

    @media (max-width: 768px) {
        .list-group-item.cart-item {
            flex-direction: column;
            align-items: stretch;
        }

        .cart-right {
            align-items: flex-start;
        }

        .action-buttons {
            grid-template-columns: repeat(auto-fit, minmax(80px, 1fr));
            width: 100%;
        }

        .action-buttons form button {
            width: 100%;
        }
    }
</style>

<script>
    function closePopup() {
        document.getElementById("popup").style.display = "none";
    }
</script>

<?php include 'app/views/shares/footer.php'; ?>
