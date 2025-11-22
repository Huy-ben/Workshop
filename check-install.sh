# Workshop Admin Template - Kiểm tra Cài đặt
# Installation Check Script

echo "================================"
echo "Workshop Admin Template"
echo "Installation Verification"
echo "================================"
echo ""

# Check PHP version
echo "Đang kiểm tra PHP..."
if command -v php >/dev/null 2>&1; then
    PHP_VERSION=$(php -v | head -n 1)
    echo "✓ PHP đã được cài đặt: $PHP_VERSION"
    
    # Check mysqli extension
    if php -m | grep -q mysqli; then
        echo "✓ Extension MySQLi đã được cài đặt"
    else
        echo "✗ Extension MySQLi chưa được cài đặt"
        echo "  Vui lòng cài đặt mysqli extension"
    fi
else
    echo "✗ PHP chưa được cài đặt"
    echo "  Vui lòng cài đặt PHP 7.4 hoặc cao hơn"
fi

echo ""

# Check MySQL
echo "Đang kiểm tra MySQL..."
if command -v mysql >/dev/null 2>&1; then
    MYSQL_VERSION=$(mysql --version)
    echo "✓ MySQL đã được cài đặt: $MYSQL_VERSION"
else
    echo "✗ MySQL chưa được cài đặt"
    echo "  Vui lòng cài đặt MySQL 5.7 hoặc cao hơn"
fi

echo ""

# Check web server
echo "Đang kiểm tra Web Server..."
if command -v apache2 >/dev/null 2>&1 || command -v httpd >/dev/null 2>&1; then
    echo "✓ Apache đã được cài đặt"
elif command -v nginx >/dev/null 2>&1; then
    echo "✓ Nginx đã được cài đặt"
else
    echo "! Không tìm thấy web server"
    echo "  Nếu bạn dùng XAMPP/WAMP, điều này là bình thường"
fi

echo ""

# Check file structure
echo "Đang kiểm tra cấu trúc thư mục..."
if [ -d "admin" ]; then
    echo "✓ Thư mục admin tồn tại"
    
    if [ -f "admin/index.php" ]; then
        echo "✓ File admin/index.php tồn tại"
    else
        echo "✗ File admin/index.php không tồn tại"
    fi
    
    if [ -f "admin/includes/config.php" ]; then
        echo "✓ File cấu hình tồn tại"
    else
        echo "✗ File cấu hình không tồn tại"
    fi
    
    if [ -d "admin/pages/categories" ]; then
        echo "✓ Thư mục categories tồn tại"
    else
        echo "✗ Thư mục categories không tồn tại"
    fi
    
    if [ -d "admin/pages/products" ]; then
        echo "✓ Thư mục products tồn tại"
    else
        echo "✗ Thư mục products không tồn tại"
    fi
else
    echo "✗ Thư mục admin không tồn tại"
fi

echo ""

# Check database file
if [ -f "database.sql" ]; then
    echo "✓ File database.sql tồn tại"
else
    echo "✗ File database.sql không tồn tại"
fi

echo ""

# Check documentation
echo "Đang kiểm tra tài liệu..."
if [ -f "README.md" ]; then
    echo "✓ README.md tồn tại"
fi

if [ -f "QUICKSTART.md" ]; then
    echo "✓ QUICKSTART.md tồn tại"
fi

if [ -f "USAGE.md" ]; then
    echo "✓ USAGE.md tồn tại"
fi

echo ""
echo "================================"
echo "Hoàn tất kiểm tra!"
echo "================================"
echo ""
echo "Các bước tiếp theo:"
echo "1. Cấu hình database trong admin/includes/config.php"
echo "2. Import file database.sql vào MySQL"
echo "3. Truy cập http://localhost/Workshop/admin/"
echo ""
echo "Chi tiết xem file README.md hoặc QUICKSTART.md"
echo ""
