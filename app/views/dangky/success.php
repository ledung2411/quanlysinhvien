<?php require_once 'app/views/shares/header.php'; ?>

<div class="container mt-4">
    <div class="alert alert-success mb-4">
        <h4 class="alert-heading">Đăng ký học phần thành công!</h4>
        <p>Bạn đã đăng ký học phần thành công. Chi tiết đăng ký như sau.</p>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">THÔNG TIN HỌC PHẦN ĐÃ LƯU</h5>
        </div>
        <div class="card-body">
            <p><a href="index.php?controller=hocphan&action=list" class="btn btn-sm btn-outline-primary">Về trang chủ</a></p>

            <h6 class="mt-4">Kết quả sau khi đăng ký học phần:</h6>
            
            <div class="table-responsive mt-3">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>MaDK</th>
                            <th>NgayDK</th>
                            <th>MaSV</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $dangky['MaDK'] ?></td>
                            <td><?= date('d/m/Y', strtotime($dangky['NgayDK'])) ?></td>
                            <td><?= $dangky['MaSV'] ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="table-responsive mt-4">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>MaDK</th>
                            <th>MaHP</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 1;
                        while($chitiet = $chiTietDangKy->fetch(PDO::FETCH_ASSOC)): 
                        ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $dangky['MaDK'] ?></td>
                            <td><?= $chitiet['MaHP'] ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">Thông tin Đăng ký</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Mã số sinh viên:</strong> <?= htmlspecialchars($dangky['MaSV']) ?></p>
                    <p><strong>Họ tên sinh viên:</strong> <?= htmlspecialchars($dangky['HoTen']) ?></p>
                    <p><strong>Ngày sinh:</strong> <?= date('d/m/Y', strtotime($dangky['NgaySinh'])) ?></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Ngành học:</strong> <?= htmlspecialchars($dangky['TenNganh']) ?> (<?= htmlspecialchars($dangky['MaNganh']) ?>)</p>
                    <p><strong>Ngày đăng ký:</strong> <?= date('d/m/Y', strtotime($dangky['NgayDK'])) ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-3 text-center">
        <a href="index.php?controller=hocphan&action=list" class="btn btn-primary">Tiếp tục đăng ký học phần</a>
        <a href="index.php?controller=dangky&action=history" class="btn btn-info">Xem lịch sử đăng ký</a>
    </div>
</div>

<?php require_once 'app/views/shares/footer.php'; ?>