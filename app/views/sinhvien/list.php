<?php require_once 'app/views/shares/header.php'; ?>

<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800">Danh sách sinh viên</h1>
        <a href="index.php?controller=sinhvien&action=add" class="btn btn-primary">
            <i class="fas fa-plus-circle me-2"></i>Thêm sinh viên mới
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Quản lý sinh viên</h6>
            <a href="index.php?controller=nganhhoc&action=list" class="btn btn-outline-primary btn-sm">
                <i class="fas fa-graduation-cap me-1"></i>Quản lý ngành học
            </a>
        </div>
        <div class="card-body">
            <?php if($stmt->rowCount() > 0): ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                        <thead class="table-light">
                            <tr>
                                <th>Mã SV</th>
                                <th>Họ tên</th>
                                <th>Giới tính</th>
                                <th>Ngày sinh</th>
                                <th>Ngành học</th>
                                <th>Hình ảnh</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['MaSV']) ?></td>
                                <td><?= htmlspecialchars($row['HoTen']) ?></td>
                                <td><?= htmlspecialchars($row['GioiTinh']) ?></td>
                                <td><?= date('d/m/Y', strtotime($row['NgaySinh'])) ?></td>
                                <td>
                                    <span class="badge bg-info text-dark">
                                        <?= htmlspecialchars($row['TenNganh']) ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <?php if(!empty($row['Hinh'])): ?>
                                        <img src="public/uploads/<?= $row['Hinh'] ?>" 
                                            alt="<?= htmlspecialchars($row['HoTen']) ?>" 
                                            class="img-thumbnail" style="max-width: 50px; max-height: 50px;">
                                    <?php else: ?>
                                        <div class="text-center text-muted">
                                            <i class="fas fa-user fa-2x"></i>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="index.php?controller=sinhvien&action=show&id=<?= $row['MaSV'] ?>" 
                                            class="btn btn-info btn-sm" title="Xem chi tiết">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="index.php?controller=sinhvien&action=edit&id=<?= $row['MaSV'] ?>" 
                                            class="btn btn-warning btn-sm" title="Sửa">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="index.php?controller=sinhvien&action=delete&id=<?= $row['MaSV'] ?>" 
                                            class="btn btn-danger btn-sm" title="Xóa"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa sinh viên này?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>Không có sinh viên nào trong hệ thống.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require_once 'app/views/shares/footer.php'; ?>