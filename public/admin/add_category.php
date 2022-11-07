<?php
include "C:/xampp/apps/project/bootstrap.php";
require_once 'C:/xampp/apps/project/bootstrap.php';
// use CT275\Project\Product;
use CT275\Project\Category;
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$category = new Category($PDO);
	$category->fill($_POST);
	if ($category->validate()) {
		$category->save(); 
		echo '<script>alert("Thêm danh mục sản phẩm thành công.");</script>';
		echo '<script>window.location.href= "manage_category.php";</script>';
	} $errors = $category->getValidationErrors();
	if (isset($errors['category_name'])) {
		echo '<script>alert("Tên danh mục sản phẩm không hợp lệ.");</script>';
		echo "<script>window.location.href= 'manage_category.php';</script>";
	}
	
}
?>