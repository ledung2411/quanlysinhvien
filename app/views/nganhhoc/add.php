<?php require_once 'app/views/shares/header.php'; ?>

<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800">Thêm ngành học mới</h1>
        <a href="index.php?controller=nganhhoc&action=list" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Quay lại danh sách
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thông tin ngành học</h6>
        </div>
        <div class="card-body">
            <form method="post" action="index.php?controller=nganhhoc&action=add" class="needs-validation" novalidate>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="MaNganh" class="form-label">Mã ngành <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            <input type="text" class="form-control" id="MaNganh" name="MaNganh" maxlength="4" required>
                        </div>
                        <div class="form-text">Mã ngành phải có tối đa 4 ký tự.</div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="TenNganh" class="form-label">Tên ngành <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                            <input type="text" class="form-control" id="TenNganh" name="TenNganh" maxlength="30" required>
                        </div>
                        <div class="form-text">Tên ngành phải có tối đa 30 ký tự.</div>
                    </div>
                </div>
                
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Lưu ngành học
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