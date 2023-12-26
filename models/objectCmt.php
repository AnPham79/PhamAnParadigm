<?php

class objectCmt
{
    private $ma_binhluan;
    private $tennguoibinhluan;
    private $ngaybinhluan;
    private $noidungbinhluan;
    private $FK_ma_sp;

    public function __construct($mabinhluan, $tennguoibinhluan, $ngaybinhluan, $noidungbinhluan, $FK_ma_sp)
    {
        $this->ma_binhluan = $mabinhluan;
        $this->tennguoibinhluan = $tennguoibinhluan;
        $this->ngaybinhluan = $ngaybinhluan;
        $this->noidungbinhluan = $noidungbinhluan;
        $this->FK_ma_sp = $FK_ma_sp;
    }

    public function get_mabinhluan()
    {
        return $this->ma_binhluan;
    }

    public function set_mabinhluan($var)
    {
        $this->ma_binhluan = $var;
    }

    public function get_tenguoibinhluan()
    {
        return $this->tennguoibinhluan;
    }

    public function set_tenguoibinhluan($var)
    {
        $this->tennguoibinhluan = $var;
    }

    public function get_ngaybinhluan()
    {
        return $this->ngaybinhluan;
    }

    public function set_ngaybinhluan($var)
    {
        $this->ngaybinhluan = $var;
    }

    public function get_noidungbinhluan()
    {
        return $this->noidungbinhluan;
    }

    public function set_noidungbinhluan($var)
    {
        $this->noidungbinhluan = $var;
    }

    public function get_FKmasp()
    {
        return $this->FK_ma_sp;
    }

    public function set_FKmasp($var)
    {
        $this->FK_ma_sp = $var;
    }
}
