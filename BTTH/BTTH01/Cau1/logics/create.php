<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm mới hoa</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Thêm mới hoa</h1>
        <form action="create.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Tên hoa:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="description">Mô tả:</label>
                <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label for="image">Hình ảnh:</label>
                <input type="file" class="form-control-file" id="image" name="image" required>
            </div>
            <button type="submit" class="btn btn-primary">Lưu</button>
            <a href="../admin.php" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</body>

</html>
<?php
require '../flowers.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newFlower = [
        'name' => $_POST['name'],
        'description' => $_POST['description'],
        'image' => 'assets/images/' . $_FILES['image']['name']
    ];

    // Upload ảnh
    move_uploaded_file($_FILES['image']['tmp_name'], '../' . $newFlower['image']);

    // Thêm vào mảng
    $flowers[] = $newFlower;

    // Ghi lại file flowers.php
    file_put_contents('../flowers.php', '<?php $flowers = ' . var_export($flowers, true) . '; ?>');

    header('Location: ../admin.php');
    exit;
}
?>