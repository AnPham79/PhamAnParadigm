<?php
require './models/model.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'index';

$controller = new Controller();
$controller->$action();

class Controller
{
    public function index()
    {
        require './views/index.php';
    }

    public function productPage()
    {
        $arr = (new Product())->getAllPrd();
        require './views/sanpham.php';
    }

    public function register()
    {
        require './views/register.php';
    }

    public function ProcessRgt()
    {
        $hovaten = $_POST['hovaten'];
        $gioitinh = $_POST['gioitinh'];
        $ngaysinh = $_POST['ngaysinh'];
        $email = $_POST['email'];
        $matkhau = $_POST['matkhau'];

        (new Account())->processRgt($hovaten, $gioitinh, $ngaysinh, $email, $matkhau);
    }

    public function login()
    {
        require './views/login.php';
    }

    public function ProcessLogin()
    {

        $email = $_POST['email'];
        $matkhau = $_POST['matkhau'];

        (new Account())->processLogin($email, $matkhau);
    }

    public function Logout()
    {

        $email = $_SESSION['email'];
        $matkhau = $_SESSION['matkhau'];
        $hovaten = $_SESSION['hovaten'];

        (new Account())->Logout($email, $matkhau, $hovaten);
    }

    public function ShowPrd() {
        $ma_sp = $_GET['ma_sp'];
    
        $product = new Product();
        $prdObject = $product->ShowPrd($ma_sp);
    
        require './views/chitietsanpham.php';
    }
    

    // --------------------------------- crud cho admin --------------------------------

    public function pagePrdManage()
    {
        $arr = (new Product())->getAllPrdinAdmin();
        require './views/PrdManage.php';
    }

    public function CreatePrd()
    {
        require './views/createPrd.php';
    }

    public function StorePrd()
    {
        $ten_sp = $_POST['ten_sp'];
        $anh_sp = $_FILES['anh_sp'];
        $gia_sp = $_POST['gia_sp'];
        $mota_sp = $_POST['mota_sp'];

        $product = new Product();
        $product->StorePrd($ten_sp, $anh_sp, $gia_sp, $mota_sp);
    }

    public function EditPrd()
    {
        $ma_sp = $_GET['ma_sp'];

        $each = new Product();
        $each = $each->FindPrd($ma_sp);

        require './views/editPrd.php';
    }

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

    public function DeletePrd() {
        $ma_sp = $_GET['ma_sp'];

        $product = new Product();
        $product->DeletePrd($ma_sp);
    }
}
