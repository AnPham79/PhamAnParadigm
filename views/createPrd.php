<h1>Đây là form thêm sản phẩm</h1>

<form action="./index.php?action=StorePrd" 
    method="POST" 
    enctype="multipart/form-data">
    
    tên sản phẩm
    <br>
    <input type="text" name="ten_sp">
    <br>
    ảnh
    <br>
    <input type="file" name="anh_sp">
    <br>
    giá
    <br>
    <input type="text" name="gia_sp">
    <br>
    mô tả
    <br>
    <input type="text" name="mota_sp">
    <br>
    <button type="submit">Thêm sản phẩm</button>
</form>