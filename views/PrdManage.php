<ul>
    <li><a href="./admin/index.php">
        Quay về trang admin
    </a></li>

    <li><a href="./index.php?action=CreatePrd">
        Thêm sản phẩm tại đây
    </a></li>
</ul>

<table border="1" width="100%">
    <thead>
        <tr>
            <td>Mã</td>
            <td>Tên</td>
            <td>Ảnh</td>
            <td>Giá</td>
            <td>Mô tả</td>
            <td>Sửa</td>
            <td>Xóa</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach($arr as $each) { ?>
            <tr>
                <td>
                    <?php echo $each->get_masp()?>
                </td>
                <td>
                    <?php echo $each->get_tensp()?>
                </td>
                <td>
                    <img src="<?php echo $each->get_anhsp()?>" alt="" style="height:200px;">
                </td>
                <td>
                    <?php echo $each->get_giasp()?>
                </td>
                <td>
                    <?php echo $each->get_motasp()?>
                </td>
                <td>
                    <a href="./index.php?action=EditPrd&ma_sp=<?php echo $each->get_masp()?>">
                        Sửa
                    </a>
                </td>
                <td>
                    <a href="./index.php?action=DeletePrd&ma_sp=<?php echo $each->get_masp()?>">
                        Xóa
                    </a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>