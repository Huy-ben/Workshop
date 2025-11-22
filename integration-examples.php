<?php
/**
 * Ví dụ tích hợp Workshop Admin Template vào dự án PHP
 * Example: Integration Workshop Admin Template into existing PHP project
 */

// ============================================
// VÍ DỤ 1: Hiển thị danh mục trên trang chủ
// ============================================

require_once 'admin/includes/db.php';

// Lấy tất cả danh mục đang hoạt động
$categories = fetch_all("SELECT * FROM categories WHERE status='active' ORDER BY name");

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh mục sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Danh mục sản phẩm</h1>
        <div class="row">
            <?php foreach ($categories as $category): ?>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($category['name']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($category['description']); ?></p>
                            <a href="products.php?cat=<?php echo $category['id']; ?>" class="btn btn-primary">
                                Xem sản phẩm
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>

<?php
// ============================================
// VÍ DỤ 2: Hiển thị sản phẩm theo danh mục
// ============================================

// File: products.php

require_once 'admin/includes/db.php';

// Lấy ID danh mục từ URL
$category_id = isset($_GET['cat']) ? intval($_GET['cat']) : 0;

// Lấy thông tin danh mục
$category = fetch_single("SELECT * FROM categories WHERE id = $category_id");

if (!$category) {
    die("Danh mục không tồn tại");
}

// Lấy sản phẩm trong danh mục
$products = fetch_all("SELECT * FROM products 
                       WHERE category_id = $category_id 
                       AND status = 'active' 
                       ORDER BY created_at DESC");

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sản phẩm - <?php echo htmlspecialchars($category['name']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1><?php echo htmlspecialchars($category['name']); ?></h1>
        <p class="lead"><?php echo htmlspecialchars($category['description']); ?></p>
        
        <div class="row">
            <?php if (count($products) > 0): ?>
                <?php foreach ($products as $product): ?>
                    <div class="col-md-3 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars($product['description']); ?></p>
                                <p class="text-primary fw-bold">
                                    <?php echo number_format($product['price'], 0, ',', '.'); ?> đ
                                </p>
                                <p class="text-muted">
                                    Còn lại: <?php echo $product['stock']; ?> sản phẩm
                                </p>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary w-100">Thêm vào giỏ</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-info">Chưa có sản phẩm trong danh mục này</div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>

<?php
// ============================================
// VÍ DỤ 3: Tìm kiếm sản phẩm
// ============================================

// File: search.php

require_once 'admin/includes/db.php';

$keyword = isset($_GET['q']) ? escape_string(trim($_GET['q'])) : '';
$results = [];

if (!empty($keyword)) {
    $results = fetch_all("SELECT p.*, c.name as category_name 
                         FROM products p 
                         LEFT JOIN categories c ON p.category_id = c.id 
                         WHERE (p.name LIKE '%$keyword%' OR p.description LIKE '%$keyword%') 
                         AND p.status = 'active'
                         ORDER BY p.name");
}

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Tìm kiếm: <?php echo htmlspecialchars($keyword); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Kết quả tìm kiếm</h1>
        
        <form method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="q" class="form-control" 
                       placeholder="Nhập từ khóa tìm kiếm..." 
                       value="<?php echo htmlspecialchars($keyword); ?>">
                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
            </div>
        </form>
        
        <?php if (!empty($keyword)): ?>
            <p>Tìm thấy <strong><?php echo count($results); ?></strong> sản phẩm cho từ khóa 
               "<strong><?php echo htmlspecialchars($keyword); ?></strong>"</p>
            
            <?php if (count($results) > 0): ?>
                <div class="row">
                    <?php foreach ($results as $product): ?>
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                                    <p class="text-muted">
                                        <small><?php echo htmlspecialchars($product['category_name']); ?></small>
                                    </p>
                                    <p class="card-text">
                                        <?php echo htmlspecialchars(substr($product['description'], 0, 100)) . '...'; ?>
                                    </p>
                                    <p class="text-primary fw-bold">
                                        <?php echo number_format($product['price'], 0, ',', '.'); ?> đ
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="alert alert-warning">Không tìm thấy sản phẩm nào</div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
// ============================================
// VÍ DỤ 4: API JSON cho mobile app
// ============================================

// File: api/products.php

require_once '../admin/includes/db.php';

header('Content-Type: application/json; charset=utf-8');

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'categories':
        // Lấy tất cả danh mục
        $data = fetch_all("SELECT id, name, description FROM categories WHERE status='active'");
        echo json_encode([
            'success' => true,
            'data' => $data
        ], JSON_UNESCAPED_UNICODE);
        break;
        
    case 'products':
        // Lấy sản phẩm theo danh mục
        $cat_id = isset($_GET['category_id']) ? intval($_GET['category_id']) : 0;
        
        if ($cat_id > 0) {
            $sql = "SELECT id, name, description, price, stock 
                    FROM products 
                    WHERE category_id = $cat_id AND status='active'";
        } else {
            $sql = "SELECT id, name, description, price, stock 
                    FROM products 
                    WHERE status='active'";
        }
        
        $data = fetch_all($sql);
        echo json_encode([
            'success' => true,
            'data' => $data
        ], JSON_UNESCAPED_UNICODE);
        break;
        
    case 'product_detail':
        // Lấy chi tiết một sản phẩm
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $product = fetch_single("SELECT p.*, c.name as category_name 
                                FROM products p 
                                LEFT JOIN categories c ON p.category_id = c.id 
                                WHERE p.id = $id");
        
        if ($product) {
            echo json_encode([
                'success' => true,
                'data' => $product
            ], JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Sản phẩm không tồn tại'
            ], JSON_UNESCAPED_UNICODE);
        }
        break;
        
    default:
        echo json_encode([
            'success' => false,
            'message' => 'Action không hợp lệ'
        ], JSON_UNESCAPED_UNICODE);
}

// ============================================
// VÍ DỤ 5: Widget hiển thị sản phẩm mới
// ============================================

// File: widgets/latest-products.php

function display_latest_products($limit = 5) {
    require_once __DIR__ . '/../admin/includes/db.php';
    
    $products = fetch_all("SELECT * FROM products 
                          WHERE status='active' 
                          ORDER BY created_at DESC 
                          LIMIT $limit");
    
    echo '<div class="latest-products">';
    echo '<h3>Sản phẩm mới nhất</h3>';
    echo '<div class="row">';
    
    foreach ($products as $product) {
        echo '<div class="col-md-6 mb-3">';
        echo '  <div class="card">';
        echo '    <div class="card-body">';
        echo '      <h6>' . htmlspecialchars($product['name']) . '</h6>';
        echo '      <p class="text-primary">' . number_format($product['price']) . ' đ</p>';
        echo '    </div>';
        echo '  </div>';
        echo '</div>';
    }
    
    echo '</div>';
    echo '</div>';
}

// Sử dụng trong trang chủ:
// display_latest_products(6);

?>
