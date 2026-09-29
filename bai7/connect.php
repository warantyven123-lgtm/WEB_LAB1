<?php 
$connect = mysqli_connect('localhost', 'root', '', 'tintuc');

if (mysqli_connect_errno()) {
    die("Lỗi kết nối CSDL: " . mysqli_connect_error());
}
mysqli_set_charset($connect, 'utf8mb4');
?>