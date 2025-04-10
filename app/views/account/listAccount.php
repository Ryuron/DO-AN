<?php require_once 'app/helpers/SessionHelper.php'; SessionHelper::start(); ?>
<<<<<<< HEAD
<?php include 'app/views/shares/header.php'; ?>
=======
>>>>>>> a097347fc9c01b03748e45f3ad5096adf3f7aeae

<h2>Danh sách tài khoản</h2>

<?php if (SessionHelper::isAdmin()): ?>
<!-- Admin mới có form tìm kiếm -->
<form method="GET" action="/account/list" class="mb-3">
    <div class="input-group mb-3">
        <input 
            type="text" 
            name="keyword" 
            class="form-control" 
            placeholder="Tìm kiếm theo username hoặc họ tên" 
            value="<?= isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : '' ?>"
        >
        <button class="btn btn-primary" type="submit">Tìm kiếm</button>
    </div>
</form>
<?php endif; ?>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Họ và tên</th>
            <th>Role</th>
            <th>Lịch sử mua hàng</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($accounts)): ?>
            <?php foreach ($accounts as $acc): ?>
                <tr>
                    <<td><?= htmlspecialchars($acc['id']) ?></td>
<td><?= htmlspecialchars($acc['username']) ?></td>
<td><?= htmlspecialchars($acc['fullname']) ?></td>
<td><?= htmlspecialchars($acc['role']) ?></td>

                    <td>
                    <a href="/account/detail?id=<?= $acc['id'] ?>" class="btn btn-sm btn-info">Xem chi tiết</a>

                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" class="text-center">Không tìm thấy tài khoản nào.</td>
            </tr>
        <?php endif; ?>
    </tbody>
<<<<<<< HEAD
</table>
=======
</table>
>>>>>>> a097347fc9c01b03748e45f3ad5096adf3f7aeae
