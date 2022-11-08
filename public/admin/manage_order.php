<?php
include "C:/xampp/apps/project/bootstrap.php";

use CT275\Project\Product;
use CT275\Project\User;
use CT275\Project\Order;

$order = new Order($PDO);
$user = new User($PDO);

$getAllOrder = $order->all();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shop Máy Ảnh</title>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

    <link href="//cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?= BASE_URL_PATH . "css/sticky-footer.css" ?>" rel=" stylesheet">
    <link href="<?= BASE_URL_PATH . "css/font-awesome.min.css" ?>" rel=" stylesheet">
    <link href="<?= BASE_URL_PATH . "css/animate.css" ?>" rel=" stylesheet">
    <link href="<?= BASE_URL_PATH . "css/style.css" ?>" rel=" stylesheet">
</head>

<body>
    <!-- Main Page Content -->
    <div class="container">
        <?php include "../../partials/nav_admin.php"; ?>
        <hr>
        <!-- Tab panes -->
        <div class="text-right">
            <a href="manage_order.php"> <i class="fa fa-bell" aria-hidden="true"> Đơn hàng mới</i>|</a>
            <a href="ordered.php"><i class="fa fa-clock-o" aria-hidden="true"> Đơn hàng đã duyệt</i></a>

        </div>
        <hr>
       
       <table class="table table-bordered text-center">
        <p class="text-primary m-3 title text-center">Đơn hàng mới</p>
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
            <?php foreach ($getAllOrder as $order):
                if ($order ->status == 0) {
                ?>
            <tr>
                <td>
                    <?php echo $order->getId(); ?>
                </td>
                <td><?php $nd = $user->find($order->userID); echo $nd->fullname; ?></td>
                <td><?php echo number_format($order->total_price, 0, '', '.'); ?> VNĐ</td>
                <td><?php $timestamp = strtotime($order->created_day); echo date('d-m-Y', $timestamp);?></td>
                <td>
                    <form method="get" action="accept_order.php" enctype="multipart/form-data">
                        <input hidden type="text" name="order_id" value="<?php echo $order->getId(); ?>">
                        <button class=" btn w-100 text-warning" type="submit"><i class="fa fa-check-square-o" aria-hidden="true"> Duyệt đơn hàng</i></button>
                    </form>
                </td>
            </tr>
        <?php } endforeach ?>
        </tbody>
       </table>
       
           

   


    <?php include('C:/xampp/apps/project/partials/footer.php'); ?>
    </div>


    <script src="<?= BASE_URL_PATH . " js/wow.min.js" ?>">
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"> </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"> </script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"> </script>

    <script>
        $(document).ready(function() {
            $('#product').DataTable();
            $('.dataTables_length').addClass('bs-select');
        });
    </script>

</body>

</html>