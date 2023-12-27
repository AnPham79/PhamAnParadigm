<?php

session_start();

require './config/config.php';
require './models/objectTK.php';
require './models/objectPrd.php';
require './models/objectCmt.php';
require './models/objectBill.php';

class Product
{
    // ------------------------------- hàm lấy hết sản phẩm -------------------------------
    // ------------------------------- lấy hết sản phẩm bên rầu show ở trang sản phẩm -----
    // ------------------------------- sử lí tìm kiếm phân trnag hoặc tìm kiếm phân trang theo danh mục
    public function getAllPrd(): array
    {
        if (isset($_GET['FK_ma_danhmuc'])) {
            $FK_ma_danhmuc = $_GET['FK_ma_danhmuc'];

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

            $limit = 8;
            $sql_check = "SELECT COUNT(*) 
            FROM 
            sanpham 
            WHERE FK_ma_danhmuc = '$FK_ma_danhmuc' 
            AND ten_sp 
            LIKE '%$search%'";

            $result_check = (new Database())->conn_db($sql_check);
            $prd_check = mysqli_fetch_array($result_check);
            $getResult = $prd_check['COUNT(*)'];
            $num_page = ceil($getResult / $limit);
            $offset = $limit * ($page - 1);

            $sql = "SELECT sanpham.*, danhmuc.ten_danhmuc AS FK_ten_danhmuc, thuonghieu.ten_thuonghieu AS FK_ten_thuonghieu
                    FROM sanpham 
                    JOIN danhmuc ON sanpham.FK_ma_danhmuc = danhmuc.ma_danhmuc 
                    JOIN thuonghieu ON sanpham.FK_ma_thuonghieu = thuonghieu.ma_thuonghieu 
                    WHERE sanpham.FK_ma_danhmuc = '$FK_ma_danhmuc' AND sanpham.ten_sp LIKE '%$search%'
                    LIMIT $limit OFFSET $offset";

            $result = (new Database())->conn_db($sql);
            $arr = [];

            foreach ($result as $row) {
                $object = new PrdObject();
                $object->set_masp($row['ma_sp']);
                $object->set_tensp($row['ten_sp']);
                $object->set_anhsp($row['anh_sp']);
                $object->set_giasp($row['gia_sp']);
                $object->set_motasp($row['mota_sp']);

                $object->FK_ten_danhmuc = $row['FK_ten_danhmuc'];
                $object->FK_ten_thuonghieu = $row['FK_ten_thuonghieu'];

                $arr[] = $object;
            }

            return $arr;
        } else {
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

            $limit = 8;

            $num_page = ceil($getResult / $limit);

            $offset = $limit * ($page - 1);

            $sql = "SELECT sanpham.*, 
                    danhmuc.ten_danhmuc AS FK_ten_danhmuc, 
                    thuonghieu.ten_thuonghieu AS FK_ten_thuonghieu
                    FROM sanpham 
                    JOIN danhmuc ON sanpham.FK_ma_danhmuc = danhmuc.ma_danhmuc 
                    JOIN thuonghieu ON sanpham.FK_ma_thuonghieu = thuonghieu.ma_thuonghieu 
                    WHERE sanpham.ten_sp LIKE '%$search%'
                    LIMIT $limit OFFSET $offset";


            $result = (new Database())->conn_db($sql);

            $arr = [];

            foreach ($result as $row) {
                $object = new PrdObject();
                $object->set_masp($row['ma_sp']);
                $object->set_tensp($row['ten_sp']);
                $object->set_anhsp($row['anh_sp']);
                $object->set_giasp($row['gia_sp']);
                $object->set_motasp($row['mota_sp']);

                $object->FK_ten_danhmuc = $row['FK_ten_danhmuc'];
                $object->FK_ten_thuonghieu = $row['FK_ten_thuonghieu'];

                $arr[] = $object;
            }

            return $arr;
        }
    }

    // ----------------------------------- phân trang  ---------------------------

    function Pagination($page, $num_page)
    {
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

        return $output;
    }

    function PaginationAdmin($page, $num_page)
    {
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

        return $output;
    }

    // -------------------------------- thêm vào giỏ hàng ----------------------------------------
    public function AddToCart($ma_sp): void
    {
        if (empty($_SESSION['cart'][$ma_sp])) {
            $sql = "SELECT * FROM sanpham
                WHERE ma_sp = '$ma_sp'";

            $result = (new Database())->conn_db($sql);

            $each = mysqli_fetch_array($result);

            $_SESSION['cart'][$ma_sp]['ten_sp'] = $each['ten_sp'];
            $_SESSION['cart'][$ma_sp]['anh_sp'] = $each['anh_sp'];
            $_SESSION['cart'][$ma_sp]['gia_sp'] = $each['gia_sp'];
            $_SESSION['cart'][$ma_sp]['mota_sp'] = $each['mota_sp'];
            $_SESSION['cart'][$ma_sp]['soluong'] = 1;
        } else {
            $_SESSION['cart'][$ma_sp]['soluong']++;
        }

        header('location:?action=productPage');
    }

    // ------------------------------ lấy hết sản phẩm in ra trnag admin --------------------------------


    public function getAllPrdinAdmin(): array
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

        $limit = 8;

        $num_page = ceil($getResult / $limit);

        $offset = $limit * ($page - 1);

        $sql = "SELECT sanpham.*, 
                danhmuc.ten_danhmuc AS FK_ten_danhmuc, 
                thuonghieu.ten_thuonghieu AS FK_ten_thuonghieu
                FROM sanpham 
                JOIN danhmuc ON sanpham.FK_ma_danhmuc = danhmuc.ma_danhmuc 
                JOIN thuonghieu ON sanpham.FK_ma_thuonghieu = thuonghieu.ma_thuonghieu 
                WHERE sanpham.ten_sp LIKE '%$search%'
                LIMIT $limit OFFSET $offset";


        $result = (new Database())->conn_db($sql);

        $arr = [];

        foreach ($result as $row) {
            $object = new PrdObject();
            $object->set_masp($row['ma_sp']);
            $object->set_tensp($row['ten_sp']);
            $object->set_anhsp($row['anh_sp']);
            $object->set_giasp($row['gia_sp']);
            $object->set_motasp($row['mota_sp']);

            $object->FK_ten_danhmuc = $row['FK_ten_danhmuc'];
            $object->FK_ten_thuonghieu = $row['FK_ten_thuonghieu'];

            $arr[] = $object;
        }

        return $arr;
    }

    // --------------------------------- nhấn vào xem chi tiết sản phẩm -------------------------------

    public function ShowPrd($ma_sp): PrdObject
    {
        $sql = "SELECT sanpham.*, 
                danhmuc.ten_danhmuc AS FK_ten_danhmuc, 
                thuonghieu.ten_thuonghieu AS FK_ten_thuonghieu
                FROM sanpham 
                JOIN danhmuc ON sanpham.FK_ma_danhmuc = danhmuc.ma_danhmuc 
                JOIN thuonghieu ON sanpham.FK_ma_thuonghieu = thuonghieu.ma_thuonghieu 
                WHERE ma_sp = '" . $ma_sp . "'";
        $result = (new Database())->conn_db($sql);
        $row = mysqli_fetch_array($result);

        $object = new PrdObject();
        $object->set_masp($row['ma_sp']);
        $object->set_tensp($row['ten_sp']);
        $object->set_anhsp($row['anh_sp']);
        $object->set_giasp($row['gia_sp']);
        $object->set_motasp($row['mota_sp']);

        $object->FK_ten_danhmuc = $row['FK_ten_danhmuc'];
        $object->FK_ten_thuonghieu = $row['FK_ten_thuonghieu'];

        return $object;
    }

    // ------------------------------ CRUD cho admin ------------------------------

    public function StorePrd($ten_sp, $anh_sp, $gia_sp, $mota_sp, $FK_ma_danhmuc, $FK_ma_thuonghieu): void
    {
        $target_dir = "imagePrd/";
        $target_file = $target_dir . basename($anh_sp["name"]);

        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }

        if (move_uploaded_file($anh_sp["tmp_name"], $target_file)) {
            $sql = "INSERT INTO sanpham (ten_sp, anh_sp, gia_sp, mota_sp, FK_ma_danhmuc, FK_ma_thuonghieu) 
            VALUES ('$ten_sp', '$target_file', '$gia_sp', '$mota_sp', '$FK_ma_danhmuc', '$FK_ma_thuonghieu')";

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

    // ------------------------------------------ tìm kiếm sản phẩm theo mã để sửa ----------------------------

    public function FindPrd($ma_sp): PrdObject
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

    // ---------------------------------- sửa sản phẩm --------------------------

    public function UpdatePrd($ma_sp, $ten_sp, $anh_sp, $gia_sp, $mota_sp): void
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

    // ---------------------------------- xóa sản phẩm --------------------------------

    public function DeletePrd($ma_sp): void
    {
        $sql = "DELETE FROM sanpham WHERE ma_sp = '$ma_sp'";

        $resul = (new Database())->conn_db($sql);

        header("Location: ./index.php?action=pagePrdManage");
    }

    // --------------------------------------------- Thanh toán --------------------------------------
    public function CheckOut()
    {
        if (!isset($_SESSION['hovaten']) && !isset($_SESSION['email'])) {
            header('location:?action=Login');
            exit();
        }

        $tennguoidung = $_SESSION['hovaten'] ?? '';
        $diachinguoidung = $_SESSION['diachi'] ?? '';
        $sdtnguoidung = $_SESSION['sodienthoai'] ?? '';
        $emailnguoidung = $_SESSION['email'] ?? '';

        $products = $_SESSION['cart'] ?? [];

        $tongSoLuong = 0;
        $tongTien = 0;

        if (!empty($products)) {
            foreach ($products as $ma_sp => $product) {
                $ten_sp = $product['ten_sp'] ?? '';
                $gia_sp = $product['gia_sp'] ?? 0;
                $soLuong = $product['soluong'] ?? 0;

                $tongSoLuong += $soLuong;

                $thanhTien = @($gia_sp * $soLuong);
                $tongTien += $thanhTien;

                echo "Tên sản phẩm: $ten_sp | Số lượng: $soLuong | Thành tiền: $thanhTien VND<br>";
            }
        }

        echo "Tổng số lượng: $tongSoLuong<br>";
        echo "Tổng tiền: $tongTien VND<br>";

        require './views/thanhtoan.php';
    }

    // ----------------------------------- sử lí thanh toán + in hóa đơn --------------------------------------


    public function Payment($tennguoidung, $diachinguoidung, $sdtnguoidung, $emailnguoidung, $tongtien)
    {
        $products = $_SESSION['cart'] ?? [];

        $sanpham_name = '';
        $sanpham_quantity = '';
        foreach ($products as $ma_sp => $product) {
            $sanpham_name .= $product['ten_sp'] . " , ";
            $sanpham_quantity .=  $product['soluong'] . " , ";
        }

        $sql = "INSERT INTO 
        hoadon(tennguoidung, diachinguoidung, sdtnguoidung, emailnguoidung, tensanpham, soluong , tongtien) 
        VALUES
        ('$tennguoidung', '$diachinguoidung', '$sdtnguoidung', '$emailnguoidung', '$sanpham_name','$sanpham_quantity', '$tongtien')";

        $result = (new Database)->conn_db($sql);

        if ($result) {
            unset($_SESSION['cart']);
            header('location:./index.php');
        }
    }

    // ------------------------------ sử lí comment + in comment ----------------

    public function ProcessComment($tennguoibinhluan, $ngaybinhluan, $noidungbinhluan, $FK_ma_sp)
    {
        $sql = "INSERT INTO 
        binhluan(tennguoibinhluan, ngaybinhluan, noidungbinhluan, FK_ma_sp) 
        VALUES
        ('$tennguoibinhluan', '$ngaybinhluan', '$noidungbinhluan', '$FK_ma_sp')";

        $result = (new Database)->conn_db($sql);

        header('location:?action=productPage');
    }

    // ---------------------------------- lấy hết bình luận tại FK_ma_sp ----------------------------------------------------------------

    public function GetCommentByFKid($FK_ma_sp)
    {
        $sql = "SELECT * FROM binhluan WHERE FK_ma_sp = '$FK_ma_sp'";
        $result = (new Database)->conn_db($sql);
        $arr = [];

        foreach ($result as $row) {
            $object = new objectCmt(
                $row['ma_binhluan'],
                $row['tennguoibinhluan'],
                $row['ngaybinhluan'],
                $row['noidungbinhluan'],
                $row['FK_ma_sp']
            );
            $arr[] = $object;
        }

        return $arr;
    }
}

// ---------------------------------------- sửa lí bên phần đăng kí đăng nhập -------------
// ---------------------------------------- hàm kiểm tra tồn tại email -------------------
class Account
{
    public function emailAxist($email): bool
    {
        $sql_check_email = "SELECT COUNT(*) FROM taikhoan WHERE email = '$email'";
        $result = (new Database())->conn_db($sql_check_email);

        if ($result) {
            $row = mysqli_fetch_array($result);
            $count = $row[0];

            if ($count > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    // ------------------------------- sử lí đăng kí -----------------------------------------

    public function processRgt($hovaten, $gioitinh, $ngaysinh, $sodienthoai, $diachi, $email, $matkhau)
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
            $object->set_sodienthoai($sodienthoai);
            $object->set_diachi($diachi);
            $object->set_email($email);
            $object->set_matkhau($matkhau);

            $sql = "INSERT INTO taikhoan 
            (hovaten, gioitinh, ngaysinh, sodienthoai, diachi, email, matkhau) 
            VALUES 
            ('$hovaten', '$gioitinh', '$ngaysinh', '$sodienthoai', '$diachi', '$email', '$matkhau')";

            if (isset($_SESSION['hovaten']) && isset($_SESSION['diachi']) && isset($_SESSION['sodienthoai']) && isset($_SESSION['email'])) {
                $_SESSION['hovaten'] = $hovaten;
                $_SESSION['diachi'] = $diachi;
                $_SESSION['email'] = $email;
                $_SESSION['sodienthoai'] = $sodienthoai;
                return $_SESSION['hovaten'] && $_SESSION['diachi'] && $_SESSION['sodienthoai'];
            }

            $_SESSION['hovaten'] = $hovaten;
            $_SESSION['diachi'] = $diachi;
            $_SESSION['sodienthoai'] = $sodienthoai;
            $_SESSION['email'] = $email;

            $resul = (new Database())->conn_db($sql);

            header("Location: ./index.php");
        }
    }

    // -------------------------------- sử lí lấy thêm thông tim người dùng từ đăng kí đăng nhập
    // -------------------------------- cụ thể là quyền và họ tên -----------------------------

    public function getUserInfo($email, $matkhau): array
    {
        $sql = "SELECT hovaten, quyen, diachi, sodienthoai FROM taikhoan WHERE email = '$email' AND matkhau = '$matkhau'";
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


    // ------------------------------------ sử lí đăng nhập ----------------------------------------

    public function ProcessLogin(): void
    {

        $email = $_POST['email'];
        $matkhau = $_POST['matkhau'];

        $account = new Account();
        $userInfo = $account->getUserInfo($email, $matkhau);

        if ($userInfo) {

            $_SESSION['ma_tk'] = $userInfo['ma_tk'];
            $_SESSION['email'] = $email;
            $_SESSION['hovaten'] = $userInfo['hovaten'];
            $_SESSION['sodienthoai'] = $userInfo['sodienthoai'];
            $_SESSION['diachi'] = $userInfo['diachi'];
            $_SESSION['quyen'] = $userInfo['quyen'];

            $_SESSION['logged_in'] = true;

            if ($userInfo['quyen'] === null) {
                header("Location: ?action=ViewCart");
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

    // ---------------------------------------- sử lí đăng xuất ------------------------------------

    public function Logout(): void
    {
        if (isset($_SESSION['email'])) {
            unset($_SESSION['email']);
        } else if (isset($_SESSION['hovaten'])) {
            unset($_SESSION['hovaten']);
        } else if (isset($_SESSION['quyen'])) {
            unset($_SESSION['quyen']);
        } else if (isset($_SESSION['sodienthoai'])) {
            unset($_SESSION['sodienthoai']);
        } else if (isset($_SESSION['diachi'])) {
            unset($_SESSION['diachi']);
        } else if (isset($_SESSION['ma_tk'])) {
            unset($_SESSION['ma_tk']);
        }

        header('Location: ./index.php');
    }

    // ---------------------------------- lịch sử mua hàng ----------------------------------------
    public function getPurchaseHistory($tennguoidung)
    {
        $sql = "SELECT * FROM hoadon WHERE tennguoidung = '$tennguoidung'";
        $result = (new Database())->conn_db($sql);

        $arr = [];

        foreach ($result as $row) {
            $object = new objectBill(
                $row['ma_hoadon'],
                $row['tennguoidung'],
                $row['diachinguoidung'],
                $row['sdtnguoidung'],
                $row['emailnguoidung'],
                $row['tensanpham'],
                $row['soluong'],
                $row['tongtien'],
                $row['trangthai']
            );
            $arr[] = $object;
        }

        return $arr;
    }

    // ------------------------ lấy tất cả hóa đơn ---------------------------------

    public function getAllOrderByAdmin()
    {
        $sql = "SELECT * FROM hoadon";

        $result = (new Database())->conn_db($sql);

        $arr = [];

        foreach ($result as $row) {
            $object = new objectBill(
                $row['ma_hoadon'],
                $row['tennguoidung'],
                $row['diachinguoidung'],
                $row['sdtnguoidung'],
                $row['emailnguoidung'],
                $row['tensanpham'],
                $row['soluong'],
                $row['tongtien'],
                $row['trangthai']
            );
            $arr[] = $object;
        }
        return $arr;
    }

    // ----------------------------- xác nhận đơn hàng -----------------------------

    public function ChangeStatus($ma_hoadon, $trangthai)
    {
        $sql = "UPDATE hoadon 
            SET trangthai = $trangthai
            WHERE ma_hoadon = '$ma_hoadon'";

        $result = (new Database())->conn_db($sql);

        // var_dump($result);

        header('location: ?action=getAllOrderByAdmin');
    }

    // ----------------------------- hủy đơn hàng ----------------
    public function CancelOrder($ma_hoadon)
    {
        $sql = "DELETE FROM hoadon WHERE ma_hoadon = '$ma_hoadon'";

        $result = (new Database())->conn_db($sql);

        var_dump($result);
    }
}
