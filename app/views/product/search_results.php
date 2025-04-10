<?php include 'app/views/shares/header.php'; ?>
<h2>Kết quả tìm kiếm cho từ khóa: <strong><?php echo htmlspecialchars($_GET['keyword'] ?? ''); ?></strong></h2>
<?php if (empty($products)): ?>
    <div class="alert alert-warning">Không tìm thấy sản phẩm nào phù hợp.</div>
<?php else: ?>
    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="/<?php echo $product->image; ?>" class="card-img-top product-image" alt="<?php echo $product->name; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $product->name; ?></h5>
                        <p class="card-text"><?php echo $product->description; ?></p>
                        <p class="card-text"><strong><?php echo number_format($product->price); ?> VND</strong></p>
                        <p class="card-text"><small class="text-muted">Danh mục: <?php echo $product->category_name; ?></small></p>
                        <a href="/Product/show/<?php echo $product->id; ?>" class="btn btn-sm btn-outline-primary">Xem chi tiết</a>
                        <a href="/Product/addToCart/<?php echo $product->id; ?>" class="btn btn-sm btn-success">Thêm vào giỏ</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
<a href="/Product" class="btn btn-secondary mt-2">Quay lại danh sách sản phẩm</a>
<?php include 'app/views/shares/footer.php'; ?>