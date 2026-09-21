<?php
// Nhận dữ liệu từ form
$name = filter_input(INPUT_POST, 'name');

// Validate dữ liệu
if ($name == null) {
    $error = "Invalid category name. Check all fields and try again.";
    include('error.php');
} else {
    require_once('database.php');

    // Thêm category vào cơ sở dữ liệu
    $query = 'INSERT INTO categories (categoryName)
              VALUES (:category_name)';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_name', $name);
    $statement->execute();
    $statement->closeCursor();

    // Quay trở lại trang danh sách categories
    header('Location: category_list.php');
}
?>