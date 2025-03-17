<?php require_once 'app/views/shares/header.php'; ?>

<div class="container mt-4">
    <h1 class="mb-4">DANH SÁCH HỌC PHẦN</h1>

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

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Mã Học Phần</th>
                    <th>Tên Học Phần</th>
                    <th>Số Tín Chỉ</th>
                    <th>Số lượng dự kiến</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php while($hocphan = $stmt->fetch(PDO::FETCH_ASSOC)): 
                    $soLuongConLai = isset($hocphan['SoLuongDuKien']) ? $hocphan['SoLuongDuKien'] - $hocphan['SoLuongDaDangKy'] : 0;
                    $disabledBtn = ($soLuongConLai <= 0) ? 'disabled' : '';
                ?>
                <tr>
                    <td><?= htmlspecialchars($hocphan['MaHP']) ?></td>
                    <td><?= htmlspecialchars($hocphan['TenHP']) ?></td>
                    <td><?= (int)$hocphan['SoTinChi'] ?></td>
                    <td><?= isset($hocphan['SoLuongDuKien']) ? $hocphan['SoLuongDuKien'] : 'Không giới hạn' ?></td>
                    <td>
                        <?php if(isset($_SESSION['MaSV'])): ?>
                            <a href="index.php?controller=dangky&action=add&id=<?= $hocphan['MaHP'] ?>" class="btn btn-success btn-sm <?= $disabledBtn ?>">Đăng ký</a>
                        <?php else: ?>
                            <a href="index.php?controller=dangky&action=login" class="btn btn-info btn-sm">Đăng nhập để đăng ký</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once 'app/views/shares/footer.php'; ?>