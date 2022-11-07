<?php
include "C:/xampp/apps/project/bootstrap.php";
require_once 'C:/xampp/apps/project/bootstrap.php';
use CT275\Project\User;
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if ($_POST['password'] == $_POST['password2']) {
		$user = new User($PDO);
		$user->fill($_POST);
		if ($user->validate()) {
			$user->save(); 
			echo '<script>alert("Đăng ký thành công.");</script>';
			echo '<script>window.location.href= "login.php";</script>';
			// header("Location: login.php");
		} $errors = $user->getValidationErrors();
		if (isset($errors['fullname'])) {
			// $username = $_POST['username'];
			// $diachi = $_POST['diachi'];
			echo '<script>alert("Họ tên không hợp lệ.");</script>';
			echo "<script>window.location.href= 'register.php?username=$username';</script>";
		}if (isset($errors['diachi'])) {
			echo '<script>alert("Địa chỉ không đúng.");</script>';
			echo "<script>window.location.href= 'register.php?diachi=$diachi';</script>";
		}
		if (isset($errors['username'])) {
			$fullname = $_POST['fullname'];
			echo '<script>alert("Tên đăng nhập không hợp lệ.");</script>';
			echo "<script>window.location.href= 'register.php?fullname=$fullname';</script>";
		}
		if (isset($errors['password'])) {
			$username = $_POST['username'];
			$fullname = $_POST['fullname'];
			echo '<script>alert("Mật khẩu không hợp lệ.");</script>';
			echo "<script>window.location.href= 'register.php?fullname=$fullname&username=$username';</script>";
		}
		
	} else {
		$username = $_POST['username'];
		$fullname = $_POST['fullname'];
		echo '<script>alert("Xác nhận mật khẩu sai.");</script>';
		echo "<script>window.location.href= 'register.php?fullname=$fullname&username=$username';</script>";
	}
}
?>