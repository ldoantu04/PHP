<?php
require 'flowers.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách các loài hoa</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <?php include 'templates/navbar.php'; ?>

    <div class="container mt-5">
        <h1 class="text-center">Danh sách các loài hoa</h1>
        <div class="row">
            <?php foreach ($flowers as $flower): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="<?= $flower['image'] ?>" class="card-img-top" alt="<?= $flower['name'] ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $flower['name'] ?></h5>
                            <p class="card-text"><?= $flower['description'] ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php include 'templates/footer.php'; ?>
</body>

</html>