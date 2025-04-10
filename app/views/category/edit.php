<h2>Cập nhật danh mục</h2>

<form action="index.php?url=category/update" method="post">
    <input type="hidden" name="id" value="<?= $category->id ?>">

    <label for="name">Tên danh mục:</label><br>
    <input type="text" id="name" name="name" value="<?= htmlspecialchars($category->name) ?>" required><br><br>

    <label for="description">Mô tả:</label><br>
    <textarea id="description" name="description"><?= htmlspecialchars($category->description) ?></textarea><br><br>

    <button type="submit" class="btn btn-primary">Cập nhật</button>
    <a href="index.php?url=category/list" class="btn btn-secondary">🔙 Quay lại</a>
</form>
