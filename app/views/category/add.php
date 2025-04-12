<h2>Thêm danh mục mới</h2>

<form action="index.php?url=category/store" method="post">
    <label for="name">Tên danh mục:</label><br>
    <input type="text" id="name" name="name" required><br><br>

    <label for="description">Mô tả:</label><br>
    <textarea id="description" name="description"></textarea><br><br>

    <button type="submit">Thêm</button>
    <a href="index.php?url=category/list">Quay lại</a>
</form>
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