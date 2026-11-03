<?php
include("inc/connect.inc");
$lop = $_GET['lop'];

$sql = "SELECT * FROM sinhvien WHERE lop = ?";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, "s", $lop);
mysqli_stmt_execute($stmt);
$rs = mysqli_stmt_get_result($stmt);

$str = "<table>
    <tr class=hd>
        <td>TT</td>
        <td>Mã số</td>
        <td>Họ tên</td>
        <td>Địa chỉ</td>
    </tr>";
$tt = 1;
while ($row = mysqli_fetch_array($rs)) {
    $str .= "<tr>
        <td>{$tt}</td>
        <td>{$row['masv']}</td>
        <td>{$row['hoten']}</td>
        <td>{$row['diachi']}</td>
    </tr>";
    $tt++;
}
$str .= "</table>";

echo $str;
?>