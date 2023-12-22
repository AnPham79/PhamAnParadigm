<h1>Đây là form sửa sản phẩm</h1>

<form action="./index.php?action=UpdatePrd" 
    method="POST" 
    enctype="multipart/form-data">
    <input type="hidden" name="ma_sp" 
    value="<?php echo $each->get_masp() ?>">
    tên sản phẩm
    <br>
    <input type="text" name="ten_sp" 
    value="<?php echo $each->get_tensp() ?>">
    <br>
    ảnh
    <br>
    <input type="file" name="anh_sp" 
    value="<?php echo $each->get_anhsp() ?>">
    <br>
    hoặc giữ lại ảnh củ
    <br>
    <img src="<?php echo $each->get_anhsp() ?>" alt="" style="height:200px;">
    <br>
    giá
    <br>
    <input type="text" name="gia_sp" 
    value="<?php echo $each->get_giasp() ?>">
    <br>
    mô tả
    <br>
    <input type="text" name="mota_sp" 
    value="<?php echo $each->get_motasp() ?>">
    <br>
    <button type="submit">Sửa sản phẩm</button>
</form>