<?php require_once 'app/views/shares/header.php'; ?>

<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800">Thêm sinh viên mới</h1>
        <a href="index.php?controller=sinhvien&action=list" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Quay lại danh sách
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thông tin sinh viên</h6>
        </div>
        <div class="card-body">
            <form method="post" action="index.php?controller=sinhvien&action=add" enctype="multipart/form-data" class="needs-validation" novalidate>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="MaSV" class="form-label">Mã sinh viên <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                            <input type="text" class="form-control" id="MaSV" name="MaSV" maxlength="10" required>
                        </div>
                        <div class="form-text">Mã sinh viên phải có tối đa 10 ký tự.</div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="HoTen" class="form-label">Họ tên <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" class="form-control" id="HoTen" name="HoTen" maxlength="50" required>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="GioiTinh" class="form-label">Giới tính</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
                            <select class="form-select" id="GioiTinh" name="GioiTinh">
                                <option value="Nam">Nam</option>
                                <option value="Nữ">Nữ</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="NgaySinh" class="form-label">Ngày sinh <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            <input type="date" class="form-control" id="NgaySinh" name="NgaySinh" required>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="MaNganh" class="form-label">Ngành học <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                            <select class="form-select" id="MaNganh" name="MaNganh" required>
                                <?php while($nganhHoc = $nganhHocs->fetch(PDO::FETCH_ASSOC)): ?>
                                    <option value="<?= $nganhHoc['MaNganh'] ?>"><?= htmlspecialchars($nganhHoc['TenNganh']) ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="Hinh" class="form-label">Hình ảnh</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-image"></i></span>
                            <input type="file" class="form-control" id="Hinh" name="Hinh" accept="image/*">
                        </div>
                        <div class="form-text">Chỉ chấp nhận các file ảnh (jpg, jpeg, png, gif).</div>
                    </div>
                </div>
                
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Lưu sinh viên
                    </button>
                    <button type="reset" class="btn btn-secondary">
                        <i class="fas fa-undo me-2"></i>Làm mới
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Form validation
(function() {
    'use strict';
    var forms = document.querySelectorAll('.needs-validation');
    Array.prototype.slice.call(forms).forEach(function(form) {
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });
})();
</script>

<?php require_once 'app/views/shares/footer.php'; ?>