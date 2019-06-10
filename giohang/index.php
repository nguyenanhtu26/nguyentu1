<?php
session_start();
require_once('database.php');
$database = new Database();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
<?php if (isset($_SESSION['cart_item']) && !empty($_SESSION('cart_item'))) {
    ?>
    <div class="container">
        <h2>Giỏ Hàng</h2>
        <p>Chi tiết giỏ hàng</p>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>ID sản phẩm</th>
                <th>Tên sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Giá tiền</th>
                <th>Số lượng</th>
                <th>Thành Tiền</th>
                <th>Xóa</th>
            </tr>
            </thead>
            <tbody>
            <?php $total = 0;
            foreach ($_SERVER['cart_item'] as $key_car => $val_cart_item):
                ?>
                <tr>
                    <td><?php $val_cart_item['id'] ?></td>
                    <td><?php $val_cart_item['product_name'] ?></td>
                    <td><img class="card-img-top" src="image/<?php echo $val_cart_item['product_image']; ?>" alt=""
                             style="display: block;width: 100%;height: 25px" data-holder-rendered="true"></td>
                    <td><?php $val_cart_item['price'] ?></td>
                    <td><?php $val_cart_item['quantity'] ?></td>
                    <td><?php $val_cart_item['quantity'] * $val_cart_item['price'] ?></td>

                    <td>
                        <form action="remove  <?php echo $val_cart_item['id']?>" method="post" action="process.php">
                            <a href="#">Xoas</a>
                            <input  type="hidden" name="product_id"></input>
                            <input type="submit" name="submit" class="btn btn-sm btn-outline-secondary"
                                   value="Xoa">
                        </form>
                    </td>
                </tr>
                <?php
                $total += $val_cart_item['quantity'] * $val_cart_item['price'];
            endforeach;
            ?>
            </tbody>
        </table>
        <div>Tổng hóa đơn thanh toán <strong><?php echo $total?>VND</strong></div>
    </div>
<?php } else { ?>
    <div class="container">
        <h2>Giỏ Hàng</h2>
        <p> ko co </p>
    </div>
    <?php
}
?>
<div class="container" style="margin-top: 50px">
    <div class="row">
        <?php
        $sql = "SELECT * FROM products";
        $product = $database->runQuery($sql);

        ?>
        <?php if (!empty($product)): ?>
            <?php foreach ($product as $sp):

                ?>
                <div class="col-sm-6">
                    <form action="process.php" method="post" name="product<?php echo $sp['id']; ?>">
                        <div class="card mb-4 box-shadow">
                            <img class="card-img-top" src="image/<?php echo $sp['product_image']; ?>" alt=""
                                 style="display: block;width: 100%;height: 315px" data-holder-rendered="true">
                            <p class="card text" style="font-weight: bold">
                                <?php
                                echo $sp['product_name'];
                                ?>
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="form-inline">
                                    <input type="text" class="form-control"
                                           name="quantity" value="1">
                                    <input type="hidden" name="action" value="add">
                                    <input type="hidden" name="product_id" value="<?php echo $sp['id']; ?>">
                                    <label style="margin-left: 10px ">
                                        <input type="submit" name="submit" class="btn btn-sm btn-outline-secondary"
                                               value="Thêm vào giỏ hàng">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            <?php endforeach;
            ?>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
