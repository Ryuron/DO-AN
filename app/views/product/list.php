<?php include 'app/views/shares/header.php'; ?>
<h1>Danh sách sản phẩm</h1>

<?php if (SessionHelper::isAdmin()): ?>
  <a href="/Product/add" class="btn btn-success mb-2">Thêm sản phẩm mới</a>
<?php endif; ?>

<div class="product-grid">
  <?php foreach ($products as $product): ?>
    <div class="product-card">
      <h2>
        <a href="/Product/show/<?php echo $product->id; ?>">
          <?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>
        </a>
      </h2>

      <?php if ($product->image): ?>
        <img src="/<?php echo $product->image; ?>" alt="Product Image">
      <?php endif; ?>

      <p><?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?></p>
      <p>Giá: <?php echo htmlspecialchars($product->price, ENT_QUOTES, 'UTF-8'); ?> VND</p>
      <p>Danh mục: <?php echo htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8'); ?></p>

      <?php if (SessionHelper::isAdmin()): ?>
        <a href="/Product/edit/<?php echo $product->id; ?>" class="btn btn-warning">Sửa</a>
        <a href="/Product/delete/<?php echo $product->id; ?>"
          class="btn btn-danger"
          onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">Xóa</a>
      <?php endif; ?>
    </div>
  <?php endforeach; ?>
</div>

<!-- Popup đăng nhập -->
<div id="login-popup" class="popup-overlay" style="display: none;">
  <div class="popup">
    <span class="close" onclick="closePopup()">&times;</span>
    <h2></h2>
    <p>Vui lòng đăng nhập tài khoản để thêm vào giỏ hàng và thanh toán dễ dàng hơn.</p>
    <button onclick="window.location.href='/account/register'">Đăng ký</button>
    <button onclick="window.location.href='/account/login'">Đăng nhập</button>
  </div>
</div>

<!-- CSS và JS -->
<style>
  /* Nền toàn trang */
  body {
    background-image: url('https://tipsmake.com/data/images/beautiful-technology-background-picture-4-1xJsgdLW6.jpg');
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center;
    color: white;
    position: relative;
    z-index: 1;
  }

  /* Lớp phủ làm mờ nền */
  body::before {
    content: "";
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: -1;
  }

  /* Product Grid */
  .product-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: flex-start;
    margin-top: 20px;
  }

  .product-card {
    background: rgba(255, 255, 255, 0.9);
    color: black;
    border: 1px solid #ddd;
    border-radius: 12px;
    padding: 15px;
    width: calc(33.333% - 20px);
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  }

  .product-card img {
    max-width: 100%;
    height: auto;
    display: block;
    margin-bottom: 10px;
  }

  @media (max-width: 768px) {
    .product-card {
      width: calc(50% - 20px);
    }
  }

  @media (max-width: 480px) {
    .product-card {
      width: 100%;
    }
  }

  /* Popup */
  .popup-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
  }

  .popup {
    background: white;
    padding: 20px;
    border-radius: 12px;
    text-align: center;
    width: 300px;
    position: relative;
  }

  .popup .close {
    position: absolute;
    top: 10px;
    right: 15px;
    cursor: pointer;
    font-size: 20px;
  }

  .popup button {
    margin: 10px;
    padding: 10px 20px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
  }

  .popup button:first-of-type {
    background: white;
    border: 1px solid #ff3c3c;
    color: #ff3c3c;
  }

  .popup button:last-of-type {
    background: linear-gradient(to right, #ff3c3c, #ff5f5f);
    color: white;
  }
</style>

<script>
  document.querySelectorAll('.add-to-cart-popup').forEach(function(btn) {
    btn.addEventListener('click', function(e) {
      e.preventDefault();
      document.getElementById('login-popup').style.display = 'flex';
    });
  });

  function closePopup() {
    document.getElementById('login-popup').style.display = 'none';
  }
</script>

<?php include 'app/views/shares/footer.php'; ?>