<?php require_once 'app/views/shares/header.php'; ?>

<div class="container mt-4">
    <h1 class="mb-4">Chi tiết đăng ký học phần</h1>

    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Thông tin đăng ký</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Mã đăng ký:</strong> <?= $dangky['MaDK'] ?></p>
                    <p><strong>Ngày đăng ký:</strong> <?= date('d/m/Y', strtotime($dangky['NgayDK'])) ?></p>
                    <p><strong>Mã sinh viên:</strong> <?= htmlspecialchars($dangky['MaSV']) ?></p>
                    <p><strong>Họ tên sinh viên:</strong> <?= htmlspecialchars($dangky['HoTen']) ?></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Ngày sinh:</strong> <?= date('d/m/Y', strtotime($dangky['NgaySinh'])) ?></p>
                    <p><strong>Ngành học:</strong> <?= htmlspecialchars($dangky['TenNganh']) ?> (<?= htmlspecialchars($dangky['MaNganh']) ?>)</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">Danh sách học phần đã đăng ký</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Mã học phần</th>
                            <th>Tên học phần</th>
                            <th>Số tín chỉ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 1;
                        $totalCredits = 0;
                        while($chitiet = $chiTietDangKy->fetch(PDO::FETCH_ASSOC)): 
                            $totalCredits += $chitiet['SoTinChi'];
                        ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= htmlspecialchars($chitiet['MaHP']) ?></td>
                            <td><?= htmlspecialchars($chitiet['TenHP']) ?></td>
                            <td><?= (int)$chitiet['SoTinChi'] ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-right font-weight-bold">Tổng số tín chỉ:</td>
                            <td class="font-weight-bold"><?= $totalCredits ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">
        <a href="index.php?controller=dangky&action=history" class="btn btn-secondary">Quay lại lịch sử đăng ký</a>
        <a href="index.php?controller=hocphan&action=list" class="btn btn-primary">Đăng ký học phần mới</a>
    </div>
</div>

<?php require_once 'app/views/shares/footer.php'; ?>