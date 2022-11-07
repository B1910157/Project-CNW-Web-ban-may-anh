<?php

include "C:/xampp/apps/project/bootstrap.php";

use CT275\Project\Product;
use CT275\Project\User;
use CT275\Project\Category;
$product = new Product($PDO);
$category =  new Category($PDO);
$categorys = $category->all();

$id = isset($_REQUEST['id']) ?
  filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT) : -1;
// echo "<script>alert('".$id."');</script>";
if ($id < 0 || !($product->find($id))) {
  redirect(BASE_URL_PATH);
  // echo "<script>alert('checker');</script>";
}
// echo "<script>alert('".$id."');</script>";
?>
<?PHP
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  if ($product->update($_POST, $_FILES)) {
    // Cập nhật dữ liệu thành công
    echo '<script>alert("Cập nhật sản phẩm thành công");</script>';
    echo '<script>window.location.href= "manage_Pro.php";</script>';
    echo "<script>alert('YES');</script>";
  }
  // Cập nhật dữ liệu không thành công
  $errors = $product->getValidationErrors();
  echo "<script>alert('NO');</script>";
  // echo "<script>alert('";
  print_r($errors);
  // echo "');</script>";
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
          <form action="edit_Product.php" enctype="multipart/form-data" method="post">
            <input hidden type="text" name="id" value="<?php echo $id; ?>">
            <table class="table table-bordered">
              <tr>
                <th colspan="2" class="text-center title">SỬA SẢN PHẨM <?php echo $product->name ?> </th>
              </tr>
              <tr>
                <td>Tên sản phẩm</td>
                <td><input require type="text" name="name" value="<?= htmlspecialchars($product->name) ?>"></td>
              </tr>
              <tr>
                <td>Giá sản phẩm</td>
                <td><input require type="text" name="price" placeholder="Nhập giá sản phẩm" value="<?= htmlspecialchars($product->price) ?>"></td>
              </tr>
              <tr>
                <td>Danh mục</td>
                <td>
                  <select name="category_id">
                    <option hidden>--- Chọn danh mục --- </option>
                    <?php foreach ($categorys as $category) :
                      $categoryID = $category->getId(); ?>
                      <option> <?php echo htmlspecialchars($category->getId()); echo htmlspecialchars($category->category_name) ?></option>
                    <?php endforeach; ?>
                  </select>
                </td>
              </tr>
              <tr>
                <td>Hình ảnh sản phẩm</td>
                <td><input require type="file" name="image" id="hinhanhsanpham" value="<?= htmlspecialchars($product->image) ?>"></td>
              </tr>
              <tr>
                <td>Mô tả sản phẩm</td>
                <td><textarea require name="description" id="" cols="30" rows="5" placeholder="Mô tả sản phẩm"><?= htmlspecialchars($product->description) ?></textarea></td>
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