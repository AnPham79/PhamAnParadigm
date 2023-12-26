<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <h1>Đây là trang chủ</h1>

    <?php

    if (isset($_SESSION['hovaten'])) {
        $hovaten = $_SESSION['hovaten'];
        echo '</br>';
        echo '<a href="?action=viewHistory">xem lịch sử mua hàng</a>';
        echo '</br>';
        echo "<div class='name-user'>$hovaten</div>";
        echo '</br>';
        echo "<a href='?action=Logout'>Đăng xuất</a>";
    } else {
        echo '<ul>
            <li><a href="?action=register">Đăng kí</a></li>
            <li><a href="?action=login">Đăng nhập</a></li>
        </ul>';
    }
    ?>

    <a href="?action=productPage">Trang sản phẩm</a>
</body>

</html>