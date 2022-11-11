<?php
include "../bootstrap.php";

use CT275\Project\User;
use CT275\Project\Category;
$category = new Category($PDO);
$categorys = $category->all();
$user = new User($PDO);
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['password'] === $_POST['password2']) {
        $user->fill($_POST);
        if ($user->validate()) {
            $user->save();
            echo '<script>alert("Đăng ký thành công.");</script>';
            echo '<script>window.location.href= "login.php";</script>';
            header("Location: login.php");
        }
    }
}

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
    <link href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="//cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet">

    <link href="<?= BASE_URL_PATH . "css/sticky-footer.css" ?>" rel=" stylesheet">
    <link href="<?= BASE_URL_PATH . "css/font-awesome.min.css" ?>" rel=" stylesheet">
    <link href="<?= BASE_URL_PATH . "css/animate.css" ?>" rel=" stylesheet">
    <link href="<?= BASE_URL_PATH . "css/style.css" ?>" rel=" stylesheet">
</head>

<body>
    <!-- Main Page Content -->
    <div class="container ">
        <?php include('../partials/navbar.php');
        ?>
        <hr>
        <section class="bg-image" style="background-image: url('img/bg.jpeg');">
            <div class="mask d-flex align-items-center p-2">
                <div class="container ">
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                            <div class="card" style="border-radius: 15px;">
                                <div class="card-body p-5">
                                    <h2 class="text-uppercase text-center mb-5 title">Đăng ký thành viên</h2>
                                    <form method="post" action="process.php" id="signupForm">
                                        <div class="form-outline mb-4">
                                            <label class="form-label text-info">Họ tên của bạn</label>
                                            <input autocomplete="off"  type="text" class="form-control form-control-lg" name="fullname" />
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label text-info">Tên đăng nhập</label>
                                            <input autocomplete="off" type="text" class="form-control form-control-lg" name="username" />
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label text-info">Mật khẩu</label>
                                            <input autocomplete="off" type="password" class="form-control form-control-lg" name="password" id="password" />
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label text-info">Nhập lại mật khẩu</label>
                                            <input autocomplete="off" type="password" class="form-control form-control-lg" name="password2" />
                                        </div>
                                        <div class="form-outline mb-4">
                                            <label class="form-label text-info">Địa chỉ của bạn</label>
                                            <input autocomplete="off" type="text" class="form-control form-control-lg" name="diachi" />
                                        </div>

                                        <div class="d-flex justify-content-center">
                                            <button type="submit" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Đăng ký</button>
                                        </div>

                                        <p class="text-center text-muted mt-5 mb-0">Bạn đã có tài khoản? <a href="login.php" class="fw-bold text-body"><u>Đăng nhập</u></a></p>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <hr>
        <?php include('../partials/footer.php'); ?>
    </div>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
	<link href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
	<link href="//cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <script src="<?= BASE_URL_PATH . "js/wow.min.js" ?>"></script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="./js/jquery.validate.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            new WOW().init();
            $("#signupForm").validate({
                rules: {
                    fullname: "required",
                    username: {
                        required: true,
                        minlength: 2
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },
                    password2: {
                        required: true,
                        minlength: 5,
                        equalTo: "#password"
                    },
                    diachi: {
                        required: true
                    }
                },

                messages: {
                    fullname: "Nhập vào tên của bạn",

                    username: {
                        required: "Nhập tên đăng nhập của bạn",
                        minlength: "Tên đăng nhập phải có ít nhất 2 kí tự"
                    },

                    password: {
                        required: "Vui lòng nhập mật khẩu",
                        minlength: "Mật khẩu ít nhất 5 kí tự"
                    },

                    password2: {
                        required: "Vui lòng nhập lại mật khẩu",
                        minlength: "mật khẩu ít nhất 5 kí tự",
                        equalTo: "Nhập lại mật khẩu không trùng khớp"
                    },
                    diachi: {
                        required: "Nhập vào địa chỉ của bạn"
                    }

                },
                errorElement: "div",
                errorPlacement: function(error, element) {
                    error.addClass("invalid-feedback");
                    if (element.prop("type") === "checkbox") {
                        error.insertAfter(element.siblings("label"));
                    } else {
                        error.insertAfter(element);
                    }
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-invalid").removeClass("is-valid");
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-valid").removeClass("is-invalid");
                }
            });
        });
    </script>
</body>

</html>