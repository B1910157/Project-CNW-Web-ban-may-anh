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
			echo '<script>alert("Thêm người dùng thành công.");</script>';
			echo '<script>window.location.href= "index.php";</script>';
		} $errors = $user->getValidationErrors();
		if (isset($errors['fullname'])) {
			$username = $_POST['username'];
			echo '<script>alert("Họ tên không hợp lệ.");</script>';
			echo "<script>window.location.href= 'index.php?username=$username';</script>";
		}
		if (isset($errors['diachi'])) {
			echo '<script>alert("Địa không hợp lệ.");</script>';
			echo "<script>window.location.href= 'index.php?diachi=$diachi';</script>";
		}
		if (isset($errors['username'])) {
			$fullname = $_POST['fullname'];
			echo '<script>alert("Tên đăng nhập không hợp lệ.");</script>';
			echo "<script>window.location.href= 'index.php?fullname=$fullname';</script>";
		}
		if (isset($errors['password'])) {
			$username = $_POST['username'];
			$fullname = $_POST['fullname'];
			echo '<script>alert("Mật khẩu không hợp lệ.");</script>';
			echo "<script>window.location.href= 'index.php?fullname=$fullname&username=$username';</script>";
		}
	} else {
		$username = $_POST['username'];
		$fullname = $_POST['fullname'];
		echo '<script>alert("Xác nhận mật khẩu sai.");</script>';
		echo "<script>window.location.href= 'index.php?fullname=$fullname&username=$username';</script>";
	}
}
?>