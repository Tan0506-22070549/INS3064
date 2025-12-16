<?php
$servername = "localhost";
$username = "root";   // Laragon/XAMPP mặc định
$password = "";       // để trống
$dbname = "LoginReg";

// 1. Kết nối MySQL (chưa chọn DB)
$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// 2. Tạo database LaptopShop
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
$conn->query($sql);
$conn->close();

// 3. Kết nối lại với DB LaptopShop
$conn = new mysqli($servername, $username, $password, $dbname);

// 4. Tạo table laptops (chỉ 1 table theo yêu cầu)
$sql = "CREATE TABLE IF NOT EXISTS laptops (
    id INT AUTO_INCREMENT PRIMARY KEY,
    brand VARCHAR(100) NOT NULL,
    model VARCHAR(100) NOT NULL,
    processor VARCHAR(100),
    ram VARCHAR(50),
    storage VARCHAR(50),
    price DECIMAL(10,2),
    stock_quantity INT
)";
$conn->query($sql);

// 5. Thêm dữ liệu mẫu (nếu bảng đang rỗng)
$check = $conn->query("SELECT COUNT(*) as total FROM laptops");
$row = $check->fetch_assoc();
if ($row['total'] == 0) {
    $conn->query("INSERT INTO laptops (brand, model, processor, ram, storage, price, stock_quantity) VALUES
    ('Dell', 'Inspiron 15', 'Intel i5', '8GB', '512GB SSD', 750.00, 10),
    ('HP', 'Pavilion 14', 'Intel i7', '16GB', '1TB SSD', 1200.00, 5),
    ('Asus', 'VivoBook S15', 'AMD Ryzen 7', '8GB', '512GB SSD', 900.00, 7)");
}

// 6. Hiển thị dữ liệu ra bảng HTML
$result = $conn->query("SELECT * FROM laptops");

echo "<h2>Danh sách Laptop Shop</h2>";
echo "<table border='1' cellpadding='8' cellspacing='0'>";
echo "<tr>
        <th>ID</th>
        <th>Brand</th>
        <th>Model</th>
        <th>Processor</th>
        <th>RAM</th>
        <th>Storage</th>
        <th>Price</th>
        <th>Stock</th>
      </tr>";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row["id"]."</td>
                <td>".$row["brand"]."</td>
                <td>".$row["model"]."</td>
                <td>".$row["processor"]."</td>
                <td>".$row["ram"]."</td>
                <td>".$row["storage"]."</td>
                <td>".$row["price"]."</td>
                <td>".$row["stock_quantity"]."</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='8'>Chưa có dữ liệu</td></tr>";
}
echo "</table>";

$conn->close();
?>
