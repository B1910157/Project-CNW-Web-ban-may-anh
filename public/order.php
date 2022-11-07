<?php
include "../bootstrap.php";
session_start();

use CT275\Project\Product;
use CT275\Project\User;
use CT275\Project\Order;
use CT275\Project\Category;
$category = new Category($PDO);
$product = new Product($PDO);
$order = new Order($PDO);
$user = new User($PDO);
$categorys = $category->all();
$getOrder = $order->getOrders($_SESSION['id_user']);
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
			<h2 class="section-heading text-center wow fadeIn title" data-wow-duration="1s">Lịch sử đặt hàng của bạn</h2>

			<hr>
			<div class=" row">
				 <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>Mã đơn hàng</th>
                    <th>Người mua</th>
                    <th>Tổng tiền</th>
                    <th>Ngày mua</th>
                    <th width="15%"></th>
                </tr>
            </thead>
            <tbody>
            	<?php foreach ($getOrder as $dh):?>
                <tr>
                    <td>
                        <?php echo $dh->getId(); ?>
                    </td>
                    <td><?php $nd = $user->find($dh->userID); echo $nd->fullname; ?></td>
                    <td><?php echo number_format($dh->total_price, 0, '', '.'); ?> VNĐ</td>
                    <td><?php $timestamp = strtotime($dh->created_day); echo date('d-m-Y', $timestamp);?></td>
                    <td>
                        <p class="text-primary"><?php if ($dh->status == 0) {
                        	echo "<p class='text-warning'>Chưa duyệt</p>";
                        } else echo "Đã duyệt"; ?></p>
                    </td>
					
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
				

			</div>

		</section>
		<?php include('../partials/footer.php'); ?>
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