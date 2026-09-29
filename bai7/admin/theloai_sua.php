<?php 
include("../connect.php");

if (isset($_GET['idTL'])) {
    $idTL = (int)$_GET['idTL'];
    $sql = "SELECT * FROM theloai WHERE idTL = $idTL";
    $result = mysqli_query($connect, $sql);
    $d = mysqli_fetch_array($result);
}

if (isset($_POST['Sua'])) {
    $key = (int)$_POST['idTL'];
    $theloai = $_POST['TenTL'];
    $thutu = (int)$_POST['ThuTu'];
    $an = (int)$_POST['AnHien'];
    $icon = $_POST['ten_anh'];

    if (!empty($_FILES["image"]["name"])) {
        $icon = $_FILES["image"]["name"];
        move_uploaded_file($_FILES['image']['tmp_name'], "../image/" . $icon);
        if (!empty($_POST['ten_anh']) && file_exists("../image/" . $_POST['ten_anh'])) {
            unlink("../image/" . $_POST['ten_anh']);
        }
    }

    $sqlUpdate = "UPDATE theloai SET TenTL='$theloai', ThuTu='$thutu', AnHien='$an', icon='$icon' WHERE idTL='$key'";
    if (mysqli_query($connect, $sqlUpdate)) {
        echo "<script>alert('Sửa thành công'); location.href='theloai.php';</script>";
        exit();
    } else {
        echo "Lỗi: " . mysqli_error($connect);
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa Thể Loại</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <table align="center" width="400" cellpadding="5">
            <tr>
                <td align="right">Tên Thể Loại:</td>
                <td><input type="text" name="TenTL" value="<?php echo htmlspecialchars($d['TenTL'] ?? ''); ?>" required /></td>
            </tr>
            <tr>
                <td align="right">Thứ Tự:</td>
                <td><input type="number" name="ThuTu" value="<?php echo $d['ThuTu'] ?? 0; ?>" /></td>
            </tr>
            <tr>
                <td align="right">Ẩn / Hiện:</td>
                <td>
                    <select name="AnHien">
                        <option value="0" <?php if (($d['AnHien'] ?? 1) == 0) echo "selected"; ?>>Ẩn</option>
                        <option value="1" <?php if (($d['AnHien'] ?? 1) == 1) echo "selected"; ?>>Hiện</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right">Icon hiện tại:</td>
                <td>
                    <?php if (!empty($d['icon'])) : ?>
                        <img src="../image/<?php echo htmlspecialchars($d['icon']); ?>" width="40" height="40" alt="icon" /><br />
                    <?php endif; ?>
                    <input type="file" name="image" />
                    <input type="hidden" name="ten_anh" value="<?php echo htmlspecialchars($d['icon'] ?? ''); ?>" />
                </td>
            </tr>
            <tr>
                <td align="right">
                    <input type="hidden" name="idTL" value="<?php echo $d['idTL'] ?? ''; ?>" />
                    <input type="submit" name="Sua" value="Sửa" />
                </td>
                <td><input type="button" value="Hủy" onclick="location.href='theloai.php';" /></td>
            </tr>
        </table>
    </form>
</body>
</html>