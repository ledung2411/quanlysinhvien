<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Sinh viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { font-family: Arial, sans-serif; background: #f9f9f9; }
        .navbar { background: #fff; padding: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .navbar-brand { font-weight: bold; color: #007bff; }
        .nav-link { color: #333; }
        .nav-link:hover { color: #007bff; }
        .dropdown-menu { border: none; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .content-wrapper { padding: 20px; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="index.php">QL Sinh viên</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Sinh viên</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="index.php?controller=sinhvien&action=list">Danh sách</a></li>
                            <li><a class="dropdown-item" href="index.php?controller=sinhvien&action=add">Thêm</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Ngành học</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="index.php?controller=nganhhoc&action=list">Danh sách</a></li>
                            <li><a class="dropdown-item" href="index.php?controller=nganhhoc&action=add">Thêm</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="ms-auto">
                    <?php if(isset($_SESSION['MaSV'])): ?>
                        <span class="me-3">Xin chào, <?= htmlspecialchars($_SESSION['HoTen']) ?></span>
                        <a href="index.php?controller=dangky&action=logout" class="btn btn-outline-primary btn-sm">Đăng xuất</a>
                    <?php else: ?>
                        <a href="index.php?controller=dangky&action=login" class="btn btn-primary btn-sm">Đăng nhập</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
    <div class="content-wrapper container">
        <?php if(isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?= $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>
        <?php if(isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?= $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
