<?php
require_once('database.php');

// Lấy category ID
$category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
if ($category_id == NULL || $category_id == FALSE) {
    $category_id = 1;
}

// Lấy thông tin category đang chọn
$queryCategory = 'SELECT * FROM categories WHERE categoryID = :category_id';
$statement1 = $db->prepare($queryCategory);
$statement1->bindValue(':category_id', $category_id);
$statement1->execute();
$category = $statement1->fetch();
$category_name = $category['categoryName'];
$statement1->closeCursor();

// Lấy toàn bộ categories cho cột bên trái
$query = 'SELECT * FROM categories ORDER BY categoryID';
$statement = $db->prepare($query);
$statement->execute();
$categories = $statement->fetchAll();
$statement->closeCursor();

// Lấy danh sách sản phẩm theo category đang chọn
$queryProducts = 'SELECT * FROM products WHERE categoryID = :category_id ORDER BY productID';
$statement3 = $db->prepare($queryProducts);
$statement3->bindValue(':category_id', $category_id);
$statement3->execute();
$products = $statement3->fetchAll();
$statement3->closeCursor();
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Guitar Shop</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>
<body>
<header><h1>Product Manager</h1></header>
<main>
    <h1>Edit Products</h1>

    <aside>
        <h2>Categories</h2>
        <nav>
        <ul>
            <?php foreach ($categories as $category) : ?>
            <li>
                <a href="edit_product_form.php?category_id=<?php echo $category['categoryID']; ?>">
                    <?php echo $category['categoryName']; ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
        </nav>          
    </aside>

    <section>
        <h2><?php echo $category_name; ?></h2>
        <table>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th class="right">Price</th>
                <th>&nbsp;</th>
            </tr>

            <?php foreach ($products as $product) : ?>
            <tr>
                <form action="edit_product.php" method="post">
                    <!-- Lưu ID để biết đang sửa sản phẩm nào -->
                    <input type="hidden" name="product_id" value="<?php echo $product['productID']; ?>">
                    <input type="hidden" name="category_id" value="<?php echo $product['categoryID']; ?>">

                    <!-- Các trường cho phép chỉnh sửa trực tiếp -->
                    <td>
                        <input type="text" name="code" value="<?php echo $product['productCode']; ?>">
                    </td>
                    <td>
                        <input type="text" name="name" value="<?php echo $product['productName']; ?>">
                    </td>
                    <td class="right">
                        <input type="text" name="price" value="<?php echo $product['listPrice']; ?>">
                    </td>
                    <td>
                        <input type="submit" value="Edit">
                    </td>
                </form>
            </tr>
            <?php endforeach; ?>
        </table>

        <p><a href="index.php">View Product List</a></p>
        <p><a href="add_product_form.php">Add Product</a></p>
        <p><a href="category_list.php">List Categories</a></p>
    </section>
</main>
<footer>
    <p>&copy; <?php echo date("Y"); ?> My Guitar Shop, Inc.</p>
</footer>
</body>
</html>