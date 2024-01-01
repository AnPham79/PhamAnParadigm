<?php
$tongsoluong = 0;

if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $soluong) {
        $tongsoluong += $soluong['soluong'];
    }
}
?>

<a href="?action=ViewCart"><?php echo 'Tổng số lượng' . " " . $tongsoluong; ?></a>

<br>

<?php
if (isset($_POST['soluong'])) {
    $_SESSION['soluong'] = $_POST['soluong'];
} else {
    $soluong = 1;
}
?>

<a href="./index.php?action=productPage">
    Quay về trang sản phẩm
</a>
<br>
<h1>Chi tiết sản phẩm</h1>

<p>Tên sản phẩm: <?php echo $prdObject->get_tensp() ?></p>
<img src="<?php echo $prdObject->get_anhsp() ?>" alt="ảnh sản phẩm" style="height:200px">
<p>Giá sản phẩm: <?php echo $prdObject->get_giasp() ?></p>
<p>Mô tả sản phẩm: <?php echo $prdObject->get_motasp() ?></p>
<p>Danh mục: <?php echo $prdObject->get_FK_ten_danhmuc() ?></p>
<p>Thương hiệu: <?php echo $prdObject->get_FK_ten_thuonghieu() ?></p>

<form action="?action=AddToCartInPrdDetail&ma_sp=<?php echo $prdObject->get_masp() ?>" method="POST">
    <h5>Tăng số lượng sản phẩm</h5>
    <button type="button" onclick="giamsoluong()">-</button>
    <input type="number" id="soluong" name="soluong" value="<?php echo $soluong ?>">
    <button type="button" onclick="tangsoluong()">+</button>
    <button type="submit">Thêm vào giỏ</button>
</form>

<?php
if (isset($_SESSION['hovaten'])) {
    ?>
    <p>Tên người bình luận: <?php echo $_SESSION['hovaten']; ?></p>
    <p>Thời gian hiện tại là: <?php echo date("Y-m-d H:i:s"); ?></p>

    <form action="?action=Comment" method="POST">
        <input type="hidden" name="ngaybinhluan" value="<?php echo date("Y-m-d H:i:s"); ?>">
        <input type="hidden" name="FK_ma_sp" value="<?php echo $prdObject->get_masp(); ?>">

        <h5>Nội dung bình luận</h5>
        <textarea name="noidungbinhluan"></textarea>

        <button type="submit">Đăng bình luận</button>
    </form>
    <?php
} else {
    echo 'Người dùng phải đăng nhập để bình luận';
}
?>

<?php
$product = new Product();
$comments = $product->GetCommentByFKid($prdObject->get_masp());

if (!empty($comments)) {
    foreach ($comments as $comment) {
        echo "<p>Tên người bình luận: " . $comment->get_tenguoibinhluan() . "</p>";
        echo "<p>Ngày bình luận: " . $comment->get_ngaybinhluan() . "</p>";
        echo "<p>Nội dung bình luận: " . $comment->get_noidungbinhluan() . "</p>";
    }
} else {
    echo 'Chưa có bình luận nào cho sản phẩm này.';
}
?>

<script>
    function giamsoluong() {
        const input = document.getElementById('soluong');
        let value = parseInt(input.value);

        if (value > 0) {
            value--;
            input.value = value;
        }
    }

    function tangsoluong() {
        const input = document.getElementById('soluong');
        let value = parseInt(input.value);

        if (value > 0 && value < 100) {
            value++;
            input.value = value;
        }
    }
</script>