<?php require_once 'app/views/shares/header.php'; ?>

<div class="container mt-4">
    <h1 class="mb-4">ĐĂNG KÝ HỌC PHẦN</h1>

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

    <?php if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>Mã HP</th>
                        <th>Tên Học Phần</th>
                        <th>Số Tín Chỉ</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $totalCredits = 0;
                    foreach($_SESSION['cart'] as $item): 
                        $totalCredits += $item['SoTinChi'];
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($item['MaHP']) ?></td>
                        <td><?= htmlspecialchars($item['TenHP']) ?></td>
                        <td><?= (int)$item['SoTinChi'] ?></td>
                        <td>
                            <a href="index.php?controller=dangky&action=remove&id=<?= $item['MaHP'] ?>" class="btn btn-danger btn-sm">Xóa</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2">Số học phần: <span class="font-weight-bold text-danger"><?= count($_SESSION['cart']) ?></span></td>
                        <td colspan="2">Tổng số tín chỉ: <span class="font-weight-bold text-danger"><?= $totalCredits ?></span></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="card mt-4 mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Thông tin Đăng ký</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Mã số sinh viên:</strong> <?= htmlspecialchars($_SESSION['MaSV']) ?></p>
                        <p><strong>Họ tên sinh viên:</strong> <?= htmlspecialchars($_SESSION['HoTen']) ?></p>
                        <p><strong>Ngày sinh:</strong> <?= date('d/m/Y', strtotime($_SESSION['NgaySinh'])) ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Ngành học:</strong> <?= htmlspecialchars($_SESSION['TenNganh']) ?></p>
                        <p><strong>Ngày đăng ký:</strong> <?= date('d/m/Y') ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-3 text-right">
            <a href="index.php?controller=dangky&action=checkout" class="btn btn-primary">Xác Nhận Đăng Ký</a>
            <a href="index.php?controller=dangky&action=clear" class="btn btn-warning" onclick="return confirm('Bạn có chắc muốn hủy tất cả đăng ký?')">Hủy Đăng Ký</a>
            <a href="index.php?controller=hocphan&action=list" class="btn btn-info">Tiếp tục đăng ký</a>
        </div>
    <?php else: ?>
        <div class="alert alert-info">
            <p>Không có học phần nào được chọn.</p>
            <p>Số học phần: <span class="font-weight-bold text-danger">0</span></p>
            <p>Tổng số tín chỉ: <span class="font-weight-bold text-danger">0</span></p>
        </div>
        <div class="mt-3">
            <a href="index.php?controller=hocphan&action=list" class="btn btn-primary">Tiếp tục đăng ký</a>
        </div>
    <?php endif; ?>
</div>

<?php require_once 'app/views/shares/footer.php'; ?>