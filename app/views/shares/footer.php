</div>
    </div>
    
    <!-- Footer -->
    <footer class="bg-white py-4 mt-auto">
        <div class="container">
            <div class="row">
                <!-- Logo & Description -->
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h5 class="text-primary">
                        <i class="fas fa-graduation-cap me-2"></i>QUẢN LÝ SINH VIÊN
                    </h5>
                    <p class="text-muted">
                        Hệ thống quản lý sinh viên chuyên nghiệp, giúp quản lý thông tin sinh viên, ngành học và đăng ký học phần hiệu quả.
                    </p>
                    <div class="social-icons">
                        <a href="#" class="text-primary me-2"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-primary me-2"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-primary me-2"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="text-primary"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div class="col-lg-8">
                    <div class="row">
                        <!-- Sinh viên Links -->
                        <div class="col-md-4 mb-4 mb-md-0">
                            <h6 class="text-dark mb-3">SINH VIÊN</h6>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2">
                                    <a href="index.php?controller=sinhvien&action=list" class="text-muted">
                                        <i class="fas fa-angle-right me-1"></i> Danh sách sinh viên
                                    </a>
                                </li>
                                <li class="mb-2">
                                    <a href="index.php?controller=sinhvien&action=add" class="text-muted">
                                        <i class="fas fa-angle-right me-1"></i> Thêm sinh viên
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- Ngành học & Học phần Links -->
                        <div class="col-md-4 mb-4 mb-md-0">
                            <h6 class="text-dark mb-3">NGÀNH HỌC & HỌC PHẦN</h6>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2">
                                    <a href="index.php?controller=nganhhoc&action=list" class="text-muted">
                                        <i class="fas fa-angle-right me-1"></i> Danh sách ngành học
                                    </a>
                                </li>
                                <li class="mb-2">
                                    <a href="index.php?controller=hocphan&action=list" class="text-muted">
                                        <i class="fas fa-angle-right me-1"></i> Danh sách học phần
                                    </a>
                                </li>
                                <li class="mb-2">
                                    <a href="index.php?controller=hocphan&action=add" class="text-muted">
                                        <i class="fas fa-angle-right me-1"></i> Thêm học phần
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-4">
        </div>
    </footer>
    
    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
        // Add active class to current page link
        document.addEventListener('DOMContentLoaded', function() {
            const currentPage = window.location.href;
            const navLinks = document.querySelectorAll('.nav-link, .dropdown-item');
            
            navLinks.forEach(link => {
                if (currentPage.includes(link.getAttribute('href'))) {
                    link.classList.add('active-page');
                    
                    // If it's a dropdown item, also highlight parent dropdown
                    if (link.classList.contains('dropdown-item')) {
                        const dropdownId = link.closest('.dropdown-menu').getAttribute('aria-labelledby');
                        document.getElementById(dropdownId).classList.add('active-page');
                    }
                }
            });
            
            // Auto close alerts after 5 seconds
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    const closeBtn = alert.querySelector('.btn-close');
                    if (closeBtn) {
                        closeBtn.click();
                    }
                }, 5000);
            });
        });
    </script>
</body>
</html>