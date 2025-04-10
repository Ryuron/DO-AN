<h2>Lịch sử mua hàng</h2>
<table border="1" cellpadding="8">
    <thead>
        <tr>
            <th>Tài khoản</th>
            <th>Ngày mua</th>
            <th>Sản phẩm</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
            <th>Tổng đơn</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orderHistory as $item): ?>
            <tr>
                <td><?= htmlspecialchars($item['account_name']) ?></td>
                <td><?= $item['created_at'] ?></td>
                <td><?= htmlspecialchars($item['product_name']) ?></td>
                <td><?= number_format($item['product_price'], 0, ',', '.') ?>đ</td>
                <td><?= $item['quantity'] ?></td>
                <td><?= number_format($item['line_total'], 0, ',', '.') ?>đ</td>
                <td><?= number_format($item['order_total'], 0, ',', '.') ?>đ</td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
