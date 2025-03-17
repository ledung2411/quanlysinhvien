<?php
class HocPhanModel {
    private $conn;
    private $table_name = "HocPhan";

    public $MaHP;
    public $TenHP;
    public $SoTinChi;
    public $SoLuongDuKien; // Thêm trường mới

    public function __construct($db) {
        $this->conn = $db;
    }

    // Lấy tất cả học phần
    public function getAll() {
        $query = "SELECT hp.*, 
                 (SELECT COUNT(*) FROM ChiTietDangKy ctdk JOIN DangKy dk ON ctdk.MaDK = dk.MaDK WHERE ctdk.MaHP = hp.MaHP) as SoLuongDaDangKy
                 FROM " . $this->table_name . " hp 
                 ORDER BY hp.MaHP ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Lấy học phần theo MaHP
    public function getById() {
        $query = "SELECT hp.*, 
                 (SELECT COUNT(*) FROM ChiTietDangKy ctdk JOIN DangKy dk ON ctdk.MaDK = dk.MaDK WHERE ctdk.MaHP = hp.MaHP) as SoLuongDaDangKy
                 FROM " . $this->table_name . " hp 
                 WHERE hp.MaHP = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->MaHP);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row) {
            $this->TenHP = $row['TenHP'];
            $this->SoTinChi = $row['SoTinChi'];
            $this->SoLuongDuKien = $row['SoLuongDuKien'] ?? 0;
            return true;
        }
        return false;
    }

    // Cập nhật số lượng đăng ký
    public function updateEnrollmentCount($maHP, $soLuong) {
        $query = "UPDATE " . $this->table_name . "
                  SET SoLuongDuKien = SoLuongDuKien - ? 
                  WHERE MaHP = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $soLuong);
        $stmt->bindParam(2, $maHP);

        return $stmt->execute();
    }

    // Tạo học phần mới
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET MaHP = :MaHP, TenHP = :TenHP, SoTinChi = :SoTinChi, SoLuongDuKien = :SoLuongDuKien";

        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->MaHP = htmlspecialchars(strip_tags($this->MaHP));
        $this->TenHP = htmlspecialchars(strip_tags($this->TenHP));
        $this->SoTinChi = htmlspecialchars(strip_tags($this->SoTinChi));
        $this->SoLuongDuKien = htmlspecialchars(strip_tags($this->SoLuongDuKien));

        // Bind values
        $stmt->bindParam(":MaHP", $this->MaHP);
        $stmt->bindParam(":TenHP", $this->TenHP);
        $stmt->bindParam(":SoTinChi", $this->SoTinChi);
        $stmt->bindParam(":SoLuongDuKien", $this->SoLuongDuKien);

        // Execute query
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Cập nhật học phần
    public function update() {
        $query = "UPDATE " . $this->table_name . "
                  SET TenHP = :TenHP, SoTinChi = :SoTinChi, SoLuongDuKien = :SoLuongDuKien
                  WHERE MaHP = :MaHP";

        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->MaHP = htmlspecialchars(strip_tags($this->MaHP));
        $this->TenHP = htmlspecialchars(strip_tags($this->TenHP));
        $this->SoTinChi = htmlspecialchars(strip_tags($this->SoTinChi));
        $this->SoLuongDuKien = htmlspecialchars(strip_tags($this->SoLuongDuKien));

        // Bind values
        $stmt->bindParam(":MaHP", $this->MaHP);
        $stmt->bindParam(":TenHP", $this->TenHP);
        $stmt->bindParam(":SoTinChi", $this->SoTinChi);
        $stmt->bindParam(":SoLuongDuKien", $this->SoLuongDuKien);

        // Execute query
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Xóa học phần
    public function delete() {
        // Trước tiên kiểm tra xem học phần có trong Chi tiết đăng ký không
        $query = "SELECT COUNT(*) as count FROM ChiTietDangKy WHERE MaHP = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->MaHP);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row['count'] > 0) {
            return false; // Không thể xóa vì học phần đang được sử dụng
        }
        
        $query = "DELETE FROM " . $this->table_name . " WHERE MaHP = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->MaHP);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>