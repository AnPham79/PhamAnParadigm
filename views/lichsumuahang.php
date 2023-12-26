<h1>Lịch sử mua hàng</h1>

<?php
$history = new Account();
$purchaseHistory = $history->getPurchaseHistory($_SESSION['hovaten']);

foreach ($purchaseHistory as $bill) {
    echo "<p>Mã hóa đơn: " . $bill->get_ma_hoadon() . "</p>";
    echo "<p>Tên người dùng: " . $bill->get_tennguoidung() . "</p>";
    echo "<p>Địa chỉ người dùng: " . $bill->get_diachinguoidung() . "</p>";
    echo "<p>Số điện thoại người dùng: " . $bill->get_sdtnguoidung() . "</p>";
    echo "<p>Email người dùng: " . $bill->get_emailnguoidung() . "</p>";
    echo "<p>Tên sản phẩm: " . $bill->get_tensanpham() . "</p>";
    echo "<p>Số lượng: " . $bill->get_soluong() . "</p>";
    echo "<p>Tổng tiền: " . $bill->get_tongtien() . "</p>";
    echo "<hr>";
}
?>