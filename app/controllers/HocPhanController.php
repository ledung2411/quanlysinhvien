<?php
require_once 'app/models/HocPhanModel.php';
require_once 'app/config/database.php';

class HocPhanController {
    private $db;
    private $hocphan;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->hocphan = new HocPhanModel($this->db);
        
        // Bắt đầu phiên làm việc nếu chưa bắt đầu
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function list() {
        // Lấy danh sách học phần
        $stmt = $this->hocphan->getAll();
        require_once 'app/views/hocphan/list.php';
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->hocphan->MaHP = $_POST['MaHP'];
            $this->hocphan->TenHP = $_POST['TenHP'];
            $this->hocphan->SoTinChi = $_POST['SoTinChi'];
            
            if ($this->hocphan->create()) {
                $_SESSION['success'] = "Thêm học phần thành công.";
                header("Location: index.php?controller=hocphan&action=list");
                exit();
            } else {
                $_SESSION['error'] = "Không thể thêm học phần. Vui lòng thử lại.";
            }
        }
        
        require_once 'app/views/hocphan/add.php';
    }

    public function edit() {
        if (!isset($_GET['id'])) {
            header("Location: index.php?controller=hocphan&action=list");
            exit();
        }

        $this->hocphan->MaHP = $_GET['id'];
        
        if (!$this->hocphan->getById()) {
            $_SESSION['error'] = "Không tìm thấy học phần.";
            header("Location: index.php?controller=hocphan&action=list");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->hocphan->TenHP = $_POST['TenHP'];
            $this->hocphan->SoTinChi = $_POST['SoTinChi'];
            
            if ($this->hocphan->update()) {
                $_SESSION['success'] = "Cập nhật học phần thành công.";
                header("Location: index.php?controller=hocphan&action=list");
                exit();
            } else {
                $_SESSION['error'] = "Không thể cập nhật học phần. Vui lòng thử lại.";
            }
        }
        
        require_once 'app/views/hocphan/edit.php';
    }

    public function delete() {
        if (!isset($_GET['id'])) {
            header("Location: index.php?controller=hocphan&action=list");
            exit();
        }

        $this->hocphan->MaHP = $_GET['id'];
        
        if ($this->hocphan->delete()) {
            $_SESSION['success'] = "Xóa học phần thành công.";
        } else {
            $_SESSION['error'] = "Không thể xóa học phần vì học phần đang được sử dụng trong đăng ký.";
        }
        
        header("Location: index.php?controller=hocphan&action=list");
        exit();
    }
}
?>