<?php require_once 'app/views/shares/header.php'; ?>

<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800">Thông tin ngành học</h1>
        <div>
            <a href="index.php?controller=nganhhoc&action=edit&id=<?= $this->nganhhoc->MaNganh ?>" class="btn btn-warning me-2">
                <i class="fas fa-edit me-2"></i>Sửa thông tin
            </a>
            <a href="index.php?controller=nganhhoc&action=list" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Quay lại danh sách
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-4">
            <!-- Thông tin ngành học -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Chi tiết ngành học</h6>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <div class="avatar-placeholder rounded-circle d-flex align-items-center justify-content-center bg-primary" 
                            style="width: 100px; height: 100px; margin: 0 auto;">
                            <i class="fas fa-graduation-cap fa-3x text-white"></i>
                        </div>
                        <h4 class="mt-3"><?= htmlspecialchars($this->nganhhoc->TenNganh) ?></h4>
                        <p class="badge bg-primary"><?= htmlspecialchars($this->nganhhoc->MaNganh) ?></p>
                    </div>
                    
                    <div class="mb-3">
                        <h6 class="font-weight-bold">Thống kê</h6>
                        <hr>
                        <div class="row mb-2">
                            <div class="col-8 text-muted">Tổng số sinh viên:</div>
                            <div class="col-4 text-end">
                                <?php 
                                    $studentCount = isset($sinhviens) ? $sinhviens->rowCount() : 0;
                                    echo '<span class="badge bg-info">' . $studentCount . '</span>';
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8">
            <!-- Danh sách sinh viên thuộc ngành -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Sinh viên thuộc ngành này</h6>
                </div>
                <div class="card-body">
                    <?php if(isset($sinhviens) && $sinhviens->rowCount() > 0): ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Mã SV</th>
                                        <th>Họ tên</th>
                                        <th>Giới tính</th>
                                        <th>Ngày sinh</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($sinhvien = $sinhviens->fetch(PDO::FETCH_ASSOC)): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($sinhvien['MaSV']) ?></td>
                                        <td>
                                            <?php if(!empty($sinhvien['Hinh'])): ?>
                                                <img src="public/uploads/<?= $sinhvien['Hinh'] ?>" 
                                                    alt="<?= htmlspecialchars($sinhvien['HoTen']) ?>" 
                                                    class="img-profile rounded-circle me-2" 
                                                    style="width: 30px; height: 30px; object-fit: cover;">
                                            <?php else: ?>
                                                <i class="fas fa-user-circle me-2"></i>
                                            <?php endif; ?>
                                            <?= htmlspecialchars($sinhvien['HoTen']) ?>
                                        </td>
                                        <td><?= htmlspecialchars($sinhvien['GioiTinh']) ?></td>
                                        <td><?= date('d/m/Y', strtotime($sinhvien['NgaySinh'])) ?></td>
                                        <td>
                                            <a href="index.php?controller=sinhvien&action=show&id=<?= $sinhvien['MaSV'] ?>" 
                                                class="btn btn-info btn-sm" title="Xem chi tiết">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>Không có sinh viên nào thuộc ngành học này.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'app/views/shares/footer.php'; ?>