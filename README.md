# Workshop Admin Template

Template quản trị (Admin Panel) với Bootstrap 5 để quản lý danh mục (Categories) và sản phẩm (Products). Template này được xây dựng bằng PHP và Bootstrap 5, dễ dàng tích hợp vào các dự án web.

## 🎯 Tính năng chính

- ✅ Dashboard với thống kê tổng quan
- ✅ Quản lý danh mục (CRUD - Create, Read, Update, Delete)
- ✅ Quản lý sản phẩm (CRUD)
- ✅ Giao diện responsive với Bootstrap 5
- ✅ Thiết kế hiện đại, dễ sử dụng
- ✅ Mã nguồn sạch, dễ tùy chỉnh
- ✅ Hỗ trợ tiếng Việt đầy đủ

## 📋 Yêu cầu hệ thống

- PHP 7.4 trở lên
- MySQL 5.7 trở lên hoặc MariaDB
- Web Server (Apache/Nginx)
- Extension PHP: mysqli

## 🚀 Hướng dẫn cài đặt

### Bước 1: Tải mã nguồn

Clone repository hoặc tải file ZIP về máy:

```bash
git clone https://github.com/Huy-ben/Workshop.git
cd Workshop
```

### Bước 2: Cấu hình Web Server

#### Với XAMPP (Windows/Mac/Linux):

1. Copy thư mục `Workshop` vào thư mục `htdocs` của XAMPP
2. Đường dẫn sẽ là: `C:\xampp\htdocs\Workshop` (Windows) hoặc `/opt/lampp/htdocs/Workshop` (Linux)

#### Với WAMP (Windows):

1. Copy thư mục `Workshop` vào thư mục `www` của WAMP
2. Đường dẫn sẽ là: `C:\wamp64\www\Workshop`

### Bước 3: Tạo cơ sở dữ liệu

1. Mở phpMyAdmin: `http://localhost/phpmyadmin`
2. Tạo database mới tên `workshop_db`
3. Import file `database.sql` vào database vừa tạo:
   - Click vào database `workshop_db`
   - Chọn tab "Import"
   - Chọn file `database.sql` từ thư mục gốc
   - Click "Go" để import

Hoặc chạy lệnh SQL trực tiếp:

```bash
mysql -u root -p < database.sql
```

### Bước 4: Cấu hình kết nối database

Mở file `admin/includes/config.php` và điều chỉnh thông tin kết nối:

```php
define('DB_HOST', 'localhost');     // Host database
define('DB_USER', 'root');          // Username database
define('DB_PASS', '');              // Password database
define('DB_NAME', 'workshop_db');   // Tên database
```

Cập nhật đường dẫn trang web (điều chỉnh theo môi trường của bạn):

```php
// Development (localhost)
define('SITE_URL', 'http://localhost/Workshop/admin/');

// Production (ví dụ)
// define('SITE_URL', 'https://yourdomain.com/admin/');
```

**Lưu ý**: Đường dẫn phải kết thúc bằng dấu `/`

### Bước 5: Truy cập ứng dụng

Mở trình duyệt và truy cập:

```
http://localhost/Workshop/admin/
```

## 📁 Cấu trúc thư mục

```
Workshop/
├── admin/                      # Thư mục admin chính
│   ├── css/                    # File CSS tùy chỉnh
│   │   └── admin-style.css
│   ├── js/                     # File JavaScript
│   │   └── admin-script.js
│   ├── includes/               # File include
│   │   ├── config.php          # Cấu hình ứng dụng
│   │   ├── db.php              # Kết nối database
│   │   ├── header.php          # Header chung
│   │   └── footer.php          # Footer chung
│   ├── pages/                  # Các trang quản lý
│   │   ├── categories/         # Quản lý danh mục
│   │   │   ├── list.php        # Danh sách danh mục
│   │   │   ├── add.php         # Thêm danh mục
│   │   │   └── edit.php        # Sửa danh mục
│   │   └── products/           # Quản lý sản phẩm
│   │       ├── list.php        # Danh sách sản phẩm
│   │       ├── add.php         # Thêm sản phẩm
│   │       └── edit.php        # Sửa sản phẩm
│   ├── assets/                 # Tài nguyên tĩnh
│   │   └── img/                # Hình ảnh
│   └── index.php               # Trang dashboard
├── database.sql                # File SQL tạo database
└── README.md                   # File hướng dẫn
```

## 💻 Hướng dẫn sử dụng

### Dashboard

Trang dashboard hiển thị:
- Tổng số danh mục hoạt động
- Tổng số sản phẩm hoạt động
- Tổng số lượng tồn kho
- Tổng giá trị hàng tồn kho
- Danh sách 5 sản phẩm mới nhất

### Quản lý danh mục

#### Xem danh sách danh mục:
- Truy cập: `admin/pages/categories/list.php`
- Hiển thị tất cả danh mục với các thông tin: ID, tên, mô tả, trạng thái, ngày tạo
- Có nút Sửa và Xóa cho mỗi danh mục

#### Thêm danh mục mới:
1. Click nút "Thêm danh mục mới" trên trang danh sách
2. Điền thông tin:
   - Tên danh mục (bắt buộc)
   - Mô tả (tùy chọn)
   - Trạng thái (Hoạt động/Không hoạt động)
3. Click "Lưu danh mục"

#### Sửa danh mục:
1. Click nút Sửa (biểu tượng bút) ở danh mục cần sửa
2. Cập nhật thông tin
3. Click "Cập nhật danh mục"

#### Xóa danh mục:
1. Click nút Xóa (biểu tượng thùng rác) ở danh mục cần xóa
2. Xác nhận xóa trong hộp thoại
3. Lưu ý: Xóa danh mục sẽ xóa tất cả sản phẩm trong danh mục đó

### Quản lý sản phẩm

#### Xem danh sách sản phẩm:
- Truy cập: `admin/pages/products/list.php`
- Hiển thị tất cả sản phẩm với: ID, tên, danh mục, giá, tồn kho, trạng thái, ngày tạo
- Có nút Sửa và Xóa cho mỗi sản phẩm

#### Thêm sản phẩm mới:
1. Click nút "Thêm sản phẩm mới" trên trang danh sách
2. Điền thông tin:
   - Tên sản phẩm (bắt buộc)
   - Danh mục (bắt buộc - chọn từ dropdown)
   - Mô tả (tùy chọn)
   - Giá (VNĐ) (bắt buộc)
   - Số lượng tồn kho (bắt buộc)
   - Trạng thái (Hoạt động/Không hoạt động)
3. Click "Lưu sản phẩm"

#### Sửa sản phẩm:
1. Click nút Sửa ở sản phẩm cần sửa
2. Cập nhật thông tin
3. Click "Cập nhật sản phẩm"

#### Xóa sản phẩm:
1. Click nút Xóa ở sản phẩm cần xóa
2. Xác nhận xóa trong hộp thoại

## 🔧 Tùy chỉnh và Mở rộng

### Thay đổi màu sắc giao diện

Chỉnh sửa file `admin/css/admin-style.css`:

```css
/* Thay đổi màu chính */
.navbar {
    background-color: #your-color !important;
}

/* Thay đổi màu card */
.card {
    border-color: #your-color;
}
```

### Thêm trường mới vào database

1. Sửa file `database.sql` để thêm cột mới:
```sql
ALTER TABLE products ADD COLUMN new_field VARCHAR(255);
```

2. Cập nhật form trong `add.php` và `edit.php`
3. Cập nhật câu SQL INSERT và UPDATE

### Tích hợp vào dự án PHP hiện có

1. Copy thư mục `admin` vào dự án của bạn
2. Import file `database.sql`
3. Điều chỉnh `config.php` để phù hợp với cấu hình của bạn
4. Sử dụng các function trong `db.php` để truy vấn database

### Thêm xác thực người dùng (Authentication)

Template này chưa có hệ thống đăng nhập. Để thêm:

1. Tạo bảng `users` trong database
2. Tạo trang `login.php` và `logout.php`
3. Sử dụng PHP Session để quản lý đăng nhập
4. Thêm kiểm tra session ở đầu mỗi trang admin

## 🎨 Công nghệ sử dụng

- **PHP**: Ngôn ngữ lập trình backend
- **MySQL**: Hệ quản trị cơ sở dữ liệu
- **Bootstrap 5.3.2**: Framework CSS responsive
- **Bootstrap Icons**: Thư viện icon
- **JavaScript/jQuery**: Xử lý client-side

## 📝 Lưu ý quan trọng

1. **Bảo mật**: Template này là bản demo cơ bản. Khi sử dụng production, cần:
   - Thêm xác thực người dùng
   - Validate input đầy đủ hơn
   - Sử dụng Prepared Statements để tránh SQL Injection
   - Thêm CSRF protection

2. **Upload ảnh**: Hiện tại chưa có chức năng upload ảnh. Để thêm:
   - Xử lý upload file trong PHP
   - Lưu đường dẫn ảnh vào database
   - Hiển thị ảnh trong danh sách sản phẩm

3. **Phân trang**: Với nhiều dữ liệu, nên thêm phân trang (pagination)

4. **Tìm kiếm**: Có thể thêm chức năng tìm kiếm sản phẩm/danh mục

## 🤝 Đóng góp

Mọi đóng góp đều được hoan nghênh! Vui lòng:
1. Fork repository
2. Tạo branch mới (`git checkout -b feature/TenTinhNang`)
3. Commit changes (`git commit -am 'Thêm tính năng mới'`)
4. Push to branch (`git push origin feature/TenTinhNang`)
5. Tạo Pull Request

## 📞 Hỗ trợ

Nếu gặp vấn đề hoặc có câu hỏi, vui lòng:
- Tạo Issue trên GitHub
- Liên hệ qua email

## 📄 License

Dự án này được phát hành dưới giấy phép MIT. Bạn có thể tự do sử dụng, chỉnh sửa và phân phối.

---

**Phát triển bởi Workshop Team** 🚀

Chúc bạn sử dụng template thành công!