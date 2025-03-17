<?php require_once 'app/views/shares/header.php'; ?>

<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800">Danh sách ngành học</h1>
        <a href="index.php?controller=nganhhoc&action=add" class="btn btn-primary">
            <i class="fas fa-plus-circle me-2"></i>Thêm ngành học mới
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Quản lý ngành học</h6>
            <a href="index.php?controller=sinhvien&action=list" class="btn btn-outline-primary btn-sm">
                <i class="fas fa-user-graduate me-1"></i>Quản lý sinh viên
            </a>
        </div>
        <div class="card-body">
            <?php if($stmt->rowCount() > 0): ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                        <thead class="table-light">
                            <tr>
                                <th width="20%">Mã ngành</th>
                                <th>Tên ngành</th>
                                <th width="20%">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['MaNganh']) ?></td>
                                <td><?= htmlspecialchars($row['TenNganh']) ?></td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="index.php?controller=nganhhoc&action=show&id=<?= $row['MaNganh'] ?>" 
                                            class="btn btn-info btn-sm" title="Xem chi tiết">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="index.php?controller=nganhhoc&action=edit&id=<?= $row['MaNganh'] ?>" 
                                            class="btn btn-warning btn-sm" title="Sửa">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="index.php?controller=nganhhoc&action=delete&id=<?= $row['MaNganh'] ?>" 
                                            class="btn btn-danger btn-sm" title="Xóa"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa ngành học này? Tất cả sinh viên thuộc ngành này sẽ bị ảnh hưởng.')">
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
                    <i class="fas fa-info-circle me-2"></i>Không có ngành học nào trong hệ thống.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require_once 'app/views/shares/footer.php'; ?>