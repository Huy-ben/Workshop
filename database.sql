-- Tạo database
CREATE DATABASE IF NOT EXISTS workshop_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE workshop_db;

-- Bảng categories (Danh mục)
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Bảng products (Sản phẩm)
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL DEFAULT 0.00,
    stock INT NOT NULL DEFAULT 0,
    image VARCHAR(255),
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dữ liệu mẫu cho categories
INSERT INTO categories (name, description, status) VALUES
('Điện tử', 'Các sản phẩm điện tử như điện thoại, laptop, tablet', 'active'),
('Thời trang', 'Quần áo, giày dép, phụ kiện thời trang', 'active'),
('Gia dụng', 'Đồ dùng gia đình, nhà bếp', 'active'),
('Sách', 'Sách văn học, sách giáo khoa, sách kỹ năng', 'active'),
('Thể thao', 'Dụng cụ thể thao, trang phục thể thao', 'active');

-- Dữ liệu mẫu cho products
INSERT INTO products (category_id, name, description, price, stock, status) VALUES
(1, 'iPhone 15 Pro', 'Điện thoại thông minh cao cấp của Apple', 29990000, 50, 'active'),
(1, 'Samsung Galaxy S24', 'Điện thoại thông minh Samsung flagship', 22990000, 30, 'active'),
(1, 'MacBook Pro M3', 'Laptop cao cấp cho dân chuyên nghiệp', 45990000, 20, 'active'),
(2, 'Áo thun nam', 'Áo thun cotton 100% thoáng mát', 199000, 100, 'active'),
(2, 'Quần jean nữ', 'Quần jean skinny thời trang', 450000, 75, 'active'),
(3, 'Nồi cơm điện', 'Nồi cơm điện thông minh 1.8L', 1290000, 40, 'active'),
(3, 'Máy xay sinh tố', 'Máy xay sinh tố công suất 500W', 890000, 60, 'active'),
(4, 'Đắc Nhân Tâm', 'Sách kỹ năng sống của Dale Carnegie', 85000, 200, 'active'),
(4, 'Nhà Giả Kim', 'Tiểu thuyết của Paulo Coelho', 75000, 150, 'active'),
(5, 'Bóng đá World Cup', 'Bóng đá chính hãng FIFA', 350000, 80, 'active');
