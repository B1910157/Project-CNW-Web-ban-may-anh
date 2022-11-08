<?php 
include "C:/xampp/apps/project/bootstrap.php";
require_once 'C:/xampp/apps/project/bootstrap.php';
use CT275\Project\Order;
$order = new Order($PDO);
$id = $_GET['order_id'];
$findOrder = $order->find2($id);
if ($findOrder != null) {
	$array = [];
	$array['userID'] = $findOrder->userID;
	$array['cart_id'] = $findOrder->cart_id;
	$array['status'] = $findOrder->status;
	$array['total_price'] = $findOrder->total_price;
	$result = $order->update($array);
	// print_r($array);
	if ($result == true) {
		echo '<script>alert("Bạn đã duyệt đơn hàng này.");</script>';
		echo '<script>window.location.href= "manage_order.php";</script>';
	} else {
		echo '<script>alert("Không thể duyệt đơn hàng này.");</script>';
		echo '<script>window.location.href= "manage_order.php";</script>';
	}
	// print_r($order->getValidationErrors());
} else {
	echo '<script>alert("Không thể duyệt đơn hàng này.");</script>';
	echo '<script>window.location.href= "manage_order.php";</script>';
}

?>