<?php
// 1. Nhận dữ liệu gửi lên từ form
$investment = filter_input(INPUT_POST, 'investment', FILTER_VALIDATE_FLOAT);
$interest_rate = filter_input(INPUT_POST, 'interest_rate', FILTER_VALIDATE_FLOAT);
$years = filter_input(INPUT_POST, 'years', FILTER_VALIDATE_INT);

// 2. Validate dữ liệu - BƯỚC 5 THEO SÁCH
if ($investment === FALSE || $investment <= 0) {
    $error_message = 'Investment must be a valid number greater than zero.';
} else if ($interest_rate === FALSE || $interest_rate <= 0) {
    $error_message = 'Interest rate must be a valid number greater than zero.';
} else if ($interest_rate > 15) {
    // Yêu cầu Bước 5: Bắt lỗi lãi suất vượt quá 15
    $error_message = 'Interest rate must be less than or equal to 15.';
} else if ($years === FALSE || $years <= 0 || $years > 30) {
    $error_message = 'Number of years must be a valid whole number greater than zero and less than or equal to 30.';
} else {
    $error_message = '';
}

// Nếu có lỗi thì quay về form ban đầu để hiện thông báo
if ($error_message != '') {
    include('index.php');
    exit();
}

// 3. Tính toán giá trị tương lai theo lãi kép
$future_value = $investment;
for ($i = 1; $i <= $years; $i++) {
    $future_value += $future_value * $interest_rate * 0.01;
}

// 4. Format tiền tệ và phần trăm
$investment_f = '$' . number_format($investment, 2);
$yearly_rate_f = $interest_rate . '%';
$future_value_f = '$' . number_format($future_value, 2);

// BƯỚC 6 THEO SÁCH: Lấy ngày tính toán hiện tại bằng hàm date()
$calculation_date = date('m/d/Y');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Future Value Calculator</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
    <main>
        <h1>Future Value Calculator</h1>

        <label>Investment Amount:</label>
        <span><?php echo htmlspecialchars($investment_f); ?></span><br>

        <label>Yearly Interest Rate:</label>
        <span><?php echo htmlspecialchars($yearly_rate_f); ?></span><br>

        <label>Number of Years:</label>
        <span><?php echo htmlspecialchars($years); ?></span><br>

        <label>Future Value:</label>
        <span><?php echo htmlspecialchars($future_value_f); ?></span><br>

        <!-- Yêu cầu Bước 6: Hiển thị dòng ngày tính toán ở cuối -->
        <p>This calculation was done on <?php echo $calculation_date; ?>.</p>
    </main>
</body>
</html>