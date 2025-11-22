<?php
require_once '../../includes/db.php';
$page_title = 'Thêm danh mục';

$errors = [];

// Xử lý thêm danh mục
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = escape_string(trim($_POST['name']));
    $description = escape_string(trim($_POST['description']));
    $status = escape_string($_POST['status']);
    
    // Validate
    if (empty($name)) {
        $errors[] = 'Tên danh mục không được để trống';
    }
    
    if (empty($errors)) {
        $sql = "INSERT INTO categories (name, description, status) 
                VALUES ('$name', '$description', '$status')";
        if (query($sql)) {
            header('Location: list.php?msg=added');
            exit;
        } else {
            $errors[] = 'Có lỗi xảy ra khi thêm danh mục';
        }
    }
}

include '../../includes/header.php';
?>

<div class="row mb-3">
    <div class="col-md-12">
        <h2><i class="bi bi-plus-circle"></i> Thêm danh mục mới</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../../index.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="list.php">Danh mục</a></li>
                <li class="breadcrumb-item active">Thêm mới</li>
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
                       value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>" 
                       required>
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Mô tả</label>
                <textarea class="form-control" id="description" name="description" 
                          rows="4"><?php echo isset($_POST['description']) ? htmlspecialchars($_POST['description']) : ''; ?></textarea>
                <div class="form-text">Mô tả chi tiết về danh mục</div>
            </div>
            
            <div class="mb-3">
                <label for="status" class="form-label">Trạng thái</label>
                <select class="form-select" id="status" name="status">
                    <option value="active" <?php echo (!isset($_POST['status']) || $_POST['status'] == 'active') ? 'selected' : ''; ?>>
                        Hoạt động
                    </option>
                    <option value="inactive" <?php echo (isset($_POST['status']) && $_POST['status'] == 'inactive') ? 'selected' : ''; ?>>
                        Không hoạt động
                    </option>
                </select>
            </div>
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Lưu danh mục
                </button>
                <a href="list.php" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Hủy
                </a>
            </div>
        </form>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>
