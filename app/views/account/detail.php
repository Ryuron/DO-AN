
<?php include 'app/views/shares/header.php'; ?>
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
 
  </style>
</head>

<h2>Lịch sử mua hàng</h2>

<table border="1" cellpadding="8">
    <thead>
        <tr>
            <th>Ngày mua</th>
            <th>Sản phẩm</th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orderHistory as $item): ?>
            <tr>
                <td><?= $item['created_at'] ?></td>
                <td><?= htmlspecialchars($item['product_name']) ?></td>
                <td><?= $item['quantity'] ?></td>
                <td><?= number_format($item['line_total'], 0, ',', '.') ?>đ</td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<a href="/Account/quanLyTaiKhoan" class="btn btn-secondary mt-2">Quay lại</a>