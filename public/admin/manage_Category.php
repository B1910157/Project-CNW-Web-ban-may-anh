<?php
include "C:/xampp/apps/project/bootstrap.php";

// use CT275\Project\Product;
// use CT275\Project\User;
use CT275\Project\Category;
$category = new Category($PDO);

$categorys = $category->all();

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
        <!-- Tab panes -->
        <div id="menu1" class="container"><br>
            <div class="offset-3 col-6">
                <form action="add_category.php" enctype="multipart/form-data" method="post">
                    <table class="table table-bordered">
                        <tr>
                            <th colspan="2" class="text-center title">THÊM DANH MỤC MỚI</th>
                        </tr>
                        <tr>
                            <td>Tên danh mục</td>
                            <td><input require type="text" name="category_name" placeholder="Nhập tên danh mục" value="<?php if (isset($_GET['category_name'])) {
                                                                                                                            echo $_GET['category_name'];
                                                                                                                        } ?>"></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-right">
                                <button type="submit" class="btn btn-primary">
                                    Thêm danh mục
                                </button>
                            </td>
                            <!-- <td  colspan="2" class="text-right"><input  type="submit" value="Thêm sản phẩm" name="themsanpham"></td> -->
                        </tr>
                    </table>
                </form>
            </div>
            <h3 class="title text-center">Danh Mục Sản Phẩm</h3>
            <div>
                <table width id="product" class="table table-bordered table-striped text-center">
                    <thead class="text-center">
                        <tr>
                            <th>ID</th>
                            <th>Tên Danh Mục</th>
                            <th width="15%">Tùy Chọn</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categorys as $category) :
                            $categoryID = $category->getId();
                        ?>
                            <tr>
                                <td><?= htmlspecialchars($categoryID) ?></td>
                                <td><?= htmlspecialchars($category->category_name) ?></td>
                                <td><a class="btn btn-sm btn-danger" href="del_category.php?id=<?php echo $categoryID; ?>"><i class="fa fa-trash" aria-hidden="true"> XÓA</i></a>
                                    <a id="edit" class="btn btn-sm btn-warning" href="edit_category.php?id=<?php echo $categoryID; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"> SỬA</i></a>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
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