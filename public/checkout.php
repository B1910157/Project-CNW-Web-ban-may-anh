<?php  
include "C:/xampp/apps/project/bootstrap.php";
require_once 'C:/xampp/apps/project/bootstrap.php';
use CT275\Project\Order;
$order = new Order($PDO);
$createOrder = $order->insertOrder($_GET['cart_id']);
if ($createOrder) {
	echo '<script>alert("Tạo đơn hàng thành công.");</script>';
	echo '<script>window.location.href= "order.php";</script>';
}
?>