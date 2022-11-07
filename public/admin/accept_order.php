<?php 
include "C:/xampp/apps/project/bootstrap.php";
require_once 'C:/xampp/apps/project/bootstrap.php';
use CT275\Project\Order;
$order = new Order($PDO);
$id = $_GET['order_id'];
$result = $order->update($id);
echo '<script>alert("Bạn đã duyệt đơn hàng này.");</script>';
echo '<script>window.location.href= "ordered.php";</script>';
?>