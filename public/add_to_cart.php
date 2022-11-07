<?php 
session_start();
include "C:/xampp/apps/project/bootstrap.php";
require_once 'C:/xampp/apps/project/bootstrap.php';
use CT275\Project\Cart;
use CT275\Project\Product;
use CT275\Project\Category;

if (isset($_SESSION['id_user'])) {
$category = new Category($PDO);
$cart = new Cart($PDO);
$product = new Product($PDO);
$product_detail = $product->getProduct($_GET['id']);
$checkcart = $cart->getCart3($_SESSION['id_user'],$product_detail->getId());
if (isset($checkcart) && $checkcart != null) {
	$inStock = 0;
	if ($checkcart->product_id == $_GET['id']) {
		$inStock = 1;
	} else $inStock = 0;
	if ($inStock == 1) {
		$newVal = ($_GET['quantity']+$checkcart->quantity);
		$update_cart = $cart->update_cart($checkcart->getId(),$newVal,$_GET['id']);
    	echo "<script>alert('Sản phẩm đã có trong giỏ hàng,đã cập nhật số lượng.');</script>";
    	echo '<script>window.location.href = "detail.php?id='.$_GET['id'].'"</script>';
	} else {
		$insert_cart = $cart->insert_cart($checkcart->getId(),$_GET['id'],$_GET['quantity']);
    	echo "<script>alert('Đã thêm sản phẩm vào giỏ hàng.');</script>";
    	echo '<script>window.location.href = "detail.php?id='.$_GET['id'].'"</script>';
	}
} else {
	$result = $cart->find($_SESSION['id_user']);
	if ($result == null) {
		$add_new = $cart->addNewCart($_SESSION['id_user'],$result['cart_id'],$_GET['id'],$_GET['quantity']);
	    echo "<script>alert('Đã thêm sản phẩm vào giỏ hàng!');</script>";
    	echo '<script>window.location.href = "detail.php?id='.$_GET['id'].'"</script>';
	} else {
		$user_id = $_SESSION['id_user'];
		$result = $cart->find($user_id);
	    $insertCart = $cart->insert_cart($result['cart_id'],$_GET['id'],$_GET['quantity']);
	    echo "<script>alert('Đã thêm sản phẩm vào giỏ hàng!');</script>";
	    echo '<script>window.location.href = "detail.php?id='.$_GET['id'].'"</script>';
	}
}
} else {
	echo "<script>alert('Bạn cần đăng nhập để mua sản phẩm.');</script>";
    echo '<script>window.location.href = "login.php"</script>';
}
 ?>
