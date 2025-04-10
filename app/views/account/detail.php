<h2>Lịch sử mua hàng</h2>
<table border="1" cellpadding="8">
    <thead>
        <tr>
            <th>Ngày mua</th>
            <th>Sản phẩm</th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orderHistory as $item): ?>
            <tr>
                <td><?= $item['created_at'] ?></td>
                <td><?= htmlspecialchars($item['product_name']) ?></td>
                <td><?= $item['quantity'] ?></td>
                <td><?= number_format($item['line_total'], 0, ',', '.') ?>đ</td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>