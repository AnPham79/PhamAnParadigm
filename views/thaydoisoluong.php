<?php

session_start();
$ma_sp = $_GET['ma_sp'];
$type = $_GET['type'];

if ($type === 'decre') {
    if ($_SESSION['cart'][$ma_sp]['soluong'] > 1) {
        $_SESSION['cart'][$ma_sp]['soluong']--;
    } else {
        unset($_SESSION['cart'][$ma_sp]);
    }
} else {
    $_SESSION['cart'][$ma_sp]['soluong']++;
}

header('location:../index.php?action=ViewCart');
