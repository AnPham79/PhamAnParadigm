<br>

<a href="?action=index">
    Quay về trang chủ
</a>

<br>

<?php
$search = '';
?>
<?php
$tongsoluong = 0;

if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $soluong) {
        $tongsoluong += $soluong['soluong'];
    }
}
?>

<a href="?action=ViewCart"><?php echo 'Tổng số lượng' . " " . $tongsoluong; ?></a>



<br>
<ul>
    <li><a href="?action=selectCategory&FK_ma_danhmuc=1">Mô hình One Piece Chibi</a></li>
    <li><a href="?action=selectCategory&FK_ma_danhmuc=2">Mô hình One Piece lớn</a></li>
</ul>
<br>


<br>

<table border="1" width="100%">
    <form id="searchForm" action="./index.php?action=productPage" method="GET">
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
            <td>Danh mục</td>
            <td>Thương hiệu</td>
            <td>Thêm vào giỏ hàng</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($arr as $each) { ?>
            <tr>
                <td>
                    <?php echo $each->get_masp() ?>
                </td>
                <td>
                    <a href="./index.php?action=ShowPrd&ma_sp=<?php echo $each->get_masp() ?>">
                        <?php echo $each->get_tensp() ?>
                    </a>
                </td>
                <td>
                    <a href="./index.php?action=ShowPrd&ma_sp=<?php echo $each->get_masp() ?>">
                        <img src="<?php echo $each->get_anhsp() ?>" alt="" style="height:200px;">
                    </a>
                </td>
                <td>
                    <?php echo $each->get_giasp() ?>
                </td>
                <td>
                    <?php echo $each->get_motasp() ?>
                </td>
                <td><?php echo $each->get_FK_ten_danhmuc() ?></td>
                <td><?php echo $each->get_FK_ten_thuonghieu() ?></td>
                <td>
                    <a href="?action=AddToCart&ma_sp=<?php echo $each->get_masp() ?>"">Thêm vào giỏ</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
    <?php 
        $page = $_GET['page'] ?? 1;
        $num_page = 3;
        $obj = new Product();
        echo $obj->Pagination($page, $num_page);
    ?>
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