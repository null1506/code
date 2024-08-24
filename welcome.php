<!--welcome.php-->
<?php
session_start(); // Bắt đầu phiên làm việc

// Kiểm tra xem dữ liệu có tồn tại trong session không
$fullname = $_SESSION['fullname'];

echo "Welcome $fullname";
?>
