<?php

include "C:/xampp/apps/project/bootstrap.php";

use CT275\Project\Product;
use CT275\Project\Category;
$product = new Product($PDO);
$category =  new Category($PDO);
// $categorys = $category->all();
$id = isset($_REQUEST['id']) ?
  filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT) : -1;
// echo "<script>alert('".$id."');</script>";
if ($id < 0 || !($category->find($id))) {
  redirect(BASE_URL_PATH);
  // echo "<script>alert('checker');</script>";
}
//echo "<script>alert('".$id."');</script>";
?>
<?PHP

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  if ($category->update($_POST)) {
    // Cập nhật dữ liệu thành công
    //redirect(BASE_URL_PATH);
    echo "<script>alert('Cập nhật danh mục thành công');</script>";
    echo "<script>window.location.href= 'manage_category.php';</script>";
  }
  // Cập nhật dữ liệu không thành công
  $errors = $category->getValidationErrors();
  echo "<script>alert('Có lỗi xảy ra');</script>";
  print_r($errors);
}
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
    <?php include "../../partials/nav_admin.php" ?>
    <!-- Tab panes -->
    <div class="tab-content">
      <div id="home" class="container tab-pane active"><br>
        <div class="offset-3 col-6">
          <form action="edit_category.php" enctype="multipart/form-data" method="post">
            <input hidden type="text" name="id" value="<?php echo $id; ?>">
            <table class="table table-bordered">
              <tr>
                <th colspan="2" class="text-center title">SỬA DANH MỤC <?php echo $category->category_name ?> </th>
              </tr>
              <tr>
                <td>Tên danh muc</td>
                <td><input require type="text" name="category_name" value="<?= htmlspecialchars($category->category_name) ?>"></td>
              </tr>
              <tr>
                <td colspan="2" class="text-right">
                  <button type="submit" class="btn btn-primary" id="submit" name="submit">
                    Sửa sản phẩm
                  </button>
                </td>
                <!-- <td  colspan="2" class="text-right"><input  type="submit" value="Thêm sản phẩm" name="themsanpham"></td> -->
              </tr>
            </table>
          </form>
        </div>
      </div>
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