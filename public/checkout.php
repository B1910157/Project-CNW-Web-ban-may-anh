<?php  
include "C:/xampp/apps/project/bootstrap.php";
require_once 'C:/xampp/apps/project/bootstrap.php';
use CT275\Project\Order;
use CT275\Project\Cart;
$order = new Order($PDO);
$cart = new Cart($PDO);
$findCart = $cart->findCart($_GET['cart_id']);
$array = [];
$array['userID'] = $findCart->userID;
$array['cart_id'] = $findCart->getId();
$array['status'] = 0;
$array['total_price'] = 0;
// print_r($findCart);
if ($findCart != null) {
	$createOrder = $order->insertOrder($array);
}
if ($createOrder) {
	echo '<script>alert("Tạo đơn hàng thành công.");</script>';
	echo '<script>window.location.href= "order.php";</script>';
}
?>