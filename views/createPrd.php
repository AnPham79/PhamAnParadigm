<h1>Đây là form thêm sản phẩm</h1>

<form action="./index.php?action=StorePrd" 
    method="POST" 
    enctype="multipart/form-data">
    
    Tên sản phẩm
    <br>
    <input type="text" name="ten_sp">
    <br>
    Ảnh
    <br>
    <input type="file" name="anh_sp">
    <br>
    Giá
    <br>
    <input type="text" name="gia_sp">
    <br>
    Mô tả
    <br>
    <input type="text" name="mota_sp">
    <br>
    Danh mục
    <br>
    <select name="FK_ma_danhmuc">
        <?php
        $sql_categories = "SELECT * FROM danhmuc";
        $result_categories = (new Database())->conn_db($sql_categories);

        while ($category = mysqli_fetch_assoc($result_categories)) {
            echo "<option value='" . $category['ma_danhmuc'] . "'>" . $category['ten_danhmuc'] . "</option>";
        }
        ?>
    </select>
    <br>
    Thương hiệu
    <br>
    <select name="FK_ma_thuonghieu">
        <?php
        $sql_brands = "SELECT * FROM thuonghieu";
        $result_brands = (new Database())->conn_db($sql_brands);

        while ($brand = mysqli_fetch_assoc($result_brands)) {
            echo "<option value='" . $brand['ma_thuonghieu'] . "'>" . $brand['ten_thuonghieu'] . "</option>";
        }
        ?>
    </select>
    <br>
    <button type="submit">Thêm sản phẩm</button>
</form>
