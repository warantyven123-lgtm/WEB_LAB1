<?php
// Bắt đầu session và đặt cookie tồn tại 1 năm
$lifetime = 60 * 60 * 24 * 365; // 1 year in seconds
session_set_cookie_params($lifetime, '/');
session_start();

// Chỉ tạo mảng mới nếu trong SESSION chưa từng có tasklist
if (!isset($_SESSION['tasklist'])) {
    $_SESSION['tasklist'] = array();
}

$action = filter_input(INPUT_POST, 'action');
$errors = array();

switch ($action) {
    case 'add':
        $new_task = trim(filter_input(INPUT_POST, 'newtask'));
        if (empty($new_task)) {
            $errors[] = 'The new task cannot be empty.';
        } else {
            // Lưu trực tiếp vào SESSION để không bị mất khi load lại trang
            $_SESSION['tasklist'][] = $new_task;
        }
        break;

    case 'delete':
        $task_index = filter_input(INPUT_POST, 'taskid', FILTER_VALIDATE_INT);
        if ($task_index === NULL || $task_index === FALSE) {
            $errors[] = 'The task cannot be deleted.';
        } else {
            // Xóa phần tử khỏi SESSION
            unset($_SESSION['tasklist'][$task_index]);
            $_SESSION['tasklist'] = array_values($_SESSION['tasklist']);
        }
        break;
}

// Lấy danh sách từ SESSION ra để hiển thị lên giao diện
$task_list = $_SESSION['tasklist'];

include('task_list.php');
?>