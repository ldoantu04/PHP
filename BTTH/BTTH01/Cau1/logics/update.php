<?php
require '../flowers.php';

$id = $_GET['id'] ?? null;
if ($id === null || !isset($flowers[$id])) {
    header('Location: ../admin.php');
    exit;
}

$flower = $flowers[$id];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật hoa</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Cập nhật hoa</h1>
    <form action="update.php?id=<?= $id ?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Tên hoa:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= $flower['name'] ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Mô tả:</label>
            <textarea class="form-control" id="description" name="description" rows="5" required><?= $flower['description'] ?></textarea>
        </div>
        <div class="form-group">
            <label for="image">Hình ảnh:</label>
            <input type="file" class="form-control-file" id="image" name="image">
            <img src="../<?= $flower['image'] ?>" alt="<?= $flower['name'] ?>" class="mt-3" style="width: 150px;">
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="../admin.php" class="btn btn-secondary">Hủy</a>
    </form>
</div>
</body>
</html>
<?php
require '../flowers.php';

$id = $_GET['id'] ?? null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $id !== null && isset($flowers[$id])) {
    $flowers[$id]['name'] = $_POST['name'];
    $flowers[$id]['description'] = $_POST['description'];

    if (!empty($_FILES['image']['name'])) {
        $newImage = 'assets/images/' . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], '../' . $newImage);
        $flowers[$id]['image'] = $newImage;
    }

    file_put_contents('../flowers.php', '<?php $flowers = ' . var_export($flowers, true) . '; ?>');
    header('Location: ../admin.php');
    exit;
}
?>

