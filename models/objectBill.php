<?php

class objectBill
{
    private $ma_hoadon;
    private $tennguoidung;
    private $diachinguoidung;
    private $sdtnguoidung;
    private $emailnguoidung;
    private $tensanpham;
    private $soluong;
    private $tongtien;
    private $trangthai;

    public function __construct(
        $ma_hoadon,
        $tennguoidung,
        $diachinguoidung,
        $sdtnguoidung,
        $emailnguoidung,
        $tensanpham,
        $soluong,
        $tongtien,
        $trangthai
    ) {
        $this->ma_hoadon = $ma_hoadon;
        $this->tennguoidung = $tennguoidung;
        $this->diachinguoidung = $diachinguoidung;
        $this->sdtnguoidung = $sdtnguoidung;
        $this->emailnguoidung = $emailnguoidung;
        $this->tensanpham = $tensanpham;
        $this->soluong = $soluong;
        $this->tongtien = $tongtien;
        $this->trangthai = $trangthai;

    }

    public function get_ma_hoadon()
    {
        return $this->ma_hoadon;
    }

    public function set_ma_hoadon($ma_hoadon)
    {
        $this->ma_hoadon = $ma_hoadon;
    }

    public function get_tennguoidung()
    {
        return $this->tennguoidung;
    }

    public function set_tennguoidung($tennguoidung)
    {
        $this->tennguoidung = $tennguoidung;
    }

    public function get_diachinguoidung()
    {
        return $this->diachinguoidung;
    }

    public function set_diachinguoidung($diachinguoidung)
    {
        $this->diachinguoidung = $diachinguoidung;
    }

    public function get_sdtnguoidung()
    {
        return $this->sdtnguoidung;
    }

    public function set_sdtnguoidung($sdtnguoidung)
    {
        $this->sdtnguoidung = $sdtnguoidung;
    }

    public function get_emailnguoidung()
    {
        return $this->emailnguoidung;
    }

    public function set_emailnguoidung($emailnguoidung)
    {
        $this->emailnguoidung = $emailnguoidung;
    }

    public function get_tensanpham()
    {
        return $this->tensanpham;
    }

    public function set_tensanpham($tensanpham)
    {
        $this->tensanpham = $tensanpham;
    }

    public function get_soluong()
    {
        return $this->soluong;
    }

    public function set_soluong($soluong)
    {
        $this->soluong = $soluong;
    }

    public function get_tongtien()
    {
        return $this->tongtien;
    }

    public function set_tongtien($tongtien)
    {
        $this->tongtien = $tongtien;
    }

    public function get_trangthai()
    {
        return $this->trangthai;
    }

    public function set_trangthai($trangthai)
    {
        $this->trangthai = $trangthai;
    }
}
