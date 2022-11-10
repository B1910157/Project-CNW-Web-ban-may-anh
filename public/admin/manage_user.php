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

    <link href="//cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?= BASE_URL_PATH . "css/sticky-footer.css" ?>" rel=" stylesheet">
    <link href="<?= BASE_URL_PATH . "css/font-awesome.min.css" ?>" rel=" stylesheet">
    <link href="<?= BASE_URL_PATH . "css/animate.css" ?>" rel=" stylesheet">
    <link href="<?= BASE_URL_PATH . "css/style.css" ?>" rel=" stylesheet">
</head>

<body>
    <!-- Main Page Content -->
    <div class="container">
        <?php include "../../partials/nav_admin.php"?>
        <!-- Tab panes -->
        <div class="tab-content">
            <div id="home" class="container "><br>
                <div class="offset-3 col-6">
                    <form action="add_User.php" enctype="multipart/form-data" method="post">
                        <table class="table table-bordered">
                            <tr>
                                <th colspan="2" class="text-center title">THÊM NGƯỜI DÙNG</th>
                            </tr>

                            <tr>
                                <td>Họ Và Tên: </td>
                                <td><input require type="text" name="fullname" placeholder="Nhập họ tên" value="<?php if (isset($_GET['fullname'])) {
                                                                                                                    echo $_GET['fullname'];
                                                                                                                } ?>"></td>
                            </tr>
                            <tr>
                                <td>Username: </td>
                                <td><input require type="text" name="username" placeholder="Nhập username" value="<?php if (isset($_GET['username'])) {
                                                                                                                        echo $_GET['username'];
                                                                                                                    } ?>"></td>
                            </tr>
                            <tr>
                                <td>Mật khẩu: </td>
                                <td><input require type="password" name="password" id="password" placeholder="Nhập password"></td>
                            </tr>
                            <tr>
                                <td>Nhập lại mật khẩu: </td>
                                <td><input require type="password" name="password2" placeholder="Nhập lại password"></td>
                            </tr>
                            <tr>
                                <td>Nhập lại mật khẩu: </td>
                                <td><input require type="text" name="diachi" placeholder="Địa chỉ của bạn"></td>
                            </tr>

                            <tr>
                                <td colspan="2" class="text-right">
                                    <button type="submit" class="btn btn-primary ">
                                        Thêm người dùng
                                    </button>
                                </td>
                                <!-- <td  colspan="2" class="text-right"><input  type="submit" value="Thêm sản phẩm" name="themsanpham"></td> -->
                            </tr>
                        </table>

                    </form>

                </div>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Họ Tên</th>
                            <th>Ngày Tạo Tài Khoản</th>
                            <th>Địa chỉ</th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php foreach ($users as $user) :
                            $userID = $user->getId();
                            $timestamp = strtotime($user->created_day);
                            $date = date('d-m-Y', $timestamp);
                        ?>
                            <tr>
                                <td><?= htmlspecialchars($userID) ?></td>
                                <td><?= htmlspecialchars($user->fullname) ?></td>
                                <td><?= htmlspecialchars($date) ?></td>
                                <td><?= htmlspecialchars($user->diachi) ?></td>
                                

                            </tr>
                        <?php endforeach ?>

                    </tbody>
                </table>
            </div>
            <?php include('C:/xampp/apps/project/partials/footer.php'); ?>
        </div>

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