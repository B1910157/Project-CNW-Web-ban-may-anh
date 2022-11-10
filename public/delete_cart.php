<?php
include "../bootstrap.php";

use CT275\Project\Cart;
$cart = new Cart($PDO);
if ($cart->find2($_GET['cart_id'],$_GET['product_id']) != null) {
    $del_cart = $cart->delete_detail();
    echo "<script>alert('Đã xóa sản phẩm.');</script>";
    echo '<script>window.location.href = "cart.php"</script>';
} else {
    echo "<script>alert('Xóa sản phẩm không thành công.');</script>";
    echo '<script>window.location.href = "cart.php"</script>';
}

?>