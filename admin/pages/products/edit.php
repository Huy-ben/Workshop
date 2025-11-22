<?php
require_once '../../includes/db.php';
$page_title = 'Sửa sản phẩm';

$errors = [];
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Lấy danh sách danh mục
$categories = fetch_all("SELECT * FROM categories WHERE status='active' ORDER BY name");

// Lấy thông tin sản phẩm
$product = fetch_single("SELECT * FROM products WHERE id = $id");

if (!$product) {
    header('Location: list.php');
    exit;
}

// Xử lý cập nhật sản phẩm
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_id = intval($_POST['category_id']);
    $name = escape_string(trim($_POST['name']));
    $description = escape_string(trim($_POST['description']));
    $price = floatval($_POST['price']);
    $stock = intval($_POST['stock']);
    $status = escape_string($_POST['status']);
    
    // Validate
    if (empty($name)) {
        $errors[] = 'Tên sản phẩm không được để trống';
    }
    if ($category_id <= 0) {
        $errors[] = 'Vui lòng chọn danh mục';
    }
    if ($price < 0) {
        $errors[] = 'Giá sản phẩm không hợp lệ';
    }
    if ($stock < 0) {
        $errors[] = 'Số lượng tồn kho không hợp lệ';
    }
    
    if (empty($errors)) {
        $sql = "UPDATE products 
                SET category_id = $category_id, name = '$name', description = '$description', 
                    price = $price, stock = $stock, status = '$status' 
                WHERE id = $id";
        if (query($sql)) {
            header('Location: list.php?msg=updated');
            exit;
        } else {
            $errors[] = 'Có lỗi xảy ra khi cập nhật sản phẩm';
        }
    }
} else {
    // Load dữ liệu hiện tại vào POST để hiển thị
    $_POST = $product;
}

include '../../includes/header.php';
?>

<div class="row mb-3">
    <div class="col-md-12">
        <h2><i class="bi bi-pencil"></i> Sửa sản phẩm</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../../index.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="list.php">Sản phẩm</a></li>
                <li class="breadcrumb-item active">Sửa sản phẩm</li>
            </ol>
        </nav>
    </div>
</div>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
            <?php foreach ($errors as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-body">
        <form method="POST" action="">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" 
                               value="<?php echo htmlspecialchars($_POST['name']); ?>" 
                               required>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Danh mục <span class="text-danger">*</span></label>
                        <select class="form-select" id="category_id" name="category_id" required>
                            <option value="">-- Chọn danh mục --</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?php echo $category['id']; ?>"
                                        <?php echo ($_POST['category_id'] == $category['id']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($category['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Mô tả</label>
                <textarea class="form-control" id="description" name="description" 
                          rows="4"><?php echo htmlspecialchars($_POST['description']); ?></textarea>
                <div class="form-text">Mô tả chi tiết về sản phẩm</div>
            </div>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="price" class="form-label">Giá (VNĐ) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="price" name="price" 
                               value="<?php echo $_POST['price']; ?>" 
                               min="0" step="1000" required>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="stock" class="form-label">Số lượng tồn kho <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="stock" name="stock" 
                               value="<?php echo $_POST['stock']; ?>" 
                               min="0" required>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="status" class="form-label">Trạng thái</label>
                        <select class="form-select" id="status" name="status">
                            <option value="active" <?php echo ($_POST['status'] == 'active') ? 'selected' : ''; ?>>
                                Hoạt động
                            </option>
                            <option value="inactive" <?php echo ($_POST['status'] == 'inactive') ? 'selected' : ''; ?>>
                                Không hoạt động
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Cập nhật sản phẩm
                </button>
                <a href="list.php" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Hủy
                </a>
            </div>
        </form>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>
