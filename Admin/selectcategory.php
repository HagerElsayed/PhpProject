<?php
require_once '../DatabaseClasses/functions.php';
require_once '../DatabaseClasses/config.php';

if (isset($_POST['category_name'])) {
    $category_name = $_POST['category_name'];
    $subcategoryList = subcategory::selectsubCategories($category_name);
    echo json_encode($subcategoryList);
}
?>
