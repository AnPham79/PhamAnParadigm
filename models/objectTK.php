<?php

class AccountObject {
    private int $ma_tk;
    private string $hovaten;
    private string $gioitinh;
    private string $ngaysinh;
    private string $email;
    private string $sodienthoai;
    private string $diachi;
    private string $matkhau;

    public function get_matk() {
        return $this->ma_tk;
    }

    public function set_matk($var) {
        $this->ma_tk = $var;
    }

    public function get_hoten() {
        return $this->hovaten;
    }

    public function set_hoten($var) {
        $this->hovaten = $var;
    }

    public function get_gioitinh() {
        return $this->gioitinh;
    }

    public function set_gioitinh($var) {
        $this->gioitinh = $var;
    }

    public function get_ngaysinh() {
        return $this->ngaysinh;
    }

    public function set_sodienthoai($var) {
        $this->sodienthoai = $var;
    }

    public function get_sodienthoai() {
        return $this->sodienthoai;
    }

    public function set_diachi($var) {
        $this->diachi = $var;
    }

    public function get_diachi() {
        return $this->diachi;
    }

    public function set_ngaysinh($var) {
        $this->ngaysinh = $var;
    }

    public function get_email() {
        return $this->email;
    }

    public function set_email($var) {
        $this->email = $var;
    }

    public function get_matkhau() {
        return $this->matkhau;
    }

    public function set_matkhau($var) {
        $this->matkhau = $var;
    }
}