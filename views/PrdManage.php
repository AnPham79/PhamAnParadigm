<ul>
    <li><a href="./admin/index.php">
            Quay về trang admin
        </a></li>

    <li><a href="./index.php?action=CreatePrd">
            Thêm sản phẩm tại đây
        </a></li>
</ul>

<?php
$search = '';
?>

<table border="1" width="100%">
    <form id="searchForm" action="./index.php?action=pagePrdManage" method="GET">
        <input type="search" name="search" value="<?php echo $search ?>">
        <button type="submit">Tìm kiếm</button>
    </form>
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
        <?php foreach ($arr as $each) { ?>
            <tr>
                <td>
                    <?php echo $each->get_masp() ?>
                </td>
                <td>
                    <?php echo $each->get_tensp() ?>
                </td>
                <td>
                    <img src="<?php echo $each->get_anhsp() ?>" alt="" style="height:200px;">
                </td>
                <td>
                    <?php echo $each->get_giasp() ?>
                </td>
                <td>
                    <?php echo $each->get_motasp() ?>
                </td>
                <td>
                    <a href="./index.php?action=EditPrd&ma_sp=<?php echo $each->get_masp() ?>">
                        Sửa
                    </a>
                </td>
                <td>
                    <a href="./index.php?action=DeletePrd&ma_sp=<?php echo $each->get_masp() ?>">
                        Xóa
                    </a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<script>
    document.getElementById('searchForm').addEventListener('submit', function(event) {
        event.preventDefault();

        let searchValue = document.querySelector('input[name="search"]').value;
        let currentURL = new URL(window.location.href);
        currentURL.searchParams.set('search', searchValue);

        window.location.href = currentURL.href;
    });
</script>