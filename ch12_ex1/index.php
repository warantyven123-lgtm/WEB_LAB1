<?php
// Start session management with a persistent cookie (3 years)
$lifetime = 60 * 60 * 24 * 365 * 3;    // 3 years in seconds
session_set_cookie_params($lifetime, '/');
session_start();

// Create a cart array if needed (dùng đúng key 'cart12' theo bài giảng của thầy)
if (empty($_SESSION['cart12'])) { 
    $_SESSION['cart12'] = array(); 
}

// Create a table of products
$products = array();
$products['MMS-1754'] = array('name' => 'Flute', 'cost' => '149.50');
$products['MMS-6289'] = array('name' => 'Trumpet', 'cost' => '199.50');
$products['MMS-3408'] = array('name' => 'Clarinet', 'cost' => '299.50');

// Include cart functions
require_once('cart.php');

// Get the action to perform
$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'show_add_item';
    }
}

// Add or update cart as needed
switch($action) {
    case 'add':
        $product_key = filter_input(INPUT_POST, 'productkey');
        $item_qty = filter_input(INPUT_POST, 'itemqty');
        add_item($product_key, $item_qty);
        include('cart_view.php');
        break;
        
    case 'update':
        $new_qty_list = filter_input(INPUT_POST, 'newqty', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        if ($new_qty_list !== NULL) {
            foreach($new_qty_list as $key => $qty) {
                if ($_SESSION['cart12'][$key]['qty'] != $qty) {
                    update_item($key, $qty);
                }
            }
        }
        include('cart_view.php');
        break;
        
    case 'show_cart':
        include('cart_view.php');
        break;
        
    case 'show_add_item':
        include('add_item_view.php');
        break;
        
    case 'empty_cart':
        unset($_SESSION['cart12']);
        include('cart_view.php');
        break;

    case 'end_session':
        // 1. Xóa mảng session trong bộ nhớ
        $_SESSION = array();

        // 2. Xóa cookie session trên trình duyệt
        $name = session_name();
        $expire = strtotime('-1 year');
        $params = session_get_cookie_params();
        $path = $params['path'];
        $domain = $params['domain'];
        $secure = $params['secure'];
        $httponly = $params['httponly'];
        setcookie($name, '', $expire, $path, $domain, $secure, $httponly);

        // 3. Hủy session trên server
        session_destroy();

        // 4. Nạp lại trang xem giỏ hàng
        include('cart_view.php');
        break;
}
?>