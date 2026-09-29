<?php
include_once('../connect.php');

$icon = '';
if (isset($_FILES['image']) && $_FILES['image']['name'] != '') {
    $icon = $_FILES['image']['name'];
    $anhminhhoa_tmp = $_FILES['image']['tmp_name'];
    move_uploaded_file($anhminhhoa_tmp, "../image/" . $icon);
}

$theloai = $_POST['TenTL'];
$thutu = (int)$_POST['ThuTu'];
$an = (int)$_POST['AnHien'];

$sql = "INSERT INTO theloai (TenTL, ThuTu, AnHien, icon) VALUES ('$theloai', '$thutu', '$an', '$icon')";

if (mysqli_query($connect, $sql)) {
    echo "<script>alert('Thêm thành công'); location.href='theloai.php';</script>";
} else {
    echo 'Lỗi: ' . mysqli_error($connect);
}
mysqli_close($connect);
?>