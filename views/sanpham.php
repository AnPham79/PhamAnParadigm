<a href="?action=index">
    Quay về trang chủ
</a>

<table border="1" width="100%">
    <thead>
        <tr>
            <td>Mã</td>
            <td>Tên</td>
            <td>Ảnh</td>
            <td>Giá</td>
            <td>Mô tả</td>
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
            </tr>
        <?php } ?>
    </tbody>
</table>