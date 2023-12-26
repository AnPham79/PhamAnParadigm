<a href="./index.php?action=productPage">
    Quay về trang sản phẩm
</a>
<br>
<h1>Chi tiết sản phẩm</h1>

Tên sản phẩm
<br>
<h5><?php echo $prdObject->get_tensp() ?></h5>
<br>
ảnh sản phẩm
<br>
<img src="<?php echo $prdObject->get_anhsp() ?>" alt="" style="height:200px">
<br>
giá sản phẩm
<br>
<p><?php echo $prdObject->get_giasp() ?></p>
<br>
mô tả sản phẩm
<br>
<p><?php echo $prdObject->get_motasp() ?></p>
<br>
Danh mục
<br>
<p><?php echo $prdObject->get_FK_ten_danhmuc() ?></p>
<br>
Thương hiệu
<br>
<p><?php echo $prdObject->get_FK_ten_thuonghieu() ?></p>
<br>

<?php if (isset($_SESSION['hovaten'])) : ?>
    <p>Tên người bình luận: <?php echo $_SESSION['hovaten']; ?></p>
<?php endif; ?>
<p>Thời gian hiện tại là: <?php echo date("Y-m-d H:i:s"); ?></p>

<form action="?action=Comment" method="POST">
    <input type="hidden" name="ngaybinhluan" value="<?php echo date("Y-m-d H:i:s"); ?>">
    <input type="hidden" name="FK_ma_sp" value="<?php echo $prdObject->get_masp(); ?>">

    <h5>Nội dung bình luận</h5>
    <textarea name="noidungbinhluan"></textarea>

    <button type="submit">Đăng bình luận</button>
</form>

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