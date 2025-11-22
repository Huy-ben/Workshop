<?php
require_once 'includes/db.php';
$page_title = 'Dashboard';

// Lấy thống kê
$total_categories = fetch_single("SELECT COUNT(*) as count FROM categories WHERE status='active'")['count'];
$total_products = fetch_single("SELECT COUNT(*) as count FROM products WHERE status='active'")['count'];
$total_stock = fetch_single("SELECT SUM(stock) as total FROM products WHERE status='active'")['total'] ?? 0;
$total_value = fetch_single("SELECT SUM(price * stock) as total FROM products WHERE status='active'")['total'] ?? 0;

// Lấy sản phẩm mới nhất
$recent_products = fetch_all("SELECT p.*, c.name as category_name 
                              FROM products p 
                              LEFT JOIN categories c ON p.category_id = c.id 
                              ORDER BY p.created_at DESC 
                              LIMIT 5");

include 'includes/header.php';
?>

<div class="row">
    <div class="col-12">
        <h1 class="mb-4"><i class="bi bi-speedometer2"></i> Dashboard</h1>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-white bg-primary mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Danh mục</h5>
                        <h2 class="mb-0"><?php echo $total_categories; ?></h2>
                    </div>
                    <div>
                        <i class="bi bi-folder display-4"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="pages/categories/list.php" class="text-white text-decoration-none">
                    Xem chi tiết <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card text-white bg-success mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Sản phẩm</h5>
                        <h2 class="mb-0"><?php echo $total_products; ?></h2>
                    </div>
                    <div>
                        <i class="bi bi-box-seam display-4"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="pages/products/list.php" class="text-white text-decoration-none">
                    Xem chi tiết <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card text-white bg-warning mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Tồn kho</h5>
                        <h2 class="mb-0"><?php echo number_format($total_stock); ?></h2>
                    </div>
                    <div>
                        <i class="bi bi-archive display-4"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <small class="text-white">Tổng số lượng sản phẩm</small>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card text-white bg-info mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Giá trị</h5>
                        <h2 class="mb-0"><?php echo number_format($total_value / 1000000, 1); ?>M</h2>
                    </div>
                    <div>
                        <i class="bi bi-currency-dollar display-4"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <small class="text-white">Tổng giá trị tồn kho (VNĐ)</small>
            </div>
        </div>
    </div>
</div>

<!-- Recent Products -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-clock-history"></i> Sản phẩm mới nhất</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên sản phẩm</th>
                                <th>Danh mục</th>
                                <th>Giá</th>
                                <th>Tồn kho</th>
                                <th>Trạng thái</th>
                                <th>Ngày tạo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($recent_products) > 0): ?>
                                <?php foreach ($recent_products as $product): ?>
                                    <tr>
                                        <td><?php echo $product['id']; ?></td>
                                        <td><?php echo htmlspecialchars($product['name']); ?></td>
                                        <td><?php echo htmlspecialchars($product['category_name']); ?></td>
                                        <td><?php echo number_format($product['price'], 0, ',', '.'); ?> đ</td>
                                        <td><?php echo $product['stock']; ?></td>
                                        <td>
                                            <?php if ($product['status'] == 'active'): ?>
                                                <span class="badge bg-success">Hoạt động</span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">Không hoạt động</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo date('d/m/Y H:i', strtotime($product['created_at'])); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center">Không có sản phẩm nào</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
