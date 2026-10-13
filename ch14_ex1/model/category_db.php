<?php
class CategoryDB {
    // BƯỚC 9: Bỏ từ khóa static (chuyển sang regular method) 
    public function getCategories() {
        $db = Database::getDB();
        $query = 'SELECT * FROM categories ORDER BY categoryID';
        $statement = $db->prepare($query);
        $statement->execute();
        
        $categories = array();
        foreach ($statement as $row) {
            //  BƯỚC 5: Tạo đối tượng rỗng và dùng setter gán dữ liệu 
            $category = new Category();
            $category->setID($row['categoryID']);
            $category->setName($row['categoryName']);
            $categories[] = $category;
        }
        return $categories;
    }

    //  BƯỚC 9: Bỏ static ở hàm getCategory
    public function getCategory($category_id) {
        $db = Database::getDB();
        $query = 'SELECT * FROM categories WHERE categoryID = :category_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $category_id);
        $statement->execute();    
        $row = $statement->fetch();
        $statement->closeCursor();    
        
        //  BƯỚC 5: Sử dụng setter 
        $category = new Category();
        $category->setID($row['categoryID']);
        $category->setName($row['categoryName']);
        return $category;
    }
}
?>