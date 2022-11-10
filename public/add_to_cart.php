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
$product_detail = $product->find($_GET['id']);
$checkcart = $cart->getCart3($_SESSION['id_user'],$product_detail->getId());
if (isset($checkcart) && $checkcart != null) {
	$inStock = 0;
	if ($checkcart->product_id == $_GET['id']) {
		$inStock = 1;
	} else $inStock = 0;
	if ($inStock == 1) {
		$newVal = ($_GET['quantity']+$checkcart->quantity);
		$array1 = [];
		$array1['cart_id'] = $checkcart->getId();
		$array1['quantity'] = $newVal;
		$array1['productID'] = $_GET['id'];
		$update_cart = $cart->update_cart($array1);
    	echo "<script>alert('Sản phẩm đã có trong giỏ hàng,đã cập nhật số lượng.');</script>";
    	echo '<script>window.location.href = "detail.php?id='.$_GET['id'].'"</script>';
	} else {
		$array2 = [];
		$array2['cart_id'] = $checkcart->getId();
		$array2['quantity'] = $newVal;
		$array2['productID'] = $_GET['id'];
		$insert_cart = $cart->insert_cart($array2);
    	echo "<script>alert('Đã thêm sản phẩm vào giỏ hàng!');</script>";
    	echo '<script>window.location.href = "detail.php?id='.$_GET['id'].'"</script>';
	}
} else {
	$result = $cart->findUserCart($_SESSION['id_user']);
	if ($result == null) {
		$array3 = [];
		$array3['userID'] = $_SESSION['id_user'];
		$array3['productID'] = $_GET['id'];
		$array3['quantity'] = $_GET['quantity'];
		$add_new = $cart->addNewCart($array3);
	    echo "<script>alert('Đã thêm sản phẩm vào giỏ hàng!!');</script>";
	    // print_r($array3);
    	echo '<script>window.location.href = "detail.php?id='.$_GET['id'].'"</script>';
	} else {
		// $user_id = $_SESSION['id_user'];
		// $result = $cart->find($user_id);
		$array4 = [];
		$array4['cart_id'] = $result->getId();
		// echo $result->cart_id;
		$array4['quantity'] = $_GET['quantity'];
		$array4['productID'] = $_GET['id'];
	    $insertCart = $cart->insert_cart($array4);
	    echo "<script>alert('Đã thêm sản phẩm vào giỏ hàng!!!');</script>";
	    echo '<script>window.location.href = "detail.php?id='.$_GET['id'].'"</script>';
	}
}
} else {
	echo "<script>alert('Bạn cần đăng nhập để mua sản phẩm.');</script>";
    echo '<script>window.location.href = "login.php"</script>';
}
 ?>
