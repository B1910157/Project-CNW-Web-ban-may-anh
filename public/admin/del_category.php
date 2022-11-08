<?php  
include "C:/xampp/apps/project/bootstrap.php";
require_once 'C:/xampp/apps/project/bootstrap.php';
use CT275\Project\Category;
$errors = [];
$category= new Category($PDO);
if ((isset($_GET['id'])) && ($category->find($_GET['id'])) !== NULL) {
    // $er = $category->validateToDelete();
    // var_dump();
    if($category->validateToDelete() == true){
        $category->delete();
        echo '<script>alert("Xóa danh muc thành công.");</script>';
        echo "<script>window.location.href= 'manage_category.php';</script>";
    } else {
        echo '<script>alert("Danh sách sản phẩm này tồn tại sản phẩm! Không thể xóa");</script>';
        echo "<script>window.location.href= 'manage_category.php';</script>";
    }
}
?>