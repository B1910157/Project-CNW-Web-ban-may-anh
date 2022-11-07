<?php
include "C:/xampp/apps/project/bootstrap.php";

use CT275\Project\Product;
use CT275\Project\User;

$product = new Product($PDO);
$user = new User($PDO);
$users = $user->getUser();
$products = $product->all();

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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <link href="//cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="<?= BASE_URL_PATH . "css/sticky-footer.css" ?>" rel=" stylesheet">
  <link href="<?= BASE_URL_PATH . "css/font-awesome.min.css" ?>" rel=" stylesheet">
  <link href="<?= BASE_URL_PATH . "css/animate.css" ?>" rel=" stylesheet">
  <link href="<?= BASE_URL_PATH . "css/style.css" ?>" rel=" stylesheet">
</head>

<body>
  <!-- Main Page Content -->
  <div class="container">
    <?php include "../../partials/nav_admin.php" ?>
    <!-- Tab panes -->
    <hr>
    <div class="row text-center">
      <div class="col-4">
        <a href="manage_user.php" class="col-6  btn btn-outline-info  my-sm-0" style="height:150px;">
          <i class="fa fa-users p-3" aria-hidden="true" style="font-size: 80px;"></i>
          <p>Quản lý người dùng</p>

        </a>

      </div>
      <div class="col-4">
        <a href="manage_Pro.php" class="col-6  btn btn-outline-info  my-sm-0" style="height: 150px;">
          <i class="fa fa-shopping-cart p-3" aria-hidden="true" style="font-size: 80px;"></i>
          <p>Quản lý sản phẩm</p>

        </a>
      </div>
      <div class="col-4">
        <a href="manage_order.php" class="col-6  btn btn-outline-info  my-sm-0" style="height:150px;">
          <i class="fa fa-money p-3" aria-hidden="true" style="font-size: 80px;"> </i>
          <p>Quản lý đơn hàng</p>

        </a>
      </div>

    </div>
    <hr>

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