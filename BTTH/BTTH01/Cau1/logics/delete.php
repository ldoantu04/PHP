<?php
require '../flowers.php';

$id = $_GET['id'] ?? null;

if ($id !== null && isset($flowers[$id])) {
    unset($flowers[$id]);

    file_put_contents('../flowers.php', '<?php $flowers = ' . var_export($flowers, true) . '; ?>');

    header('Location: ../admin.php');
    exit;
}
?>

<a href="logics/update.php?id=<?= $key ?>" class="btn btn-warning btn-sm">Sửa</a>
<a href="logics/delete.php?id=<?= $key ?>" class="btn btn-danger btn-sm"
    onclick="return confirm('Bạn có chắc chắn muốn xóa hoa này?');">Xóa</a>