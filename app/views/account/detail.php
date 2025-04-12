<h2>Lịch sử mua hàng</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Ngày mua</th>
            <th>Sản phẩm</th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
            <th>Địa chỉ mua hàng</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orderHistory as $item): ?>
            <tr>
                <td><?= date('d/m/Y H:i', strtotime($item['created_at'])) ?></td>
                <td><?= htmlspecialchars($item['product_name']) ?></td>
                <td><?= htmlspecialchars($item['quantity']) ?></td>
                <td><?= number_format($item['line_total'], 0, ',', '.') ?>đ</td>
                <td><?= htmlspecialchars($item['address']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<a href="/Account/quanLyTaiKhoan" class="btn btn-secondary mt-2">Quay lại</a>
