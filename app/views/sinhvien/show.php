<?php require_once 'app/views/shares/header.php'; ?>

<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800">Thông tin sinh viên</h1>
        <div>
            <a href="index.php?controller=sinhvien&action=edit&id=<?= $this->sinhvien->MaSV ?>" class="btn btn-warning me-2">
                <i class="fas fa-edit me-2"></i>Sửa thông tin
            </a>
            <a href="index.php?controller=sinhvien&action=list" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Quay lại danh sách
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-4">
            <!-- Thông tin sinh viên -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Thông tin cá nhân</h6>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <?php if(!empty($this->sinhvien->Hinh)): ?>
                            <img src="public/uploads/<?= htmlspecialchars($this->sinhvien->Hinh) ?>" 
                                alt="<?= htmlspecialchars($this->sinhvien->HoTen) ?>" 
                                class="img-profile rounded-circle" 
                                style="width: 150px; height: 150px; object-fit: cover; border: 5px solid #4e73df;">
                        <?php else: ?>
                            <div class="avatar-placeholder rounded-circle d-flex align-items-center justify-content-center bg-primary" 
                                style="width: 150px; height: 150px; margin: 0 auto;">
                                <i class="fas fa-user fa-5x text-white"></i>
                            </div>
                        <?php endif; ?>
                        <h4 class="mt-3"><?= htmlspecialchars($this->sinhvien->HoTen) ?></h4>
                        <p class="badge bg-primary"><?= htmlspecialchars($this->sinhvien->MaSV) ?></p>
                    </div>
                    
                    <div class="mb-3">
                        <h6 class="font-weight-bold">Thông tin chi tiết</h6>
                        <hr>
                        <div class="row mb-2">
                            <div class="col-5 text-muted">Giới tính:</div>
                            <div class="col-7"><?= htmlspecialchars($this->sinhvien->GioiTinh) ?></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5 text-muted">Ngày sinh:</div>
                            <div class="col-7"><?= date('d/m/Y', strtotime($this->sinhvien->NgaySinh)) ?></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5 text-muted">Ngành học:</div>
                            <div class="col-7">
                                <span class="badge bg-info text-dark">
                                    <?= htmlspecialchars($this->sinhvien->TenNganh) ?>
                                </span>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5 text-muted">Mã ngành:</div>
                            <div class="col-7"><?= htmlspecialchars($this->sinhvien->MaNganh) ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8">
            <!-- Học phần đã đăng ký -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Học phần đã đăng ký</h6>
                    <?php if(isset($_SESSION['MaSV']) && $_SESSION['MaSV'] == $this->sinhvien->MaSV): ?>
                        <a href="index.php?controller=dangky&action=history" class="btn btn-sm btn-primary">
                            <i class="fas fa-history me-1"></i>Xem lịch sử đăng ký
                        </a>
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <?php if(isset($dangKys) && $dangKys->rowCount() > 0): ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Mã học phần</th>
                                        <th>Tên học phần</th>
                                        <th>Số tín chỉ</th>
                                        <th>Ngày đăng ký</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $totalCredits = 0;
                                    while($dangKy = $dangKys->fetch(PDO::FETCH_ASSOC)): 
                                        $totalCredits += $dangKy['SoTinChi'];
                                    ?>
                                    <tr>
                                        <td><?= htmlspecialchars($dangKy['MaHP']) ?></td>
                                        <td><?= htmlspecialchars($dangKy['TenHP']) ?></td>
                                        <td><?= (int)$dangKy['SoTinChi'] ?></td>
                                        <td><?= date('d/m/Y', strtotime($dangKy['NgayDK'])) ?></td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="2">Tổng số tín chỉ:</th>
                                        <th colspan="2"><?= $totalCredits ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>Sinh viên chưa đăng ký học phần nào.
                        </div>
                        <?php if(isset($_SESSION['MaSV']) && $_SESSION['MaSV'] == $this->sinhvien->MaSV): ?>
                            <div class="text-center mt-3">
                                <a href="index.php?controller=hocphan&action=list" class="btn btn-primary">
                                    <i class="fas fa-clipboard-list me-2"></i>Đăng ký học phần ngay
                                </a>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'app/views/shares/footer.php'; ?>