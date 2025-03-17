<?php require_once 'app/views/shares/header.php'; ?>

<div class="container mt-4">
    <h1 class="mb-4">ĐĂNG NHẬP</h1>

    <?php if(isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?= $_SESSION['error']; ?>
            <?php unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="index.php?controller=dangky&action=login">
                        <div class="form-group">
                            <label for="MaSV">Mã SV</label>
                            <input type="text" class="form-control" id="MaSV" name="MaSV" placeholder="Nhập mã sinh viên" required>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">Đăng Nhập</button>
                        </div>
                    </form>
                    <div class="text-center mt-3">
                        <a href="index.php?controller=hocphan&action=list">Back to List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'app/views/shares/footer.php'; ?>