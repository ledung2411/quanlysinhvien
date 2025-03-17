<?php require_once 'app/views/shares/header.php'; ?>

<h1 class="mb-4">Thêm học phần mới</h1>

<?php if(isset($_SESSION['error'])): ?>
    <div class="alert alert-danger">
        <?= $_SESSION['error']; ?>
        <?php unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>

<form method="post" action="index.php?controller=hocphan&action=add">
    <div class="mb-3">
        <label for="MaHP" class="form-label">Mã học phần:</label>
        <input type="text" class="form-control" id="MaHP" name="MaHP" maxlength="6" required>
        <small class="form-text text-muted">Mã học phần phải có tối đa 6 ký tự.</small>
    </div>
    
    <div class="mb-3">
        <label for="TenHP" class="form-label">Tên học phần:</label>
        <input type="text" class="form-control" id="TenHP" name="TenHP" maxlength="30" required>
    </div>
    
    <div class="mb-3">
        <label for="SoTinChi" class="form-label">Số tín chỉ:</label>
        <input type="number" class="form-control" id="SoTinChi" name="SoTinChi" min="1" max="10" required>
    </div>
    
    <div class="mb-3">
        <label for="SoLuongDuKien" class="form-label">Số lượng sinh viên dự kiến:</label>
        <input type="number" class="form-control" id="SoLuongDuKien" name="SoLuongDuKien" min="1" value="50">
        <small class="form-text text-muted">Số lượng tối đa sinh viên có thể đăng ký học phần này.</small>
    </div>
    
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Thêm học phần</button>
        <a href="index.php?controller=hocphan&action=list" class="btn btn-secondary">Quay lại danh sách học phần</a>
    </div>
</form>

<?php require_once 'app/views/shares/footer.php'; ?>