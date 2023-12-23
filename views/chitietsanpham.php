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