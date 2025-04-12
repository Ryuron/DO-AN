<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên người nhận</th>
            <th>SĐT</th>
            <th>Tổng tiền</th>
            <th>Trạng thái</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orders as $order): ?>
        <tr>
            <td><?= $order['id'] ?></td>
            <td><?= htmlspecialchars($order['name']) ?></td>
            <td><?= htmlspecialchars($order['phone']) ?></td>
            <td><?= number_format($order['total'], 0, ',', '.') ?>đ</td>
            <td>
                <?php
                    if (!isset($order['STATUS'])) {
                        echo 'Không xác định';
                    } else {
                        switch ($order['STATUS']) {
                            case 'Y':
                                echo '<span style="color: green;">Đã duyệt</span>';
                                break;
                            case 'N':
                                echo '<span style="color: red;">Đã hủy</span>';
                                break;
                            case 'O':
                                echo '<span style="color: orange;">Đang chờ duyệt</span>';
                                break;
                            default:
                                echo 'Không xác định';
                        }
                    }
                ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<a href="/product" class="btn btn-secondary mt-2">Quay lại trang chủ </a>