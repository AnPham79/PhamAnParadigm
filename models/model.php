<?php

session_start();

require './config/config.php';
require './models/objectTK.php';
require './models/objectPrd.php';

class Product
{
    public function getAllPrd()
    {
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }

        if (isset($_GET['search'])) {
            $search = $_GET['search'];
        } else {
            $search = '';
        }

        $sql_check = "SELECT COUNT(*) FROM sanpham";

        $result_check = (new Database())->conn_db($sql_check);

        $prd_check = mysqli_fetch_array($result_check);

        $getResult = $prd_check['COUNT(*)'];

        $limit = 2;

        $num_page = ceil($getResult / $limit);

        $offset = $limit * ($page - 1);

        $sql = "SELECT * FROM sanpham 
        WHERE ten_sp like '%$search%'
         LIMIT $limit
         OFFSET $offset";

        $result = (new Database())->conn_db($sql);

        $arr = [];

        foreach ($result as $row) {
            $object = new PrdObject();
            $object->set_masp($row['ma_sp']);
            $object->set_tensp($row['ten_sp']);
            $object->set_anhsp($row['anh_sp']);
            $object->set_giasp($row['gia_sp']);
            $object->set_motasp($row['mota_sp']);

            $arr[] = $object;
        }

        $output = '';

        if ($page > 1) {
            $output .= "<a href='?action=productPage&page=" . ($page - 1) . "'>Prev</a>";
        }

        $output .= "<ul class='pagination'>";
        for ($i = 1; $i <= $num_page; $i++) {
            $cls = ($i == $page) ? "class='active'" : '';
            $output .= "<li><a href='?action=productPage&page=$i' $cls>$i</a></li>";
        }
        $output .= "</ul>";

        if ($num_page > $page) {
            $output .= "<a href='?action=productPage&page=" . ($page + 1) . "'>Next</a>";
        }

        echo $output;

        return $arr;
    }

    public function getAllPrdinAdmin()
    {
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }

        if (isset($_GET['search'])) {
            $search = $_GET['search'];
        } else {
            $search = '';
        }


        $sql_check = "SELECT COUNT(*) FROM sanpham";

        $result_check = (new Database())->conn_db($sql_check);

        $prd_check = mysqli_fetch_array($result_check);

        $getResult = $prd_check['COUNT(*)'];

        $limit = 2;

        $num_page = ceil($getResult / $limit);

        $offset = $limit * ($page - 1);

        $sql = "SELECT * FROM sanpham 
        WHERE ten_sp like '%$search%'
         LIMIT $limit
         OFFSET $offset";

        $result = (new Database())->conn_db($sql);

        $arr = [];

        foreach ($result as $row) {
            $object = new PrdObject();
            $object->set_masp($row['ma_sp']);
            $object->set_tensp($row['ten_sp']);
            $object->set_anhsp($row['anh_sp']);
            $object->set_giasp($row['gia_sp']);
            $object->set_motasp($row['mota_sp']);

            $arr[] = $object;
        }

        $output = '';

        if ($page > 1) {
            $output .= "<a href='?action=pagePrdManage&page=" . ($page - 1) . "'>Prev</a>";
        }

        $output .= "<ul class='pagination'>";
        for ($i = 1; $i <= $num_page; $i++) {
            $cls = ($i == $page) ? "class='active'" : '';
            $output .= "<li><a href='?action=pagePrdManage&page=$i' $cls>$i</a></li>";
        }
        $output .= "</ul>";

        if ($num_page > $page) {
            $output .= "<a href='?action=pagePrdManage&page=" . ($page + 1) . "'>Next</a>";
        }

        echo $output;

        return $arr;
    }

    public function ShowPrd($ma_sp)
    {
        $sql = "SELECT * FROM sanpham WHERE ma_sp = '$ma_sp'";
        $result = (new Database())->conn_db($sql);
        $row = mysqli_fetch_array($result);

        $object = new PrdObject();
        $object->set_masp($row['ma_sp']);
        $object->set_tensp($row['ten_sp']);
        $object->set_anhsp($row['anh_sp']);
        $object->set_giasp($row['gia_sp']);
        $object->set_motasp($row['mota_sp']);

        return $object;
    }


    // ------------------------------ CRUD cho admin ------------------------------

    public function StorePrd($ten_sp, $anh_sp, $gia_sp, $mota_sp)
    {
        $target_dir = "imagePrd/";
        $target_file = $target_dir . basename($anh_sp["name"]);

        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }

        if (move_uploaded_file($anh_sp["tmp_name"], $target_file)) {
            $sql = "INSERT INTO sanpham (ten_sp, anh_sp, gia_sp, mota_sp) 
            VALUES ('$ten_sp', '$target_file', '$gia_sp', '$mota_sp')";

            $result = (new Database())->conn_db($sql);

            if ($result) {
                header("Location: ./index.php?action=pagePrdManage");
            } else {
                echo "Có lỗi khi thêm sản phẩm vào cơ sở dữ liệu.";
            }
        } else {
            echo "Có lỗi khi tải lên tệp tin.";
        }
    }

    public function FindPrd($ma_sp)
    {
        $sql = "SELECT * FROM sanpham 
        WHERE ma_sp = $ma_sp";

        $result = (new Database())->conn_db($sql);

        $row = mysqli_fetch_array($result);

        $object = new PrdObject();
        $object->set_masp($row['ma_sp']);
        $object->set_tensp($row['ten_sp']);
        $object->set_anhsp($row['anh_sp']);
        $object->set_giasp($row['gia_sp']);
        $object->set_motasp($row['mota_sp']);

        mysqli_fetch_array($result);

        return $object;
    }

    public function UpdatePrd($ma_sp, $ten_sp, $anh_sp, $gia_sp, $mota_sp)
    {
        $conn = new Database();

        if (!empty($anh_sp['name'])) {
            $target_dir = "imagePrd/";
            $target_file = $target_dir . basename($anh_sp["name"]);

            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0755, true);
            }

            if (move_uploaded_file($anh_sp["tmp_name"], $target_file)) {
                $sql = "UPDATE sanpham 
                    SET 
                    ten_sp = '$ten_sp',
                    anh_sp = '$target_file',
                    gia_sp = '$gia_sp',
                    mota_sp = '$mota_sp'
                    WHERE ma_sp = '$ma_sp'";

                $result = $conn->conn_db($sql);

                if ($result) {
                    header("Location: ./index.php?action=pagePrdManage");
                } else {
                    echo "Có lỗi khi cập nhật sản phẩm.";
                }
            } else {
                echo "Có lỗi khi tải lên tệp tin.";
            }
        } else {
            $sql = "UPDATE sanpham 
                SET 
                ten_sp = '$ten_sp',
                gia_sp = '$gia_sp',
                mota_sp = '$mota_sp'
                WHERE ma_sp = '$ma_sp'";

            $result = $conn->conn_db($sql);

            if ($result) {
                header("Location: ./index.php?action=pagePrdManage");
            } else {
                echo "Có lỗi khi cập nhật sản phẩm.";
            }
        }
    }

    public function DeletePrd($ma_sp)
    {
        $sql = "DELETE FROM sanpham WHERE ma_sp = '$ma_sp'";

        $resul = (new Database())->conn_db($sql);

        header("Location: ./index.php?action=pagePrdManage");
    }
}

class Account
{
    public function emailAxist($email)
    {
        $sql_check_email = "SELECT COUNT(*) FROM taikhoan WHERE email = '$email'";
        $result = (new Database())->conn_db($sql_check_email);
        if ($result) {
            $row = mysqli_fetch_array($result);
            if ($row) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function processRgt($hovaten, $gioitinh, $ngaysinh, $email, $matkhau)
    {
        $account = new Account;
        if ($account->emailAxist($email)) {
            header("Location: ./index.php?action=register&error=Email của bạn vừa nhập đã được dùng");
            exit();
        } else {
            $object = new AccountObject();
            $object->set_hoten($hovaten);
            $object->set_gioitinh($gioitinh);
            $object->set_ngaysinh($ngaysinh);
            $object->set_email($email);
            $object->set_matkhau($matkhau);

            $sql = "INSERT INTO taikhoan 
            (hovaten, gioitinh, ngaysinh, email, matkhau) 
            VALUES 
            ('$hovaten', '$gioitinh', '$ngaysinh', '$email', '$matkhau')";

            if (isset($_SESSION['hovaten'])) {
                $_SESSION['hovaten'] = $hovaten;
                return $_SESSION['hovaten'];
            }
            $_SESSION['hovaten'] = $hovaten;

            $resul = (new Database())->conn_db($sql);

            header("Location: ./index.php");
        }
    }

    public function getUserInfo($email, $matkhau)
    {
        $sql = "SELECT hovaten, quyen FROM taikhoan WHERE email = '$email' AND matkhau = '$matkhau'";
        $result = (new Database())->conn_db($sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            if ($row['quyen'] === '1') {
                header("Location: ./admin/index.php");
                exit();
            }

            return $row;
        } else {
            return false;
        }
    }


    public function ProcessLogin()
    {

        $email = $_POST['email'];
        $matkhau = $_POST['matkhau'];

        $account = new Account();
        $userInfo = $account->getUserInfo($email, $matkhau);

        if ($userInfo) {

            $_SESSION['email'] = $email;
            $_SESSION['hovaten'] = $userInfo['hovaten'];
            $_SESSION['quyen'] = $userInfo['quyen'];

            if ($userInfo['quyen'] === null) {
                header("Location: ./index.php");
                exit();
            } elseif ($userInfo['quyen'] === 1) {
                header("Location: ./admin/index.php");
                exit();
            }
        } else {
            header("Location: ./index.php?action=login&error=Email hoặc mật khẩu không chính xác");
            exit();
        }
    }

    public function Logout()
    {
        if (isset($_SESSION['email'])) {
            unset($_SESSION['email']);
        } else if (isset($_SESSION['hovaten'])) {
            unset($_SESSION['hovaten']);
        } else if (isset($_SESSION['quyen'])) {
            unset($_SESSION['quyen']);
        }

        header('Location: ./index.php');
    }
}
