<?php
session_start();

$cart = $_SESSION['cart'] ?? [];

if (isset($_GET['ma_sp'])) {
    $ma_sp = $_GET['ma_sp'];
    if (isset($cart[$ma_sp])) {
        $cart[$ma_sp]['soluong']++;
    }
    $_SESSION['cart'] = $cart;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
</head>

<body>
    <h1>Giỏ hàng của bạn</h1>

    <a href="../index.php">
        quay về trang chủ tại đây
    </a>

    <?php if (isset($cart) && !empty($cart)) : ?>
        <table border="1" width="100%">
            <thead>
                <tr>
                    <td>#</td>
                    <td>Tên</td>
                    <td>Ảnh</td>
                    <td>Giá</td>
                    <td>Mô tả</td>
                    <td>Số lượng</td>
                    <td>Tăng số lượng</td>
                    <td>Giảm số lượng</td>
                    <td>Xóa sản phẩm</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cart as $ma_sp => $each) : ?>
                    <tr>
                        <td><?php echo $ma_sp ?></td>
                        <td><?php echo $each['ten_sp'] ?></td>
                        <td>
                            <img src="../<?php echo $each['anh_sp'] ?>" alt="" style="height:200px">
                        </td>
                        <td><?php echo $each['gia_sp'] ?></td>
                        <td><?php echo $each['mota_sp'] ?></td>
                        <td><?php echo $each['soluong'] ?></td>
                        <td>
                            <a href="thaydoisoluong.php?ma_sp=<?php echo $ma_sp ?>&type=incre">+</a>
                        </td>
                        <td>
                            <a href="thaydoisoluong.php?ma_sp=<?php echo $ma_sp ?>&type=decre">-</a>
                        </td>
                        <td>
                            <a href="xoagiohang.php?ma_sp=<?php echo $ma_sp ?>">
                                Xóa
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php
        $tongtien = 0;

        if (isset($_SESSION['cart'])) {
            foreach ($cart as $ma_sp => $each) {
                $tongtien += @($each['gia_sp'] * $each['soluong']);
            }
        }

        $_SESSION['tongtien'] = $tongtien;
        $_SESSION['soluong'] = count($cart);
        ?>
        <p>Tổng tiền: <?php echo $tongtien ?> VND</p>
        <button type="submit"><a href="../index.php?action=CheckOut">Thanh toán</a></button>
    <?php else : ?>
        <p class="text-center">Giỏ hàng rỗng</p>

        <?php
        error_reporting(0);
        ini_set('display_errors', 0);
        ?>
    <?php endif; ?>
</body>

</html>