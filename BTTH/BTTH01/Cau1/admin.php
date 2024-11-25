<?php
require 'flowers.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý danh sách hoa</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <?php include 'templates/navbar.php'; ?>

    <div class="container mt-5">
        <h1 class="text-center">Quản lý danh sách hoa</h1>
        <a href="logics/create.php" class="btn btn-success mb-3">Thêm mới hoa</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tên hoa</th>
                    <th>Mô tả</th>
                    <th>Hình ảnh</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($flowers as $key => $flower): ?>
                    <tr>
                        <td><?= $flower['name'] ?></td>
                        <td><?= $flower['description'] ?></td>
                        <td><img src="<?= $flower['image'] ?>" alt="<?= $flower['name'] ?>" style="width: 100px;"></td>
                        <td>
                            <a href="logics/update.php?id=<?= $key ?>" class="btn btn-warning btn-sm">Sửa</a>
                        </td>
                        <td>
                            <a href="logics/delete.php?id=<?= $key ?>" class="btn btn-danger btn-sm">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php include 'templates/footer.php'; ?>
</body>

</html>