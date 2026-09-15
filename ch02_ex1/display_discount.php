<?php
// Bước 6: Lấy dữ liệu gửi từ form bằng hàm filter_input
$product_description = filter_input(INPUT_POST, 'product_description');
$list_price = filter_input(INPUT_POST, 'list_price', FILTER_VALIDATE_FLOAT);
$discount_percent = filter_input(INPUT_POST, 'discount_percent', FILTER_VALIDATE_FLOAT);

// Bước 7: Tính toán chiết khấu và giá sau khi giảm
$discount = $list_price * $discount_percent * 0.01;
$discount_price = $list_price - $discount;

// Bước 8: Định dạng dữ liệu dạng tiền tệ và phần trăm
$list_price_f = "$" . number_format($list_price, 2);
$discount_percent_f = $discount_percent . "%";
$discount_f = "$" . number_format($discount, 2);
$discount_price_f = "$" . number_format($discount_price, 2);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Product Discount Calculator</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
    <main>
        <!-- Bước 11: Đổi tiêu đề h1 thành Product Discount Calculator -->
        <h1>Product Discount Calculator</h1>

        <label>Product Description:</label>
        <!-- Bước 10: Dùng htmlspecialchars chống tấn công XSS và lỗi hiển thị thẻ HTML -->
        <span><?php echo htmlspecialchars($product_description); ?></span><br>

        <label>List Price:</label>
        <span><?php echo htmlspecialchars($list_price_f); ?></span><br>

        <label>Standard Discount:</label>
        <span><?php echo htmlspecialchars($discount_percent_f); ?></span><br>

        <label>Discount Amount:</label>
        <span><?php echo htmlspecialchars($discount_f); ?></span><br>

        <label>Discount Price:</label>
        <span><?php echo htmlspecialchars($discount_price_f); ?></span><br>
    </main>
</body>
</html>