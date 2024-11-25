<?php include 'header.php'; ?>
<body>
        <?php include 'flowers.php'; 
            session_start();

            // Kiểm tra nếu có sản phẩm trong session và kết hợp
            if (!isset($_SESSION['flowers'])) {
                $_SESSION['flowers'] = $flowers;
            }
        ?>
        
        <div class="container pt-5 pb-5">
            <div class="button" style="display: none;">
                <button type="button" class="btn btn-success" id="addButton">Thêm</button>
                <button type="button" class="btn btn-success" id="editButton">Sửa</button>
                <button type="button" class="btn btn-danger" id="deleteButton">Xóa</button>
            </div>
            <table class="table" style="display: none;">
                <thead>
                    <tr>
                        <th scope="col">Tên hoa</th>
                        <th scope="col">Mô tả</th>
                        <th scope="col">Hình ảnh</th>
                    </tr>
                </thead>
                <tbody id="flower-table">
                    <?php foreach ($flowers as $index => $flower): ?>
                        <tr id="row-<?= $key ?>">
                            <td class="name"><?= htmlspecialchars($flower['name']) ?></td>
                            <td class="description"><?= htmlspecialchars($flower['description']) ?></td>
                            <td><img src="<?= htmlspecialchars($flower['image']) ?>" alt="" style="width: 100px; height: auto;"></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </body>
<!-- Form for add flower -->
<div id="addFlowerForm" style="display: none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 20px; border: 1px solid #ccc; z-index: 1000;">
    <h3>Thêm Hoa</h3>
    <form action="logic.php" method="post" enctype="multipart/form-data" >
        <div class="mb-3">
            <label for="addFlowerName" class="form-label">Tên Hoa</label>
            <input type="text" class="form-control" id="addFlowerName" name="name" required>
        </div>
        <div class="mb-3">
            <label for="addFlowerDescription" class="form-label">Mô Tả</label>
            <input type="text" class="form-control" id="addFlowerDescription" name="description" required>
        </div>
        <div class="mb-3">
            <label for="addFlowerImage" class="form-label">Ảnh</label>
            <input type="file" class="form-control" id="addFlowerImage" name="image" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
        <button type="button" class="btn btn-secondary" id="cancelAddButton">Hủy</button>
    </form>
</div>
    
<!-- Form for editing flower -->
<div id="editFlowerForm" style="display: none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 20px; border: 1px solid #ccc; z-index: 1000;">
    <h3>Sửa Hoa</h3>
    <form>
        <div class="mb-3">
            <label for="editFlowerName" class="form-label">Tên Hoa</label>
            <input type="text" class="form-control" id="editFlowerName" required>
        </div>
        <div class="mb-3">
            <label for="editFlowerDescription" class="form-label">Mô Tả</label>
            <input type="text" class="form-control" id="editFlowerDescription" required>
        </div>
        <div class="mb-3">
            <label for="editFlowerImage" class="form-label">Ảnh</label>
            <input type="file" class="form-control" id="editFlowerImage" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
        <button type="button" class="btn btn-secondary" id="cancelEditButton">Hủy</button>
    </form>
</div>

<!-- Form for deleting flower -->
<div id="deleteFlowerForm" style="display: none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 20px; border: 1px solid #ccc; z-index: 1000;">
    <h3>Xóa Hoa</h3>
    <form>
        <div class="mb-3">
            <label for="deleteFlowerName" class="form-label">Tên Hoa</label>
            <input type="text" class="form-control" id="deleteFlowerName" required>
        </div>
        <button type="submit" class="btn btn-danger">Xóa</button>
        <button type="button" class="btn btn-secondary" id="cancelDeleteButton">Hủy</button>
    </form>
</div>

    <script>
        document.getElementById('userButton').addEventListener('click', function() {
            document.querySelector('.button').style.display = 'none';
            document.querySelector('.table').style.display = 'block';
        });

        document.getElementById('adminButton').addEventListener('click', function() {
            document.querySelector('.button').style.display = 'inline-block';
            document.querySelector('.table').style.display = 'block';
        });
        
        document.getElementById('addButton').addEventListener('click', function() {
        document.getElementById('addFlowerForm').style.display = 'block';
        document.getElementById('editFlowerForm').style.display = 'none'; // Ẩn form sửa
        document.getElementById('deleteFlowerForm').style.display = 'none'; // Ẩn form xóa
    });

    document.getElementById('editButton').addEventListener('click', function() {
        document.getElementById('editFlowerForm').style.display = 'block';
        document.getElementById('addFlowerForm').style.display = 'none'; // Ẩn form thêm
        document.getElementById('deleteFlowerForm').style.display = 'none'; // Ẩn form xóa
    });

    document.getElementById('deleteButton').addEventListener('click', function() {
        document.getElementById('deleteFlowerForm').style.display = 'block';
        document.getElementById('addFlowerForm').style.display = 'none'; // Ẩn form thêm
        document.getElementById('editFlowerForm').style.display = 'none'; // Ẩn form sửa
    });

    document.getElementById('cancelAddButton').addEventListener('click', function() {
        document.getElementById('addFlowerForm').style.display = 'none';
    });

    document.getElementById('cancelEditButton').addEventListener('click', function() {
        document.getElementById('editFlowerForm').style.display = 'none';
    });

    document.getElementById('cancelDeleteButton').addEventListener('click', function() {
        document.getElementById('deleteFlowerForm').style.display = 'none';
    });

    // // Ngăn chặn làm mới trang khi gửi form thêm
    // document.getElementById('addFlowerForm').addEventListener('submit', function(event) {
    //     event.preventDefault(); // Ngăn chặn hành vi mặc định của form
    //     // Xử lý thêm hoa ở đây
    //     alert('Thêm hoa thành công!'); // Thông báo thành công
    //     document.getElementById('addFlowerForm').style.display = 'none'; // Ẩn form
    // });

    // // Ngăn chặn làm mới trang khi gửi form sửa
    // document.getElementById('editFlowerForm').addEventListener('submit', function(event) {
    //     event.preventDefault(); // Ngăn chặn hành vi mặc định của form
    //     // Xử lý sửa hoa ở đây
    //     alert('Sửa hoa thành công!'); // Thông báo thành công
    //     document.getElementById('editFlowerForm').style.display = 'none'; // Ẩn form
    // });

    // // Ngăn chặn làm mới trang khi gửi form xóa
    // document.getElementById('deleteFlowerForm').addEventListener('submit', function(event) {
    //     event.preventDefault(); // Ngăn chặn hành vi mặc định của form
    //     // Xử lý xóa hoa ở đây
    //     alert('Xóa hoa thành công!'); // Thông báo thành công
    //     document.getElementById('deleteFlowerForm').style.display = 'none'; // Ẩn form
    // });
    </script>
</body>
<?php include 'footer.php'; ?>