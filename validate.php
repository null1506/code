<!--
    Validate from Client: Thẻ HTML 5, JS
    Validate from Server: PHP
    
    Bắt lỗi:
    Họ tên -> Bắt buộc phải nhập và phải lớn hơn 5 kí tự
    Email -> Bắt buộc phải nhập và phải đúng định dạng email
-->

<?php
$arr = [
    'user1' => 
    [
        'fullname' => 'Hoang Hai Yen',
        'email' => 'hoanghaiyen@gmail.com'
    ],
    'user2' =>
    [
        'fullname' => 'aaaaaaaa',
        'email' => 'aaaa@gmail.com'

    ]
];
// dùng PHP --> Ta chỉ bắt lỗi form này khi nhấn nút Submit, tức nó 
// được gửi lên Server
session_start(); // Bắt đầu phiên làm việc
// Kiểm tra xem có tồn tại phương thức POST ko
if(!empty($_POST)){
    
    $errors = []; // biến lưu lỗi
    //kiểm tra xem có nhập Họ tên hay ko
    if(empty($_POST['fullname'])){
        $errors['fullname']['required'] = 'Bắt buộc phải nhập họ tên';
    }
    elseif(strlen($_POST['fullname']) <= 5){
        $errors['fullname']['min_length'] = 'Họ tên phải lớn hơn 5 kí tự';
    }
    //Bắt lỗi email
    if(empty($_POST['email'])){
        $errors['email']['required'] = 'Bắt buộc phải nhập email';
    }
    elseif(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
        $errors['email']['correct_format'] = 'Phải nhập đúng định dạng email';
    }
    if (empty($errors)) {
        if (($_POST['fullname'] === $arr['user1']['fullname'] and $_POST['email'] === $arr['user1']['email']) or ($_POST['fullname'] === $arr['user2']['fullname'] and $_POST['email'] === $arr['user2']['email']) ){
        $_SESSION['fullname'] = $_POST['fullname']; // Lưu tên vào session
        header('Location: welcome.php'); // Chuyển hướng đến welcome.php
        exit(); // Dừng thực thi mã sau khi chuyển hướng
        }
        else{
            echo 'ko tồn tại tài khoản';
            exit();
        }
    }
    
    
    /*
    // kiểm tra xem errors có rỗng ko
    if(empty($errors)){
        echo 'Validate thành công, ko có lỗi xảy ra';
    }
    else{
        echo 'Có lỗi xảy ra';
        // in ra errors
        echo '<pre>';
        print_r($errors);
        echo '</pre>';
    }
    */
    // Nếu không có lỗi, thực hiện chuyển hướng
    
    
}
?>

<form method = "post" action = "">
    <p>Họ tên :
        <input type = "text" name = "fullname" placeholder = "Họ tên" >
        <?php 
        echo !empty($errors['fullname']['required']) ? $errors['fullname']['required'] : '';
        echo !empty($errors['fullname']['min_length']) ? $errors['fullname']['min_length'] : '';
        ?>
    </p>
    <p>Email :
        <input type = "text" name = "email" placeholder = "Email" >
        <?php 
        echo !empty($errors['email']['required']) ? $errors['email']['required'] : '';
        echo !empty($errors['email']['correct_format']) ? $errors['email']['correct_format'] : '';
        ?>
    </p>
    <button type = "submit">Xác nhận</button>
</form>


