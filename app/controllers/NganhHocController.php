<?php
require_once 'app/models/NganhHocModel.php';
require_once 'app/models/SinhVienModel.php';
require_once 'app/config/database.php';

class NganhHocController {
    private $db;
    private $nganhhoc;
    private $sinhvien;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->nganhhoc = new NganhHocModel($this->db);
        $this->sinhvien = new SinhVienModel($this->db);
    }

    public function list() {
        $stmt = $this->nganhhoc->getAll();
        require_once 'app/views/nganhhoc/list.php';
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->nganhhoc->MaNganh = $_POST['MaNganh'];
            $this->nganhhoc->TenNganh = $_POST['TenNganh'];
            
            if ($this->nganhhoc->create()) {
                $_SESSION['success'] = "Thêm ngành học thành công.";
                header("Location: index.php?controller=nganhhoc&action=list");
                exit();
            } else {
                $_SESSION['error'] = "Không thể thêm ngành học. Vui lòng thử lại.";
            }
        }
        require_once 'app/views/nganhhoc/add.php';
    }

    public function edit() {
        if (!isset($_GET['id'])) {
            header("Location: index.php?controller=nganhhoc&action=list");
            exit();
        }

        $this->nganhhoc->MaNganh = $_GET['id'];
        if (!$this->nganhhoc->getById()) {
            $_SESSION['error'] = "Không tìm thấy ngành học.";
            header("Location: index.php?controller=nganhhoc&action=list");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->nganhhoc->TenNganh = $_POST['TenNganh'];
            
            if ($this->nganhhoc->update()) {
                $_SESSION['success'] = "Cập nhật ngành học thành công.";
                header("Location: index.php?controller=nganhhoc&action=list");
                exit();
            } else {
                $_SESSION['error'] = "Không thể cập nhật ngành học. Vui lòng thử lại.";
            }
        }
        require_once 'app/views/nganhhoc/edit.php';
    }

    public function delete() {
        if (!isset($_GET['id'])) {
            header("Location: index.php?controller=nganhhoc&action=list");
            exit();
        }

        $this->nganhhoc->MaNganh = $_GET['id'];
        
        // Kiểm tra xem ngành học có sinh viên không
        $studentCount = $this->nganhhoc->countStudents();
        
        if ($studentCount > 0) {
            // Có sinh viên trong ngành học, không thể xóa
            $_SESSION['error'] = "Không thể xóa ngành học vì có {$studentCount} sinh viên liên quan. Vui lòng chuyển sinh viên sang ngành khác trước.";
            header("Location: index.php?controller=nganhhoc&action=list");
            exit();
        }
        
        if ($this->nganhhoc->delete()) {
            $_SESSION['success'] = "Xóa ngành học thành công.";
            header("Location: index.php?controller=nganhhoc&action=list");
            exit();
        } else {
            $_SESSION['error'] = "Không thể xóa ngành học. Vui lòng thử lại.";
            header("Location: index.php?controller=nganhhoc&action=list");
            exit();
        }
    }
    
    public function show() {
        if (!isset($_GET['id'])) {
            header("Location: index.php?controller=nganhhoc&action=list");
            exit();
        }

        $this->nganhhoc->MaNganh = $_GET['id'];
        if (!$this->nganhhoc->getById()) {
            $_SESSION['error'] = "Không tìm thấy ngành học.";
            header("Location: index.php?controller=nganhhoc&action=list");
            exit();
        }
        
        // Lấy danh sách sinh viên trong ngành học này
        $query = "SELECT MaSV, HoTen, GioiTinh, NgaySinh, Hinh 
                  FROM SinhVien 
                  WHERE MaNganh = ? 
                  ORDER BY HoTen ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$this->nganhhoc->MaNganh]);
        $sinhviens = $stmt;
        
        require_once 'app/views/nganhhoc/show.php';
    }
}
?>