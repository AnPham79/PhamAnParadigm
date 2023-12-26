<?php
session_start();
$ma_sp = $_GET['ma_sp'];
unset($_SESSION['cart'][$ma_sp]);

header('location:../index.php?action=ViewCart');