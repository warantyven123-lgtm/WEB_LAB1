<?php
require('util/main.php');

require('model/database.php');
require('model/product_db.php');

/***************************************
 * Delete a product (Bước 7)
 ****************************************/

// Sample data
$product_name = 'Fender Telecaster';

// Tìm sản phẩm theo tên và tiến hành xóa
$product_to_delete = get_product_by_name($product_name);

if ($product_to_delete) {
    $rows_deleted = delete_product($product_to_delete['productID']);
    if ($rows_deleted > 0) {
        $delete_message = "$rows_deleted row was deleted.";
    } else {
        $delete_message = "No rows were deleted.";
    }
} else {
    $delete_message = "No product found to delete.";
}

/***************************************
 * Insert a product (Bước 5)
 ****************************************/

// Sample data
$category_id = 1;
$code = 'tele';
$name = 'Fender Telecaster';
$description = 'NA';
$price = '949.99';
$discount_percent = 0;

// Thêm sản phẩm mới và hiển thị thông báo kèm ID
$product_id = add_product($category_id, $code, $name, $description, $price, $discount_percent);

if ($product_id > 0) {
    $insert_message = "1 row was inserted with product ID: $product_id.";
} else {
    $insert_message = "No rows were inserted.";
}

/*********************************************
 * Select some products (Bước 4)
 **********************************************/

// Đổi $cat_id = 2 thành 1 (danh mục Guitars)
$cat_id = 1;

// Lấy danh sách sản phẩm sau khi đã hoàn tất xóa/thêm
$products = get_products_by_category($cat_id);

include 'home.php';
?>