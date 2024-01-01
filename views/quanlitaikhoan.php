<h1>Đây là trang quản lý tài khoản</h1>

<ul>
    <li><a href="./admin/index.php">
            Quay về trang admin
        </a></li>
</ul>


<table border="1" width="100%">
    <tr>
        <td>mã</td>
        <td>họ và tên</td>
        <td>giới tính</td>
        <td>ngày sinh</td>
        <td>email</td>
        <td>số điện thoại</td>
        <td>địa chỉ</td>
        <td>mật khẩu</td>
    </tr>
    <?php foreach ($arr as $each) { ?>
        <tr>
            <td><?php echo $each->get_matk() ?></td>
            <td><?php echo $each->get_hoten() ?></td>
            <td><?php echo $each->get_gioitinh() ?></td>
            <td><?php echo $each->get_ngaysinh() ?></td>
            <td><?php echo $each->get_email() ?></td>
            <td><?php echo $each->get_sodienthoai() ?></td>
            <td><?php echo $each->get_diachi() ?></td>
            <td><?php echo $each->get_matkhau() ?></td>
        </tr>
    <?php } ?>
</table>
