<?php include_once('../connect.php'); ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý thể loại</title>
</head>
<body>
    <table align="center" border="1" width="600" cellpadding="5" cellspacing="0">
        <tr align="center" bgcolor="#f2f2f2">
            <th>Tên Thể Loại</th>
            <th>Thứ Tự</th>
            <th>Ẩn Hiện</th>
            <th>Biểu tượng</th>
            <th colspan="2"><a href="theloai_them.php">Thêm</a></th>
        </tr>
        <?php 
            $sql = "SELECT * FROM theloai";
            $results = mysqli_query($connect, $sql);
            while ($rows = mysqli_fetch_assoc($results)) {
        ?>
        <tr align="center">
            <td><?php echo htmlspecialchars($rows['TenTL']); ?></td>
            <td><?php echo $rows['ThuTu']; ?></td>
            <td><?php echo ($rows['AnHien'] == 1) ? "Hiện" : "Ẩn"; ?></td>
            <td>
                <?php if (!empty($rows['icon'])) : ?>
                    <img src="../image/<?php echo htmlspecialchars($rows['icon']); ?>" width="40" height="40" alt="icon" />
                <?php endif; ?>
            </td>
            <td>
                <a href="theloai_sua.php?idTL=<?php echo $rows['idTL']; ?>">Sửa</a>
            </td>
            <td>
                <a href="theloai_xoa.php?idTL=<?php echo $rows['idTL']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xóa</a>
            </td>
        </tr>
        <?php } 
        mysqli_close($connect);
        ?>
    </table>
</body>
</html>