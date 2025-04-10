<?php 
require_once 'app/helpers/SessionHelper.php'; 
SessionHelper::start(); 
include 'app/views/shares/header.php'; 
?>

<h2>Danh sách tài khoản</h2>
<?php if (SessionHelper::isAdmin()): ?>
    <form method="GET" action="/account/list" class="mb-3">
        <div class="input-group">
            <input 
                type="text" 
                name="keyword" 
                class="form-control" 
                placeholder="🔍 Tìm username hoặc họ tên..." 
                value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>"
                aria-label="Từ khóa tìm kiếm"
            >
            <button class="btn btn-primary" type="submit">
                Tìm kiếm
            </button>
        </div>
    </form>
<?php endif; ?>


<table class="table table-bordered">
    <thead class="table-light">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Họ và tên</th>
            <th>Quyền</th>
            <th>Lịch sử mua hàng</th>
            <th>Chỉnh sửa</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($accounts)): ?>
            <?php foreach ($accounts as $acc): ?>
                <tr>
                    <td><?= htmlspecialchars($acc->id) ?></td>
                    <td><?= htmlspecialchars($acc->username) ?></td>
                    <td><?= htmlspecialchars($acc->fullname) ?></td>
                    <td><?= htmlspecialchars($acc->role) ?></td>
                    <td>
                        <a href="/account/detail?id=<?= $acc->id ?>" class="btn btn-sm btn-info">
                            Xem chi tiết
                        </a>
                    </td>
                    <td>
                        <?php if (SessionHelper::isAdmin() || ($_SESSION['account_id'] ?? null) == $acc->id): ?>
                            <a 
                                href="/account/edit<?= SessionHelper::isAdmin() ? '?id=' . $acc->id : '' ?>" 
                                class="btn btn-sm btn-warning"
                            >
                                Sửa
                            </a>
                        <?php else: ?>
                            <span class="text-muted">Không khả dụng</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" class="text-center">Không tìm thấy tài khoản nào.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
<a href="/Product" class="btn btn-secondary mt-2">Quay lại danh sách
sản phẩm</a>