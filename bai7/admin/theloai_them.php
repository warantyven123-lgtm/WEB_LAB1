<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Thể Loại</title>
</head>
<body>
    <form action="theloai_them_xl.php" method="post" enctype="multipart/form-data">
        <table align="center" width="400" cellpadding="5">
            <tr>
                <td align="right">Tên Thể Loại:</td>
                <td><input type="text" name="TenTL" required /></td>
            </tr>
            <tr>
                <td align="right">Thứ Tự:</td>
                <td><input type="number" name="ThuTu" value="0" /></td>
            </tr>
            <tr>
                <td align="right">Ẩn / Hiện:</td>
                <td>
                    <select name="AnHien">
                        <option value="1">Hiện</option>
                        <option value="0">Ẩn</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right">Icon:</td>
                <td><input type="file" name="image" id="anh" /></td>
            </tr>
            <tr>
                <td align="right"><input type="submit" name="Them" value="Thêm" /></td>
                <td><input type="reset" name="Huy" value="Hủy" /></td>
            </tr>
        </table>
    </form>
</body>
</html>