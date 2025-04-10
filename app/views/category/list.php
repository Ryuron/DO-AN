<h2>Danh sách danh mục</h2>

<a href="index.php?url=category/add" class="btn btn-success" style="margin-bottom: 10px;">➕ Thêm danh mục</a>

<table border="1" cellpadding="8" style="width: 100%; border-collapse: collapse;">
    <thead>
        <tr style="background-color: #f2f2f2;">
            <th>STT</th>
            <th>Tên danh mục</th>
            <th>Mô tả</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php $stt = 1; foreach ($categories as $category): ?>
        <tr>
            <td><?= $stt++ ?></td> <!-- STT thay cho ID -->
            <td><?= htmlspecialchars($category->name) ?></td>
            <td><?= htmlspecialchars($category->description) ?></td>
            <td>
                <a href="index.php?url=category/edit/<?= $category->id ?>" class="btn btn-warning">✏️ Sửa</a>
                <a href="index.php?url=category/delete/<?= $category->id ?>"
                   onclick="return confirm('Xoá danh mục này?');"
                   class="btn btn-danger">🗑 Xoá</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>