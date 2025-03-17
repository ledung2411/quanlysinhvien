<?php require_once 'app/views/shares/header.php'; ?>

<div class="container mt-4">
    <h1 class="mb-4">Lịch sử đăng ký học phần</h1>

    <?php if(isset($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <?= $_SESSION['success']; ?>
            <?php unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>

    <?php if(isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?= $_SESSION['error']; ?>
            <?php unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <div class="card mb-4">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">Thông tin sinh viên</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Mã số sinh viên:</strong> <?= htmlspecialchars($_SESSION['MaSV']) ?></p>
                    <p><strong>Họ tên sinh viên:</strong> <?= htmlspecialchars($_SESSION['HoTen']) ?></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Ngành học:</strong> <?= htmlspecialchars($_SESSION['TenNganh']) ?></p>
                </div>
            </div>
        </div>
    </div>

    <?php if($danhSachDangKy->rowCount() > 0): ?>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>Mã đăng ký</th>
                        <th>Ngày đăng ký</th>
                        <th>Số học phần</th>
                        <th>Tổng số tín chỉ</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($dangky = $danhSachDangKy->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?= $dangky['MaDK'] ?></td>
                        <td><?= date('d/m/Y', strtotime($dangky['NgayDK'])) ?></td>
                        <td><?= $dangky['SoLuongHocPhan'] ?></td>
                        <td><?= $dangky['TongSoTinChi'] ?></td>
                        <td>
                            <a href="index.php?controller=dangky&action=detail&id=<?= $dangky['MaDK'] ?>" class="btn btn-info btn-sm">Chi tiết</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-info">
            <p>Bạn chưa có lịch sử đăng ký học phần nào.</p>
        </div>
    <?php endif; ?>

    <div class="mt-3">
        <a href="index.php?controller=hocphan&action=list" class="btn btn-primary">Đăng ký học phần mới</a>
    </div>
</div>

<?php require_once 'app/views/shares/footer.php'; ?>