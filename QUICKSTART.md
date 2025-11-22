# Hướng dẫn Cài đặt Nhanh - Workshop Admin Template

## Cài đặt 5 phút ⚡

### Yêu cầu
- XAMPP, WAMP hoặc LAMP stack đã cài đặt
- Trình duyệt web hiện đại

### Các bước thực hiện

#### 1️⃣ Copy file vào thư mục web
```bash
# Với XAMPP
cp -r Workshop /xampp/htdocs/

# Với WAMP
cp -r Workshop C:/wamp64/www/
```

#### 2️⃣ Tạo database
Mở trình duyệt và truy cập phpMyAdmin:
```
http://localhost/phpmyadmin
```

Chạy các lệnh SQL sau:
```sql
-- Tạo database
CREATE DATABASE workshop_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

#### 3️⃣ Import dữ liệu
Trong phpMyAdmin:
1. Chọn database `workshop_db`
2. Click tab "Import"
3. Chọn file `database.sql`
4. Click "Go"

#### 4️⃣ Cấu hình (nếu cần)
Nếu bạn sử dụng username/password khác cho MySQL, sửa file:
```
admin/includes/config.php
```

Thay đổi:
```php
define('DB_USER', 'root');     // Username của bạn
define('DB_PASS', '');         // Password của bạn
```

#### 5️⃣ Truy cập ứng dụng
Mở trình duyệt và truy cập:
```
http://localhost/Workshop/admin/
```

🎉 **Xong!** Bạn đã cài đặt thành công!

---

## Sử dụng cơ bản

### Quản lý Danh mục
- **Xem danh sách**: Menu > Danh mục
- **Thêm mới**: Click "Thêm danh mục mới"
- **Sửa**: Click icon bút chì
- **Xóa**: Click icon thùng rác

### Quản lý Sản phẩm
- **Xem danh sách**: Menu > Sản phẩm
- **Thêm mới**: Click "Thêm sản phẩm mới"
- **Chọn danh mục**: Dropdown trong form
- **Nhập giá**: Giá tính bằng VNĐ
- **Sửa/Xóa**: Tương tự danh mục

---

## Thông tin mẫu đã có sẵn

Database đã có sẵn dữ liệu mẫu:

**5 Danh mục:**
- Điện tử
- Thời trang
- Gia dụng
- Sách
- Thể thao

**10 Sản phẩm mẫu** trong các danh mục trên

Bạn có thể xóa dữ liệu mẫu và thêm dữ liệu của riêng mình.

---

## Giải quyết sự cố thường gặp

### Lỗi: "Connection failed"
➡️ Kiểm tra MySQL đã chạy chưa
➡️ Kiểm tra thông tin trong `config.php`

### Lỗi: "Table doesn't exist"
➡️ Import lại file `database.sql`

### Trang không hiển thị CSS
➡️ Kiểm tra đường dẫn trong `config.php`:
```php
define('SITE_URL', 'http://localhost/Workshop/admin/');
```

### Không thêm/sửa được dữ liệu
➡️ Kiểm tra quyền của database user
➡️ Xem Console để kiểm tra lỗi

---

## Liên hệ

Nếu gặp khó khăn, vui lòng xem file `README.md` để biết thêm chi tiết hoặc tạo Issue trên GitHub.

**Chúc bạn sử dụng thành công!** 🚀
