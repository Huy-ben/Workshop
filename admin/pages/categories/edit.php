<?php
require_once '../../includes/db.php';
$page_title = 'Sửa danh mục';

$errors = [];
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Lấy thông tin danh mục
$category = fetch_single("SELECT * FROM categories WHERE id = $id");

if (!$category) {
    header('Location: list.php');
    exit;
}

// Xử lý cập nhật danh mục
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = escape_string(trim($_POST['name']));
    $description = escape_string(trim($_POST['description']));
    $status = escape_string($_POST['status']);
    
    // Validate
    if (empty($name)) {
        $errors[] = 'Tên danh mục không được để trống';
    }
    
    if (empty($errors)) {
        $sql = "UPDATE categories 
                SET name = '$name', description = '$description', status = '$status' 
                WHERE id = $id";
        if (query($sql)) {
            header('Location: list.php?msg=updated');
            exit;
        } else {
            $errors[] = 'Có lỗi xảy ra khi cập nhật danh mục';
        }
    }
} else {
    // Load dữ liệu hiện tại vào POST để hiển thị
    $_POST = $category;
}

include '../../includes/header.php';
?>

<div class="row mb-3">
    <div class="col-md-12">
        <h2><i class="bi bi-pencil"></i> Sửa danh mục</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../../index.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="list.php">Danh mục</a></li>
                <li class="breadcrumb-item active">Sửa danh mục</li>
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
            <div class="mb-3">
                <label for="name" class="form-label">Tên danh mục <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name" 
                       value="<?php echo htmlspecialchars($_POST['name']); ?>" 
                       required>
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Mô tả</label>
                <textarea class="form-control" id="description" name="description" 
                          rows="4"><?php echo htmlspecialchars($_POST['description']); ?></textarea>
                <div class="form-text">Mô tả chi tiết về danh mục</div>
            </div>
            
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
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Cập nhật danh mục
                </button>
                <a href="list.php" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Hủy
                </a>
            </div>
        </form>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>
