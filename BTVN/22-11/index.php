<?php include 'header.php'; ?>

<body>
    <?php include 'products.php'; ?>

    <div class="container pt-5 pb-5">
        <div class="header">
            <button onclick="addRow()" type="button" class="btn btn-success">Thêm mới</button>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Sản phẩm</th>
                    <th scope="col">Giá thành</th>
                    <th scope="col">Sửa</th>
                    <th scope="col">Xóa</th>
                </tr>
            </thead>
            <tbody id="product-table">
                <?php foreach ($products as $key => $product): ?>
                    <tr id="row-<?= $key ?>">
                        <td class="name"><?= htmlspecialchars($product['name']) ?></td>
                        <td class="price"><?= htmlspecialchars($product['price']) ?> VND</td>
                        <td>
                            <button onclick="editRow(<?= $key ?>)" class="edit btn btn-warning">
                                <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                            </button>
                        </td>
                        <td>
                            <button onclick="deleteRow(<?= $key ?>, '<?= htmlspecialchars($product['name']) ?>')" class="delete btn btn-danger">
                                <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
        function deleteRow(key, name) {
            if (confirm('Bạn có chắc chắn muốn xóa sản phẩm: ' + name + '?')) {
                const row = document.getElementById('row-' + key);
                if (row) {
                    row.remove();
                    alert('Xóa sản phẩm thành công!');
                }
            }
        }

        function editRow(key) {
            const row = document.getElementById('row-' + key);
            if (!row) {
                alert('Không tìm thấy sản phẩm để chỉnh sửa!');
                return;
            }

            // Lấy dữ liệu hiện tại
            const currentName = row.querySelector('.name').textContent.trim();
            const currentPrice = row.querySelector('.price').textContent.trim().replace(' VND', '');

            // Yêu cầu người dùng nhập thông tin mới
            const newName = prompt('Nhập tên mới cho sản phẩm:', currentName);
            if (newName === null || newName.trim() === '') {
                alert('Tên sản phẩm không được để trống!');
                return;
            }

            const newPrice = prompt('Nhập giá mới cho sản phẩm:', currentPrice);
            if (newPrice === null || isNaN(newPrice) || newPrice.trim() === '') {
                alert('Giá sản phẩm phải là một số hợp lệ!');
                return;
            }

            // Cập nhật thông tin trong bảng
            row.querySelector('.name').textContent = newName;
            row.querySelector('.price').textContent = newPrice + ' VND';

            alert('Sửa sản phẩm thành công!');
        }

        function addRow() {
            // Yêu cầu người dùng nhập thông tin sản phẩm mới
            const newName = prompt('Nhập tên sản phẩm mới:');
            if (newName === null || newName.trim() === '') {
                alert('Tên sản phẩm không được để trống!');
                return;
            }

            const newPrice = prompt('Nhập giá sản phẩm mới:');
            if (newPrice === null || isNaN(newPrice) || newPrice.trim() === '') {
                alert('Giá sản phẩm phải là một số hợp lệ!');
                return;
            }

            // Tạo key mới dựa trên số lượng hiện tại
            const tableBody = document.getElementById('product-table');
            const newKey = tableBody.children.length;

            // Tạo dòng mới trong bảng
            const newRow = document.createElement('tr');
            newRow.id = 'row-' + newKey; // gán cho dòng mới 1 id có dạng 'row-<key>'

            newRow.innerHTML = `
        <td class="name">${newName}</td>
        <td class="price">${newPrice} VND</td>
        <td>
            <button onclick="editRow(${newKey})" class="edit btn btn-warning">
                <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
            </button>
        </td>
        <td>
            <button onclick="deleteRow(${newKey}, '${newName}')" class="delete btn btn-danger">
                <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
            </button>
        </td>
    `;

            // Thêm dòng mới vào bảng
            tableBody.appendChild(newRow);

            alert('Thêm sản phẩm mới thành công!');
        }
    </script>
</body>

<?php include 'footer.php'; ?>