<?php
require_once 'app/models/SinhVienModel.php';
require_once 'app/config/database.php';

class DefaultController {
    private $db;
    private $sinhvien;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->sinhvien = new SinhVienModel($this->db);
        
        // Bắt đầu phiên làm việc nếu chưa bắt đầu
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function index() {
        // Mặc định là chuyển hướng đến trang danh sách sinh viên
        header("Location: index.php?controller=sinhvien&action=list");
        exit();
    }
}
?>