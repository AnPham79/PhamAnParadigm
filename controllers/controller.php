<?php
require './models/model.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'index';

$controller = new Controller();
$controller->$action();

class Controller
{
    // -------------------------------- mặc định vào trang -------------------------------
    public function index()
    {
        require './views/index.php';
    }

    // -------------------------------- trang sản phẩm --------------------------------------

    public function productPage()
    {
        $arr = (new Product())->getAllPrd();
        require './views/sanpham.php';
    }

    // -------------------------------- đăng kí ------------------------------------------

    public function register()
    {
        require './views/register.php';
    }

    // -------------------------------- sử lí đăng kí --------------------------------

    public function ProcessRgt()
    {
        $hovaten = $_POST['hovaten'];
        $gioitinh = $_POST['gioitinh'];
        $ngaysinh = $_POST['ngaysinh'];
        $sodienthoai = $_POST['sodienthoai'];
        $diachi = $_POST['diachi'];
        $email = $_POST['email'];
        $matkhau = $_POST['matkhau'];

        (new Account())->processRgt($hovaten, $gioitinh, $ngaysinh, $sodienthoai, $diachi, $email, $matkhau);
    }

    // ----------------------------- đăng nhập -------------------------------------

    public function login()
    {
        require './views/login.php';
    }

    // ---------------------------- sử lí đăng nhập ---------------------------------

    public function ProcessLogin()
    {

        $email = $_POST['email'];
        $matkhau = $_POST['matkhau'];

        (new Account())->processLogin($email, $matkhau);
    }

    // ---------------------------- đăng xuất ----------------------------------------

    public function Logout()
    {

        $email = $_SESSION['email'];
        $matkhau = $_SESSION['matkhau'];
        $hovaten = $_SESSION['hovaten'];
        $sodienthoai = $_SESSION['sodienthoai'];
        $diachi = $_SESSION['diachi'];
        $ma_tk = $_SESSION['ma_tk'];

        (new Account())->Logout($email, $matkhau, $hovaten, $sodienthoai, $diachi, $ma_tk);
    }

    // -------------------------------- show product ----------------------------------

    public function ShowPrd()
    {
        $ma_sp = $_GET['ma_sp'];

        $product = new Product();
        $prdObject = $product->ShowPrd($ma_sp);

        require './views/chitietsanpham.php';
    }

    // ---------------------------------- danh mục -----------------------------------
    public function selectCategory()
    {
        $FK_ma_danhmuc = $_GET['FK_ma_danhmuc'];

        $arr = (new Product())->getAllPrd($FK_ma_danhmuc);

        require './views/sanpham.php';
    }

    // --------------------------------- crud cho admin --------------------------------
    // -------------------------------- trang quản lí admin ----------------------------

    public function pagePrdManage()
    {
        $arr = (new Product())->getAllPrdinAdmin();
        require './views/PrdManage.php';
    }

    // -------------------------------- tạo sản pẩm ----------------------------------------

    public function CreatePrd()
    {
        require './views/createPrd.php';
    }

    // ------------------------------- lưu sản phẩm ---------------------------------------

    public function StorePrd()
    {
        $ten_sp = $_POST['ten_sp'];
        $anh_sp = $_FILES['anh_sp'];
        $gia_sp = $_POST['gia_sp'];
        $mota_sp = $_POST['mota_sp'];
        $FK_ma_danhmuc = $_POST['FK_ma_danhmuc'];
        $FK_ma_thuonghieu = $_POST['FK_ma_thuonghieu'];

        $product = new Product();
        $product->StorePrd($ten_sp, $anh_sp, $gia_sp, $mota_sp, $FK_ma_danhmuc, $FK_ma_thuonghieu);
    }

    // ---------------------------------- sửa sản phẩm ------------------------

    public function EditPrd()
    {
        $ma_sp = $_GET['ma_sp'];

        $each = new Product();
        $each = $each->FindPrd($ma_sp);

        require './views/editPrd.php';
    }

    // ---------------------------------- sử lí sửa -----------------------------------

    public function UpdatePrd()
    {
        $ma_sp = $_POST['ma_sp'];
        $ten_sp = $_POST['ten_sp'];
        $anh_sp = $_FILES['anh_sp'];
        $gia_sp = $_POST['gia_sp'];
        $mota_sp = $_POST['mota_sp'];

        $product = new Product();
        $product->UpdatePrd($ma_sp, $ten_sp, $anh_sp, $gia_sp, $mota_sp);
    }

    // ------------------------------- xóa sản phẩm -------------------------------------

    public function DeletePrd()
    {
        $ma_sp = $_GET['ma_sp'];

        $product = new Product();
        $product->DeletePrd($ma_sp);
    }

    // ------------------------------- add to cart --------------------------------

    public function AddToCart()
    {
        $ma_sp = $_GET['ma_sp'];
        $obj = new Product();
        $obj->AddToCart($ma_sp);
    }

    // ------------------------------ xem giỏ hàng ---------------------------------
    public function ViewCart()
    {
        header('location: views/xemgiohang.php');
    }

    // ------------------------------ Thanh toán --------------------------------
    public function CheckOut()
    {
        $tennguoidung = $_SESSION['hovaten'];
        $diachinguoidung = $_SESSION['diachi'];
        $sdtnguoidung = $_SESSION['sodienthoai'];
        $emailnguoidung = $_SESSION['email'];
        @$ten_sp = $_SESSION['ten_sp'];
        $soluong = $_SESSION['soluong'];
        $tongtien = $_SESSION['tongtien'];

        $obj = new Product();
        $obj->CheckOut($tennguoidung, $diachinguoidung, $sdtnguoidung, $emailnguoidung, $ten_sp, $soluong, $tongtien);
    }

    // --------------------- sử lý thanh toán in hóa đơn ---------------------------

    public function Payment()
    {
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            $tennguoidung = $_SESSION['hovaten'] ?? '';
            $diachinguoidung = $_SESSION['diachi'] ?? '';
            $sdtnguoidung = $_SESSION['sodienthoai'] ?? '';
            $emailnguoidung = $_SESSION['email'] ?? '';

            $tongtien = $_SESSION['tongtien'] ?? 0;

            $obj = new Product();
            $obj->Payment($tennguoidung, $diachinguoidung, $sdtnguoidung, $emailnguoidung, $tongtien);
        } else {
            header('Location: ?action=login');
        }
    }

    // ---------------------------- sử lí bình luận --------------------------------------

    public function Comment()
    {
        $tennguoibinhluan = $_SESSION['hovaten'];
        $ngaybinhluan = $_POST['ngaybinhluan'];
        $noidungbinhluan = $_POST['noidungbinhluan'];
        $FK_ma_sp = $_POST['FK_ma_sp'];

        $obj = new Product();
        $obj->ProcessComment($tennguoibinhluan, $ngaybinhluan, $noidungbinhluan, $FK_ma_sp);
    }

    // ----------------------------- lịch sử mua hàng ---------------------------

    public function viewHistory()
    {
        require './views/lichsumuahang.php';
    }

    // ----------------------------- admin đơn hàng -----------------------------
    public function getAllOrderByAdmin()
    {
        $obj = new Account();
        $arr = $obj->getAllOrderByAdmin();

        require './views/quanlihoadon.php';
    }

    // ---------------------------- Hủy đơn hàng -------------------------------
    public function CancelOrder()
    {
        $ma_hoadon = $_POST['ma_hoadon'];

        $obj = new Account();
        $obj->CancelOrder($ma_hoadon);

        header('location:?action=viewHistory');
    }
    // ----------------------------- Xác nhận đơn hàng -------------------------------
    public function ChangeStatus()
    {
        $ma_hoadon = $_POST['ma_hoadon'];
        $trangthai = $_POST['trangthai'];

        $obj = new Account();
        $obj->ChangeStatus($ma_hoadon, $trangthai);
    }
}
