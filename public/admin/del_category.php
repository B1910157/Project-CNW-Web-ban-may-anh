<?php  
include "C:/xampp/apps/project/bootstrap.php";
require_once 'C:/xampp/apps/project/bootstrap.php';
use CT275\Project\Category;
$errors = [];
$category= new Category($PDO);
// $category_id = $_GET['id'];
// echo $category_id;
// $del_category = $category->delete();
// echo '<script>alert("Xóa danh muc thành công.");</script>';
// echo '<script>window.location.href= "index.php";</script>';

if ((isset($_GET['id'])) && ($category->find($_GET['id'])) !== NULL) {
	// $delete = $product->delete();
    $test = $category->delete2();
    if($category->delete2() == true){
        echo '<script>alert("Xóa danh muc thành công.");</script>';
    }
    else{
        echo '<script>alert("Xóa danh muc khong thành công.");</script>';
    }
    echo "<script>window.location.href= 'manage_category.php';</script>";
}

?>