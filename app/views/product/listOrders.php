<h2>Đơn hàng chờ duyệt</h2>
<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Tên người nhận</th>
        <th>SĐT</th>
        <th>Địa chỉ</th>
        <th>Tổng tiền</th>
        <?php if ($_SESSION['role'] === 'admin'): ?>
            <th>Thao tác</th>
        <?php endif; ?>
    </tr>
    <?php foreach ($orders as $order): ?>
    <tr>
        <td><?= $order['id'] ?></td>
        <td><?= htmlspecialchars($order['name']) ?></td>
        <td><?= htmlspecialchars($order['phone']) ?></td>
        <td><?= htmlspecialchars($order['address']) ?></td>
        <td><?= $order['total'] ?></td>
        <?php if ($_SESSION['role'] === 'admin'): ?>
        <td>
            <a href="/product/approve/<?= $order['id'] ?>">Duyệt</a> |

            <a href="index.php?controller=order&action=cancel&id=<?= $order['id'] ?>" onclick="return confirm('Bạn có chắc muốn hủy đơn hàng này?')">Hủy</a>
        </td>
        <?php endif; ?>
    </tr>
    <?php endforeach; ?>
</table>
<a href="/product" class="btn btn-secondary mt-2">Quay lại trang chủ </a>