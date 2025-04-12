<?php include 'app/views/shares/header.php'; ?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <script src="/assets/js/bootstrap.bundle.min.js"></script>

  <style>
    body {
      background-image: url('https://tipsmake.com/data/images/beautiful-technology-background-picture-4-1xJsgdLW6.jpg');
      background-size: cover;
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-position: center;
      color: white;
      position: relative;
      z-index: 1;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body::before {
      content: "";
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.6);
      backdrop-filter: blur(4px);
      z-index: -1;
    }

    .glass-card {
      backdrop-filter: blur(12px);
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 20px;
      box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
      padding: 30px;
      margin-top: 60px;
      color: white;
    }

    .table th, .table td {
      vertical-align: middle;
      color: white;
    }

    .table th {
      border-bottom: 1px solid rgba(255,255,255,0.3);
    }

    .status span {
      font-weight: bold;
    }

    .btn-glass {
      border: 1px solid rgba(255, 255, 255, 0.3);
      background: rgba(255, 255, 255, 0.05);
      color: white;
      backdrop-filter: blur(5px);
      transition: all 0.3s;
    }

    .btn-glass:hover {
      background: rgba(255, 255, 255, 0.15);
      color: #fff;
    }

    h2 {
      text-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
    }

  </style>
</head>
<body>
  <div class="container">
    <div class="glass-card">
      <h2 class="text-center mb-4"><i class="fa-solid fa-clock"></i> Đơn hàng chờ duyệt</h2>
      <table class="table table-hover text-white">
        <thead>
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
        </thead>
        <tbody>
          <?php foreach ($orders as $order): ?>
            <tr>
              <td><?= $order['id'] ?></td>
              <td><?= htmlspecialchars($order['name']) ?></td>
              <td><?= htmlspecialchars($order['phone']) ?></td>
              <td><?= htmlspecialchars($order['address']) ?></td>
              <td><?= number_format($order['total'], 0, ',', '.') ?>đ</td>
              <?php if ($_SESSION['role'] === 'admin'): ?>
                <td>
                  <a href="/product/approve/<?= $order['id'] ?>" class="btn-glass">
                    <i class="fa fa-check"></i> Duyệt
                  </a>
                  <a href="/product/cancel/<?= $order['id'] ?>" class="btn-glass" onclick="return confirm('Bạn có chắc muốn hủy đơn hàng này?')">
                    <i class="fa fa-times"></i> Hủy
                  </a>
                </td>
              <?php endif; ?>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <div class="text-center">
        <a href="/Product" class="btn btn-glass mt-3">
          <i class="fa fa-arrow-left"></i> Quay lại trang chủ
        </a>
      </div>
    </div>
  </div>
</body>
</html>
