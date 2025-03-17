<?php require_once 'app/views/shares/header.php'; ?>

<h1 class="mb-4">Sửa học phần</h1>

<?php if(isset($_SESSION['error'])): ?>
    <div class="alert alert-danger">
        <?= $_SESSION['error']; ?>
        <?php unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>

<form method="post" action="index.php?controller=hocphan&action=edit&id=<?= $this->hocphan->MaHP ?>">
    <div class="mb-3">
        <label for="MaHP" class="form-label">Mã học phần:</label>
        <input type="text" class="form-control" id="MaHP" value="<?= htmlspecialchars($this->hocphan->MaHP) ?>" disabled>
        <small class="form-text text-muted">Mã học phần không thể thay đổi.</small>
    </div>
    
    <div class="mb-3">
        <label for="TenHP" class="form-label">Tên học phần:</label>
        <input type="text" class="form-control" id="TenHP" name="TenHP" value="<?= htmlspecialchars($this->hocphan->TenHP) ?>" maxlength="30" required>
    </div>
    
    <div class="mb-3">
        <label for="SoTinChi" class="form-label">Số tín chỉ:</label>
        <input type="number" class="form-control" id="SoTinChi" name="SoTinChi" value="<?= (int)$this->hocphan->SoTinChi ?>" min="1" max="10" required>
    </div>
    
    <div class="mb-3">
        <label for="SoLuongDuKien" class="form-label">Số lượng sinh viên dự kiến:</label>
        <input type="number" class="form-control" id="SoLuongDuKien" name="SoLuongDuKien" value="<?= (int)$this->hocphan->SoLuongDuKien ?>" min="1">
        <small class="form-text text-muted">Số lượng tối đa sinh viên có thể đăng ký học phần này.</small>
    </div>
    
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
        <a href="index.php?controller=hocphan&action=list" class="btn btn-secondary">Quay lại danh sách học phần</a>
    </div>
</form>

<?php require_once 'app/views/shares/footer.php'; ?>