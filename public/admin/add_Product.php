<?php
include "C:/xampp/apps/project/bootstrap.php";
require_once 'C:/xampp/apps/project/bootstrap.php';
use CT275\Project\Product;
use CT275\Project\Category;
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$product = new Product($PDO);
	$product->fill($_POST,$_FILES);
	if ($product->validate()) {
		$product->save(); 
		echo '<script>alert("Thêm sản phẩm thành công.");</script>';
		echo '<script>window.location.href= "manage_Pro.php";</script>';
	} $errors = $product->getValidationErrors();
	if (isset($errors['name'])) {
		$price = $_POST['price'];
		$description = $_POST['description'];
		$category_id = $_POST['category_id'];
		echo '<script>alert("Tên sản phẩm không hợp lệ.");</script>';
		echo "<script>window.location.href= 'manage_Pro.php?price=$price&description=$description&category_id=$category_id';</script>";
	}
	if (isset($errors['price'])) {
		$name = $_POST['name'];
		$description = $_POST['description'];
		$category_id = $_POST['category_id'];
		echo '<script>alert("Giá sản phẩm không hợp lệ.");</script>';
		echo "<script>window.location.href= 'manage_Pro.php?name=$name&description=$description&category_id=$category_id';</script>";
	}
	if (isset($errors['description'])) {
		$name = $_POST['name'];
		$price = $_POST['price'];
		$category_id = $_POST['category_id'];
		echo '<script>alert("Mô tả sản phẩm không hợp lệ.");</script>';
		echo "<script>window.location.href= 'manage_Pro.php?name=$name&price=$price&category_id=$category_id';</script>";
	}
	if (isset($errors['category_id'])) {
		$name = $_POST['name'];
		$description = $_POST['description'];
		$price = $_POST['price'];
		echo '<script>alert("Tên danh muc sản phẩm không hợp lệ.");</script>';
		echo "<script>window.location.href= 'manage_Pro.php?name=$name&description=$description&price=$price';</script>";
	}
	if (isset($errors['image'])) {
		$name = $_POST['name'];
		$description = $_POST['description'];
		$price = $_POST['price'];
		$category_id = $_POST['category_id'];
		echo '<script>alert("Hình ảnh không hợp lệ.");</script>';
		echo "<script>window.location.href= 'manage_Pro.php?name=$name&description=$description&price=$price&category_id=$category_id';</script>";
	}
}
?>