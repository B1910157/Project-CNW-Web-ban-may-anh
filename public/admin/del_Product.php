<?php  
include "C:/xampp/apps/project/bootstrap.php";
require_once 'C:/xampp/apps/project/bootstrap.php';
use CT275\Project\Product;
$errors = [];
$product = new Product($PDO);
if ((isset($_GET['id'])) && ($product->find($_GET['id'])) !== NULL) {
	// $delete = $product->delete();
	if ($product->delete() == null) {
		echo '<script>alert("Xóa sản phẩm không thành công, sảm phẩm đã tồn tại trong giỏ hàng của khách.");</script>';
		echo '<script>window.location.href= "manage_Pro.php";</script>';
	} else {
	echo '<script>alert("Xóa sản phẩm thành công.");</script>';
	echo '<script>window.location.href= "manage_Pro.php";</script>';}
}
?>