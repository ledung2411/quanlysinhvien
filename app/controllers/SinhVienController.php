<?php
require_once 'app/models/SinhVienModel.php';
require_once 'app/models/NganhHocModel.php';
require_once 'app/config/database.php';

class SinhVienController {
    private $db;
    private $sinhvien;
    private $nganhhoc;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->sinhvien = new SinhVienModel($this->db);
        $this->nganhhoc = new NganhHocModel($this->db);
    }

    public function list() {
        $stmt = $this->sinhvien->getAll();
        require_once 'app/views/sinhvien/list.php';
    }

    public function add() {
        $nganhHocs = $this->nganhhoc->getAll();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->sinhvien->MaSV = $_POST['MaSV'];
            $this->sinhvien->HoTen = $_POST['HoTen'];
            $this->sinhvien->GioiTinh = $_POST['GioiTinh'];
            $this->sinhvien->NgaySinh = $_POST['NgaySinh'];
            $this->sinhvien->MaNganh = $_POST['MaNganh'];
            
            // Xử lý upload hình ảnh
            $this->sinhvien->Hinh = ""; // Giá trị mặc định
            
            if(!empty($_FILES["Hinh"]["name"])) {
                // Thư mục upload
                $target_dir = "public/uploads/";
                
                // Tạo thư mục nếu chưa tồn tại
                if (!file_exists($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                
                // Tên file
                $filename = basename($_FILES["Hinh"]["name"]);
                $target_file = $target_dir . $filename;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                
                // Kiểm tra loại file
                $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
                if(in_array($imageFileType, $allowTypes)) {
                    // Upload file
                    if(move_uploaded_file($_FILES["Hinh"]["tmp_name"], $target_file)) {
                        $this->sinhvien->Hinh = $filename;
                        // Lưu tên file vào biến tạm để đảm bảo không bị mất
                        $uploadedImage = $filename;
                    }
                }
            }
            
            // Đảm bảo giá trị Hinh không bị mất
            if (isset($uploadedImage)) {
                $this->sinhvien->Hinh = $uploadedImage;
            }
            
            if ($this->sinhvien->create()) {
                $_SESSION['success'] = "Thêm sinh viên thành công.";
                header("Location: index.php?controller=sinhvien&action=list");
                exit();
            } else {
                $_SESSION['error'] = "Không thể thêm sinh viên. Vui lòng thử lại.";
            }
        }
        require_once 'app/views/sinhvien/add.php';
    }

    public function edit() {
        if (!isset($_GET['id'])) {
            header("Location: index.php?controller=sinhvien&action=list");
            exit();
        }

        $nganhHocs = $this->nganhhoc->getAll();
        $this->sinhvien->MaSV = $_GET['id'];
        
        if (!$this->sinhvien->getById()) {
            $_SESSION['error'] = "Không tìm thấy sinh viên.";
            header("Location: index.php?controller=sinhvien&action=list");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->sinhvien->HoTen = $_POST['HoTen'];
            $this->sinhvien->GioiTinh = $_POST['GioiTinh'];
            $this->sinhvien->NgaySinh = $_POST['NgaySinh'];
            $this->sinhvien->MaNganh = $_POST['MaNganh'];
            
            // Xử lý upload hình ảnh mới (nếu có)
            if(!empty($_FILES["Hinh"]["name"])) {
                // Thư mục upload
                $target_dir = "public/uploads/";
                
                // Tạo thư mục nếu chưa tồn tại
                if (!file_exists($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                
                // Tên file
                $filename = basename($_FILES["Hinh"]["name"]);
                $target_file = $target_dir . $filename;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                
                // Kiểm tra loại file
                $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
                if(in_array($imageFileType, $allowTypes)) {
                    // Upload file
                    if(move_uploaded_file($_FILES["Hinh"]["tmp_name"], $target_file)) {
                        // Xóa file cũ nếu có
                        if(!empty($this->sinhvien->Hinh) && file_exists($target_dir . $this->sinhvien->Hinh)) {
                            unlink($target_dir . $this->sinhvien->Hinh);
                        }
                        $this->sinhvien->Hinh = $filename;
                    }
                }
            }
            
            if ($this->sinhvien->update()) {
                $_SESSION['success'] = "Cập nhật sinh viên thành công.";
                header("Location: index.php?controller=sinhvien&action=list");
                exit();
            } else {
                $_SESSION['error'] = "Không thể cập nhật sinh viên. Vui lòng thử lại.";
            }
        }
        require_once 'app/views/sinhvien/edit.php';
    }

    public function delete() {
        if (!isset($_GET['id'])) {
            header("Location: index.php?controller=sinhvien&action=list");
            exit();
        }

        $this->sinhvien->MaSV = $_GET['id'];
        
        // Lấy thông tin sinh viên trước khi xóa
        if (!$this->sinhvien->getById()) {
            $_SESSION['error'] = "Không tìm thấy sinh viên.";
            header("Location: index.php?controller=sinhvien&action=list");
            exit();
        }
        
        $hinh = $this->sinhvien->Hinh;
        
        // Kiểm tra xem sinh viên có đăng ký học phần nào không
        $query = "SELECT COUNT(*) as count FROM DangKy WHERE MaSV = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$this->sinhvien->MaSV]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row['count'] > 0) {
            $_SESSION['error'] = "Không thể xóa sinh viên vì có đăng ký học phần liên quan. Vui lòng xóa các đăng ký trước.";
            header("Location: index.php?controller=sinhvien&action=list");
            exit();
        }
        
        if ($this->sinhvien->delete()) {
            // Xóa hình ảnh kèm theo nếu có
            if(!empty($hinh)) {
                $target_dir = "public/uploads/";
                if(file_exists($target_dir . $hinh)) {
                    unlink($target_dir . $hinh);
                }
            }
            
            $_SESSION['success'] = "Xóa sinh viên thành công.";
            header("Location: index.php?controller=sinhvien&action=list");
            exit();
        } else {
            $_SESSION['error'] = "Không thể xóa sinh viên. Vui lòng thử lại.";
            header("Location: index.php?controller=sinhvien&action=list");
            exit();
        }
    }

    public function show() {
        if (!isset($_GET['id'])) {
            header("Location: index.php?controller=sinhvien&action=list");
            exit();
        }

        $this->sinhvien->MaSV = $_GET['id'];
        if (!$this->sinhvien->getById()) {
            $_SESSION['error'] = "Không tìm thấy sinh viên.";
            header("Location: index.php?controller=sinhvien&action=list");
            exit();
        }
        
        // Lấy thông tin các học phần đã đăng ký
        $query = "SELECT dk.MaDK, dk.NgayDK, hp.MaHP, hp.TenHP, hp.SoTinChi
                  FROM DangKy dk 
                  JOIN ChiTietDangKy ctdk ON dk.MaDK = ctdk.MaDK
                  JOIN HocPhan hp ON ctdk.MaHP = hp.MaHP
                  WHERE dk.MaSV = ?
                  ORDER BY dk.NgayDK DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$this->sinhvien->MaSV]);
        $dangKys = $stmt;
        
        require_once 'app/views/sinhvien/show.php';
    }
}
?>