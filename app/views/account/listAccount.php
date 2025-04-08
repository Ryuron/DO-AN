<!-- app/views/account/listAccount.php -->
<?php include 'app/views/shares/header.php'; ?>

<h2>Danh sách tài khoản</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Họ và tên</th>
            <th>Role</th>
            <th>Hành động</th> <!-- Thêm cột -->
        </tr>
    </thead>
    <tbody>
        <?php foreach ($accounts as $acc): ?>
        <tr>
            <td><?= $acc->id ?></td>
            <td><?= $acc->username ?></td>
            <td><?= $acc->fullname ?></td>
            <td><?= $acc->role ?></td>
            <td>
                <a href="/account/detail?id=<?= $acc->id ?>" class="btn btn-sm btn-info">Xem chi tiết</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include 'app/views/shares/footer.php'; ?>
