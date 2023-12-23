<?php

class PrdObject
{
    private int $ma_sp;
    private string $ten_sp;
    private string $anh_sp;
    private string $gia_sp;
    private string $mota_sp;
    private int $FK_ma_danhmuc;
    private int $FK_ma_thuonghieu;
    public string $FK_ten_danhmuc;
    public string $FK_ten_thuonghieu;

    public function get_masp()
    {
        return $this->ma_sp;
    }

    public function set_masp($var)
    {
        $this->ma_sp = $var;
    }

    public function get_tensp()
    {
        return $this->ten_sp;
    }

    public function set_tensp($var)
    {
        $this->ten_sp = $var;
    }

    public function get_anhsp()
    {
        return $this->anh_sp;
    }

    public function set_anhsp($var)
    {
        $this->anh_sp = $var;
    }

    public function get_giasp()
    {
        return $this->gia_sp;
    }

    public function set_giasp($var)
    {
        $this->gia_sp = $var;
    }

    public function get_motasp()
    {
        return $this->mota_sp;
    }

    public function set_motasp($var)
    {
        $this->mota_sp = $var;
    }

    public function get_FK_ma_danhmuc()
    {
        return $this->FK_ma_danhmuc;
    }

    public function set_FK_ma_danhmuc($var)
    {
        $this->FK_ma_danhmuc = $var;
    }

    public function get_FK_ma_thuonghieu()
    {
        return $this->FK_ma_thuonghieu;
    }

    public function set_FK_ma_thuonghieu($var)
    {
        $this->FK_ma_thuonghieu = $var;
    }

    public function get_FK_ten_danhmuc()
    {
        return $this->FK_ten_danhmuc;
    }

    public function get_FK_ten_thuonghieu()
    {
        return $this->FK_ten_thuonghieu;
    }
}
