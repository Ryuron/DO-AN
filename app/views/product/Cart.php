<?php include 'app/views/shares/header.php'; ?>
<h1>Giỏ hàng</h1>

<?php if (!empty($cart)): ?>
    <ul class="list-group">
        <?php $total = 0; ?>
        <?php foreach ($cart as $id => $item): ?>
            <?php $itemTotal = $item['price'] * $item['quantity']; ?>
            <?php $total += $itemTotal; ?>
            <li class="list-group-item">
                <h2><?php echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?></h2>

                <?php if (!empty($item['image'])): ?>
                    <img src="/<?php echo htmlspecialchars($item['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="Product Image" style="max-width: 100px;">
                <?php endif; ?>

                <p>Giá: <?php echo number_format($item['price']); ?> VND</p>

                <div style="display: flex; align-items: center; gap: 10px;">
                    <form action="/Product/cartupdate" method="post" style="display: inline;">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="action" value="decrease">
                        <button class="btn btn-sm btn-warning">−</button>
                    </form>

                    <strong><?php echo htmlspecialchars($item['quantity'], ENT_QUOTES, 'UTF-8'); ?></strong>

                    <form action="/Product/cartupdate" method="post" style="display: inline;">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="action" value="increase">
                        <button class="btn btn-sm btn-success">+</button>
                    </form>

                    <form action="/Product/cartdelete" method="post" style="display: inline;">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <button class="btn btn-sm btn-danger">Xóa</button>
                    </form>
                </div>

                <p>Tạm tính: <?php echo number_format($itemTotal); ?> VND</p>
            </li>
        <?php endforeach; ?>
    </ul>

    <h3 class="mt-3">Tổng tiền: <?php echo number_format($total); ?> VND</h3>

<?php else: ?>
    <p>Giỏ hàng của bạn đang trống.</p>
<?php endif; ?>

<a href="/Product" class="btn btn-secondary mt-2">Tiếp tục mua sắm</a>
<?php if (!empty($cart)): ?>
<a href="/Product/checkout" class="btn btn-primary mt-2">Thanh Toán</a>
<?php endif; ?>

<?php include 'app/views/shares/footer.php'; ?>
