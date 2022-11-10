<?php 
include "C:/xampp/apps/project/bootstrap.php";
require_once 'C:/xampp/apps/project/bootstrap.php';
use CT275\Project\Cart;

if (isset($_GET)) {
	$cart_id = $_GET['cart_id'];
	$product_id = $_GET['product_id'];
	$quantity = $_GET['quantity'];
}

$cart = new Cart($PDO);
$array = [];
$array['cart_id'] = $cart_id;
$array['quantity'] = $quantity;
$array['productID'] = $product_id;
if ($cart->find2($array['cart_id'],$array['productID'])) {
	$edit_cart = $cart->update_cart($array);
echo '<script>alert("Đã cập nhật số lượng sản phẩm.");</script>';
echo '<script>window.location.href= "cart.php";</script>';
} else {
	echo '<script>alert("Cập nhật số lượng sản phẩm không thành công.");</script>';
	echo '<script>window.location.href= "cart.php";</script>';
}

?>