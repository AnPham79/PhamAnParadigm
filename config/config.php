<?php

class Database
{
    private $db_host = 'localhost';
    private $db_user = 'root';
    private $db_pass = '';
    private $db_name = 'project_oop_php';

    private $conn = null;

    public function __construct()
    {
        $this->conn = mysqli_connect($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
        mysqli_set_charset($this->conn, 'utf8');

        if (!$this->conn) {
            error_log("Kết nối thất bại: " . mysqli_connect_error());
        }
    }

    public function conn_db($sql)
    {
        $result = mysqli_query($this->conn, $sql);

        if (!$result) {
            error_log("Truy vấn thất bại: " . mysqli_error($this->conn));
        }

        return $result;
    }

    public function __destruct()
    {
        if ($this->conn) {
            mysqli_close($this->conn);
        }
    }
}
