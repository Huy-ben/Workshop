<?php
require_once '../../includes/db.php';
$page_title = 'Danh sách sản phẩm';

// Xử lý xóa sản phẩm
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    query("DELETE FROM products WHERE id = $id");
    header('Location: list.php?msg=deleted');
    exit;
}

// Lấy danh sách sản phẩm với thông tin danh mục
$products = fetch_all("SELECT p.*, c.name as category_name 
                       FROM products p 
                       LEFT JOIN categories c ON p.category_id = c.id 
                       ORDER BY p.created_at DESC");

include '../../includes/header.php';
?>

<div class="row mb-3">
    <div class="col-md-6">
        <h2><i class="bi bi-box-seam"></i> Danh sách sản phẩm</h2>
    </div>
    <div class="col-md-6 text-end">
        <a href="add.php" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Thêm sản phẩm mới
        </a>
    </div>
</div>

<?php if (isset($_GET['msg'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php
        if ($_GET['msg'] == 'added') echo 'Thêm sản phẩm thành công!';
        if ($_GET['msg'] == 'updated') echo 'Cập nhật sản phẩm thành công!';
        if ($_GET['msg'] == 'deleted') echo 'Xóa sản phẩm thành công!';
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-success">
                    <tr>
                        <th>ID</th>
                        <th>Tên sản phẩm</th>
                        <th>Danh mục</th>
                        <th>Giá</th>
                        <th>Tồn kho</th>
                        <th>Trạng thái</th>
                        <th>Ngày tạo</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($products) > 0): ?>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td><?php echo $product['id']; ?></td>
                                <td><strong><?php echo htmlspecialchars($product['name']); ?></strong></td>
                                <td>
                                    <span class="badge bg-info">
                                        <?php echo htmlspecialchars($product['category_name']); ?>
                                    </span>
                                </td>
                                <td><?php echo number_format($product['price'], 0, ',', '.'); ?> đ</td>
                                <td>
                                    <?php if ($product['stock'] > 0): ?>
                                        <span class="badge bg-success"><?php echo $product['stock']; ?></span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Hết hàng</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($product['status'] == 'active'): ?>
                                        <span class="badge bg-success">Hoạt động</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Không hoạt động</span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo date('d/m/Y', strtotime($product['created_at'])); ?></td>
                                <td>
                                    <a href="edit.php?id=<?php echo $product['id']; ?>" 
                                       class="btn btn-sm btn-warning" title="Sửa">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="list.php?delete=<?php echo $product['id']; ?>" 
                                       class="btn btn-sm btn-danger" 
                                       onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')"
                                       title="Xóa">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center">Không có sản phẩm nào</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>
