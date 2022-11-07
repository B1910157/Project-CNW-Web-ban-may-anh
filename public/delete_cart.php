<?php 
include "../bootstrap.php";

use CT275\Project\Cart;
$cart = new Cart($PDO);
$del_cart = $cart->delete_cart($_GET['cart_id'],$_GET['product_id']);
echo "<script>alert('Đã xóa sản phẩm.');</script>";
echo '<script>window.location.href = "cart.php"</script>';
 ?>