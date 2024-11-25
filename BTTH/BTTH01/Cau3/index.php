<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cau3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Doc CSV</h1>
        <form action="" method="POST" enctype="multipart/form-data" class="mb-5">
            <div class="mb-3">
                <label for="csvFile" class="form-label">Chọn tệp CSV:</label>
                <input type="file" name="csvFile" id="csvFile" class="form-control" accept=".csv" required>
            </div>
            <button type="submit" name="upload" class="btn btn-primary">Upload và Hiển thị</button>
        </form>

        <?php
        // Kiểm tra nếu form đã được submit
        if (isset($_POST['upload'])) {
            // Kiểm tra tệp được upload
            if (isset($_FILES['csvFile']) && $_FILES['csvFile']['error'] == 0) { 
                $filename = $_FILES['csvFile']['tmp_name'];
                $sinhvien = [];

                // Đọc tệp CSV
                if (($handle = fopen($filename, "r")) !== FALSE) {
                    $headers = fgetcsv($handle, 1000, ",");

                    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                        $sinhvien[] = array_combine($headers, $data);
                    }

                    fclose($handle);

                    // Hiển thị dữ liệu lên bảng
                    if (!empty($sinhvien)) {
                        echo '<h2 class="text-center">Danh sách sinh viên</h2>';
                        echo '<table class="table table-bordered table-striped">';
                        echo '<thead class="table-dark">';
                        echo '<tr>';
                        foreach ($headers as $header) {
                            echo "<th>$header</th>";
                        }
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';
                        foreach ($sinhvien as $sv) {
                            echo '<tr>';
                            foreach ($headers as $header) {
                                echo "<td>{$sv[$header]}</td>";
                            }
                            echo '</tr>';
                        }
                        echo '</tbody>';
                        echo '</table>';
                    } else {
                        echo '<div class="alert alert-warning">Tệp CSV không chứa dữ liệu!</div>';
                    }
                } else {
                    echo '<div class="alert alert-danger">Không thể đọc tệp CSV!</div>';
                }
            } else {
                echo '<div class="alert alert-danger">Vui lòng chọn tệp CSV hợp lệ!</div>';
            }
        }
        ?>
    </div>
</body>
</html>
