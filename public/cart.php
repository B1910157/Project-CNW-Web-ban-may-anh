<?php
session_start();
include "../bootstrap.php";

use CT275\Project\Cart;
use CT275\Project\Product;
use CT275\Project\Category;
use CT275\Project\User;
$user = new User($PDO);
// use CT275\Project\User;
$cart = new Cart($PDO);
$product = new Product($PDO);
$category = new Category($PDO);
$categorys = $category->all();
if (isset($_SESSION["id_user"])) {
	$userID = $_SESSION["id_user"];
} else {
	echo '<script>alert("Bạn cần đăng nhập để xem giỏ hàng của mình.");</script>';
	echo '<script>window.location.href = "login.php";</script>';
}
$carts = $cart->getCart($userID);


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Shop Máy Ảnh</title>
	<!-- 
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"> -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
	<link href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
	<link href="//cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet">
	<link href="<?= BASE_URL_PATH . "css/sticky-footer.css" ?>" rel=" stylesheet">
	<link href="<?= BASE_URL_PATH . "css/font-awesome.min.css" ?>" rel=" stylesheet">
	<link href="<?= BASE_URL_PATH . "css/animate.css" ?>" rel=" stylesheet">
	<link href="<?= BASE_URL_PATH . "css/style.css" ?>" rel=" stylesheet">
</head>
<body>
	<!-- Main Page Content -->
	<div class="container">
		<?php include('../partials/navbar.php');
		?>
		<section id="inner" class="inner-section section">
			<!-- SECTION HEADING -->
			<hr>
			<h2 class="section-heading text-center wow fadeIn title" data-wow-duration="1s">GIỎ HÀNG</h2>
			<hr>
			<div class="btn btn-warning" style="float: right;">
				<a class="p-3" href="order.php">Lịch sử đặt hàng</a>
			</div>
			<table class="table table-borderd text-center ">
				<thead >
					<tr>
						<th>STT</th>
						<th>Tên Sản Phẩm</th>
						<th>Hình ảnh</th>
						<th>Số lượng</th>
						<th>Giá</th>
						<th>Tổng tiền</th>
						<th width="15%"></th>

					</tr>
				</thead>
				<tbody>
					<?php $n = 1; foreach ($carts as $cart):?>
					<tr>
						<td><?php echo $n; $n++; ?></td>
						<td><?php $pr =  $product->getProduct($cart->product_id); echo $pr->name;?></td>
						<td><img class="w-25 h-25" src="img/upload/<?php echo $pr->image ?>"></td>
						<td><form id="editCart" method="get" action="edit_cart.php">
							<input hidden type="text" name="cart_id" value="<?php echo $cart->getID(); ?>">
							<input hidden type="text" name="product_id" value="<?php echo $cart->product_id; ?>">
							<input required type="number"min="1" max="50" name="quantity" value="<?php echo $cart->quantity; ?>">
						</td>
						<td><?php echo $pr->price; ?><sup> vnđ</sup></td>
						<td><?php echo $pr->price*$cart->quantity; ?><sup> vnđ</sup></td>
						<td> 
							<button class="btn btn-warning" type="submit">Sửa</button>
							<a class="btn btn-danger" href="delete_cart.php?cart_id=<?php echo $cart->getID(); ?>&product_id=<?php echo $cart->product_id; ?>">Xóa</a>
						</td></form>
					</tr>

				<?php endforeach ?>
				</tbody>
			</table>
			<form method="get" enctype="multipart/form-data" action="checkout.php">
				<input hidden type="text" name="cart_id" value="<?php echo $cart->getID(); ?>">

				<div class="text-right"><button class="btn btn-primary" >Thanh Toán Giỏ Hàng</button></div></form>
			<hr>
		</section>
		<?php include('../partials/footer.php');?>
		</div>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<script src="//cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
	<script src="<?= BASE_URL_PATH . "js/wow.min.js" ?>"></script>
	<script>
		$(document).ready(function() {
			new WOW().init();
		});
	</script>
</body>
</html>