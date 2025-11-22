<?php
/**
 * Kết nối cơ sở dữ liệu
 * Database Connection
 */

require_once 'config.php';

// Tạo kết nối
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại / Connection failed: " . $conn->connect_error);
}

// Set charset UTF-8
$conn->set_charset("utf8mb4");

/**
 * Hàm thực thi câu query
 */
function query($sql) {
    global $conn;
    return $conn->query($sql);
}

/**
 * Hàm lấy một dòng dữ liệu
 */
function fetch_single($sql) {
    $result = query($sql);
    if ($result && $result->num_rows > 0) {
        return $result->fetch_assoc();
    }
    return null;
}

/**
 * Hàm lấy nhiều dòng dữ liệu
 */
function fetch_all($sql) {
    $result = query($sql);
    $data = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    return $data;
}

/**
 * Hàm escape string để tránh SQL injection
 */
function escape_string($str) {
    global $conn;
    return $conn->real_escape_string($str);
}
?>
