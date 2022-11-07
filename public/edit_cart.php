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
$edit_cart = $cart->update_cart($cart_id,$quantity,$product_id);
// $sql = "update chitietgiohang set quantity = :quantity where (cart_id = :cart_id and product_id = :product_id)";
// $query = $PDO->prepare($sql);
// $query->execute([
//         'quantity' => $quantity,
//         'cart_id' => $cart_id,
//         'product_id' => $product_id
//     ]);
echo '<script>alert("Đã cập nhật số lượng sản phẩm.");</script>';
echo '<script>window.location.href= "cart.php";</script>';
?>