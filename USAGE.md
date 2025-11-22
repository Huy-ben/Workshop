# Hướng dẫn Sử dụng Chi tiết - Workshop Admin Template

## Mục lục
1. [Tổng quan](#tổng-quan)
2. [Cài đặt](#cài-đặt)
3. [Sử dụng cơ bản](#sử-dụng-cơ-bản)
4. [Tích hợp vào dự án](#tích-hợp-vào-dự-án)
5. [Tùy chỉnh](#tùy-chỉnh)
6. [API và Functions](#api-và-functions)
7. [Bảo mật](#bảo-mật)
8. [Mở rộng](#mở-rộng)

---

## Tổng quan

Workshop Admin Template là một template quản trị hoàn chỉnh được xây dựng với PHP và Bootstrap 5. Template này cung cấp:

- Dashboard với thống kê tổng quan
- Quản lý danh mục sản phẩm (CRUD)
- Quản lý sản phẩm (CRUD)
- Giao diện responsive, đẹp mắt
- Mã nguồn sạch, dễ tùy chỉnh

---

## Cài đặt

### Yêu cầu hệ thống

```
- PHP >= 7.4
- MySQL >= 5.7 hoặc MariaDB
- Web Server (Apache/Nginx)
- Extension: mysqli
```

### Cài đặt với XAMPP

1. Tải và cài đặt XAMPP từ https://www.apachefriends.org/

2. Copy thư mục Workshop vào `htdocs`:
```bash
C:\xampp\htdocs\Workshop
```

3. Khởi động Apache và MySQL trong XAMPP Control Panel

4. Tạo database:
   - Truy cập: http://localhost/phpmyadmin
   - Tạo database mới: `workshop_db`
   - Import file `database.sql`

5. Cấu hình (nếu cần):
   - Mở file `admin/includes/config.php`
   - Điều chỉnh thông tin database

6. Truy cập: http://localhost/Workshop/admin/

---

## Sử dụng cơ bản

### 1. Dashboard

Dashboard là trang chính hiển thị tổng quan về hệ thống:

**Thống kê hiển thị:**
- Tổng số danh mục đang hoạt động
- Tổng số sản phẩm đang hoạt động
- Tổng số lượng tồn kho
- Tổng giá trị hàng tồn kho (VNĐ)
- Bảng 5 sản phẩm mới nhất

**Truy cập:** `http://localhost/Workshop/admin/index.php`

---

### 2. Quản lý Danh mục

#### Xem danh sách danh mục

**URL:** `admin/pages/categories/list.php`

**Các cột hiển thị:**
- ID: Mã định danh danh mục
- Tên danh mục
- Mô tả
- Trạng thái: Active/Inactive
- Ngày tạo
- Thao tác: Nút Sửa và Xóa

#### Thêm danh mục mới

**URL:** `admin/pages/categories/add.php`

**Các trường:**
1. **Tên danh mục** (bắt buộc)
   - Nhập tên danh mục
   - VD: "Điện tử", "Thời trang"

2. **Mô tả** (tùy chọn)
   - Mô tả chi tiết về danh mục
   - VD: "Các sản phẩm điện tử như điện thoại, laptop"

3. **Trạng thái**
   - Active: Danh mục hoạt động
   - Inactive: Danh mục không hoạt động

**Lưu ý:**
- Tên danh mục không được để trống
- Sau khi lưu, hệ thống sẽ redirect về trang danh sách
- Hiển thị thông báo thành công

#### Sửa danh mục

**URL:** `admin/pages/categories/edit.php?id={ID}`

**Quy trình:**
1. Click nút Sửa (icon bút chì) ở danh mục cần sửa
2. Form hiển thị với dữ liệu hiện tại
3. Chỉnh sửa các trường cần thiết
4. Click "Cập nhật danh mục"

#### Xóa danh mục

**Quy trình:**
1. Click nút Xóa (icon thùng rác) ở danh mục cần xóa
2. Xác nhận trong hộp thoại
3. Danh mục và tất cả sản phẩm trong danh mục sẽ bị xóa

**⚠️ Cảnh báo:** Xóa danh mục sẽ xóa CASCADE tất cả sản phẩm!

---

### 3. Quản lý Sản phẩm

#### Xem danh sách sản phẩm

**URL:** `admin/pages/products/list.php`

**Các cột hiển thị:**
- ID
- Tên sản phẩm
- Danh mục (badge màu xanh)
- Giá (định dạng VNĐ)
- Tồn kho (badge xanh nếu còn hàng, đỏ nếu hết)
- Trạng thái
- Ngày tạo
- Thao tác: Nút Sửa và Xóa

#### Thêm sản phẩm mới

**URL:** `admin/pages/products/add.php`

**Các trường:**

1. **Tên sản phẩm** (bắt buộc)
   - Nhập tên sản phẩm
   - VD: "iPhone 15 Pro"

2. **Danh mục** (bắt buộc)
   - Chọn từ dropdown
   - Chỉ hiển thị danh mục đang hoạt động

3. **Mô tả** (tùy chọn)
   - Mô tả chi tiết sản phẩm
   - VD: "Điện thoại thông minh cao cấp của Apple"

4. **Giá (VNĐ)** (bắt buộc)
   - Nhập giá bán
   - Tính bằng VNĐ
   - VD: 29990000

5. **Số lượng tồn kho** (bắt buộc)
   - Nhập số lượng hiện có
   - VD: 50

6. **Trạng thái**
   - Active: Sản phẩm đang bán
   - Inactive: Ngừng kinh doanh

**Validation:**
- Tên không được để trống
- Phải chọn danh mục
- Giá >= 0
- Tồn kho >= 0

#### Sửa sản phẩm

**URL:** `admin/pages/products/edit.php?id={ID}`

**Quy trình:**
1. Click nút Sửa ở sản phẩm cần chỉnh sửa
2. Form hiển thị với dữ liệu hiện tại
3. Chỉnh sửa các trường
4. Click "Cập nhật sản phẩm"

#### Xóa sản phẩm

**Quy trình:**
1. Click nút Xóa ở sản phẩm cần xóa
2. Xác nhận trong hộp thoại
3. Sản phẩm sẽ bị xóa khỏi database

---

## Tích hợp vào dự án

### Tích hợp vào dự án PHP hiện có

1. **Copy thư mục admin:**
```bash
cp -r admin /path/to/your/project/
```

2. **Import database schema:**
```sql
-- Chạy các câu lệnh CREATE TABLE trong database.sql
```

3. **Cấu hình kết nối:**
```php
// Trong admin/includes/config.php
define('DB_HOST', 'your_host');
define('DB_USER', 'your_user');
define('DB_PASS', 'your_password');
define('DB_NAME', 'your_database');
define('SITE_URL', 'http://yoursite.com/admin/');
```

4. **Sử dụng các functions:**
```php
// Trong file PHP của bạn
require_once 'admin/includes/db.php';

// Lấy tất cả danh mục
$categories = fetch_all("SELECT * FROM categories");

// Lấy một sản phẩm
$product = fetch_single("SELECT * FROM products WHERE id = 1");

// Thêm dữ liệu
$name = escape_string("iPhone 15");
query("INSERT INTO products (name) VALUES ('$name')");
```

### Tích hợp với Frontend

Tạo file `frontend/products.php`:

```php
<?php
require_once '../admin/includes/db.php';

// Lấy danh mục
$categories = fetch_all("SELECT * FROM categories WHERE status='active'");

// Lấy sản phẩm theo danh mục
$category_id = isset($_GET['cat']) ? intval($_GET['cat']) : 0;
if ($category_id > 0) {
    $products = fetch_all("SELECT * FROM products 
                          WHERE category_id = $category_id 
                          AND status='active'");
} else {
    $products = fetch_all("SELECT * FROM products WHERE status='active'");
}

// Hiển thị
foreach ($products as $product) {
    echo "<h3>{$product['name']}</h3>";
    echo "<p>{$product['description']}</p>";
    echo "<p>Giá: " . number_format($product['price']) . " đ</p>";
}
?>
```

---

## Tùy chỉnh

### Thay đổi màu sắc

Chỉnh sửa `admin/css/admin-style.css`:

```css
/* Màu chính của navbar */
.navbar {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
}

/* Màu card */
.card {
    border-left: 4px solid #667eea;
}

/* Màu button */
.btn-primary {
    background-color: #667eea;
    border-color: #667eea;
}
```

### Thêm logo

Trong `admin/includes/header.php`:

```php
<a class="navbar-brand" href="<?php echo SITE_URL; ?>index.php">
    <img src="<?php echo SITE_URL; ?>assets/img/logo.png" height="30" alt="Logo">
    Workshop Admin
</a>
```

### Thêm trường mới

**Ví dụ: Thêm trường "SKU" cho sản phẩm**

1. Thêm cột trong database:
```sql
ALTER TABLE products ADD COLUMN sku VARCHAR(50) AFTER name;
```

2. Cập nhật form thêm (`add.php`):
```php
<div class="mb-3">
    <label for="sku" class="form-label">Mã SKU</label>
    <input type="text" class="form-control" id="sku" name="sku">
</div>
```

3. Cập nhật xử lý thêm:
```php
$sku = escape_string(trim($_POST['sku']));
$sql = "INSERT INTO products (name, sku, ...) VALUES ('$name', '$sku', ...)";
```

4. Cập nhật form sửa và danh sách tương tự

---

## API và Functions

### Database Functions (db.php)

#### query($sql)
Thực thi câu query SQL

```php
query("UPDATE products SET stock = 100 WHERE id = 1");
```

#### fetch_single($sql)
Lấy một dòng dữ liệu

```php
$product = fetch_single("SELECT * FROM products WHERE id = 1");
echo $product['name'];
```

#### fetch_all($sql)
Lấy nhiều dòng dữ liệu

```php
$products = fetch_all("SELECT * FROM products");
foreach ($products as $product) {
    echo $product['name'];
}
```

#### escape_string($str)
Escape string để tránh SQL injection

```php
$name = escape_string($_POST['name']);
query("INSERT INTO categories (name) VALUES ('$name')");
```

### JavaScript Functions (admin-script.js)

#### confirmDelete(message)
Xác nhận xóa

```javascript
onclick="return confirmDelete('Bạn có chắc muốn xóa?')"
```

#### searchTable(inputId, tableId)
Tìm kiếm trong bảng

```html
<input type="text" id="search" onkeyup="searchTable('search', 'dataTable')">
<table id="dataTable">...</table>
```

---

## Bảo mật

### SQL Injection Prevention

**❌ Không tốt:**
```php
$id = $_GET['id'];
$sql = "SELECT * FROM products WHERE id = $id";
```

**✅ Tốt:**
```php
$id = intval($_GET['id']);
$sql = "SELECT * FROM products WHERE id = $id";
```

**✅ Tốt hơn (Prepared Statements):**
```php
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
```

### XSS Prevention

**Luôn sử dụng htmlspecialchars khi hiển thị dữ liệu từ database:**

```php
echo htmlspecialchars($product['name']);
```

### Thêm Authentication

Tạo file `admin/includes/auth.php`:

```php
<?php
session_start();

function check_login() {
    if (!isset($_SESSION['admin_logged_in'])) {
        header('Location: login.php');
        exit;
    }
}

// Thêm vào đầu mỗi trang admin
check_login();
?>
```

---

## Mở rộng

### Thêm chức năng Upload ảnh

1. Tạo thư mục upload:
```bash
mkdir admin/assets/img/products
chmod 755 admin/assets/img/products
```

2. Thêm vào form:
```php
<form method="POST" enctype="multipart/form-data">
    <input type="file" name="image" accept="image/*">
</form>
```

3. Xử lý upload:
```php
if (isset($_FILES['image'])) {
    $target_dir = "../../assets/img/products/";
    $file_extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
    $new_filename = uniqid() . '.' . $file_extension;
    $target_file = $target_dir . $new_filename;
    
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $image = $new_filename;
    }
}
```

### Thêm Phân trang (Pagination)

```php
// Lấy tổng số
$total = fetch_single("SELECT COUNT(*) as count FROM products")['count'];
$per_page = 10;
$total_pages = ceil($total / $per_page);
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $per_page;

// Lấy dữ liệu phân trang
$products = fetch_all("SELECT * FROM products LIMIT $offset, $per_page");

// Hiển thị phân trang
for ($i = 1; $i <= $total_pages; $i++) {
    echo "<a href='?page=$i'>$i</a> ";
}
```

### Thêm Export Excel

```php
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="products.xls"');

$products = fetch_all("SELECT * FROM products");
?>
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
    </tr>
    <?php foreach ($products as $p): ?>
    <tr>
        <td><?php echo $p['id']; ?></td>
        <td><?php echo $p['name']; ?></td>
        <td><?php echo $p['price']; ?></td>
    </tr>
    <?php endforeach; ?>
</table>
```

---

## Kết luận

Workshop Admin Template cung cấp một nền tảng vững chắc để bạn xây dựng hệ thống quản lý của riêng mình. Với cấu trúc rõ ràng, mã nguồn sạch và tài liệu đầy đủ, bạn có thể dễ dàng tùy chỉnh và mở rộng theo nhu cầu của dự án.

Chúc bạn thành công!
