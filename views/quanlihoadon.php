<h1>Đây là trang quản lí hóa đơn</h1>

<ul>
    <li><a href="./admin/index.php">
            Quay về trang admin
        </a></li>
</ul>

<table border="1" width="100%">
    <thead>
        <tr>
            <td>Mã</td>
            <td>Tên người dùng</td>
            <td>Địa chỉ</td>
            <td>SDT người dùng</td>
            <td>Email</td>
            <td>tên sản phẩm</td>
            <td>Số lượng</td>
            <td>Tổng tiền</td>
            <td>Trạng thái</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($arr as $each) { ?>
            <tr>
                <td>
                    <?php echo $each->get_ma_hoadon() ?>
                </td>
                <td>
                    <?php echo $each->get_tennguoidung() ?>
                </td>
                <td>
                    <?php echo $each->get_diachinguoidung() ?>
                </td>
                <td>
                    <?php echo $each->get_sdtnguoidung() ?>
                </td>
                <td>
                    <?php echo $each->get_emailnguoidung() ?>
                </td>
                <td>
                    <?php echo $each->get_tensanpham() ?>
                </td>
                <td><?php echo $each->get_soluong() ?></td>
                <td><?php echo $each->get_tongtien() ?></td>
                <td>
                    <?php if ($each->get_trangthai() == 1) { ?>
                        <form method="POST" action="?action=ChangeStatus">
                            <input type="hidden" name="ma_hoadon" value="<?php echo $each->get_ma_hoadon() ?>">
                            <button type="submit" name="trangthai" value="2">
                                Xác nhận đơn hàng
                            </button>
                        </form>
                    <?php } else { ?>
                        <p style="color:green;">đã xác nhận</p>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>