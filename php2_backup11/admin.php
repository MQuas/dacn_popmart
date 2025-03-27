<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Trang Chủ Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* CSS cho sidebar */
    #sidebar {
      min-height: 100vh;
    }
    /* Để sidebar cố định khi cuộn trang */
    .sticky-top-sidebar {
      position: sticky;
      top: 0;
    }
  </style>
</head>
<body>
  <!-- Header -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3">
      <a class="navbar-brand fw-bold text-uppercase" href="#">Admin Panel</a>
      
      <form class="d-none d-md-flex ms-auto me-3">
          <input class="form-control" type="search" placeholder="Tìm kiếm..." aria-label="Tìm kiếm">
      </form>
  
      <ul class="navbar-nav">
          <!-- Thông báo -->
          <li class="nav-item">
              <a class="nav-link text-light position-relative" href="#">
                  🔔
                  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                      3+
                  </span>
              </a>
          </li>
  
          <!-- Dropdown User -->
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-light d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                  <img src="https://via.placeholder.com/40" alt="Admin" class="rounded-circle me-2" width="40">
                  <span>Admin</span>
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                  <li><a class="dropdown-item" href="#">Hồ sơ</a></li>
                  <li><a class="dropdown-item" href="#">Cài đặt</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item text-danger" href="#">Đăng xuất</a></li>
              </ul>
          </li>
      </ul>
  </nav>
  
  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <nav id="sidebar" class="col-md-2 d-none d-md-block bg-light sidebar sticky-top-sidebar">
        <div class="position-sticky pt-3">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">
                <span data-feather="home"></span>
                Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="file"></span>
                Quản lý bài viết
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="shopping-cart"></span>
                Quản lý đơn hàng
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="users"></span>
                Quản lý thành viên
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="bar-chart-2"></span>
                Thống kê
              </a>
            </li>
          </ul>
        </div>
      </nav>
  
      <!-- Nội dung chính -->
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-3">
        <h2>Dashboard</h2>
        <div class="row">
          <!-- Card 1 -->
          <div class="col-md-4">
            <div class="card mb-3">
              <div class="card-body">
                <h5 class="card-title">Bài viết</h5>
                <p class="card-text">Tổng số bài viết: 120</p>
              </div>
            </div>
          </div>
          <!-- Card 2 -->
          <div class="col-md-4">
            <div class="card mb-3">
              <div class="card-body">
                <h5 class="card-title">Đơn hàng</h5>
                <p class="card-text">Đơn hàng mới: 25</p>
              </div>
            </div>
          </div>
          <!-- Card 3 -->
          <div class="col-md-4">
            <div class="card mb-3">
              <div class="card-body">
                <h5 class="card-title">Thành viên</h5>
                <p class="card-text">Tổng số thành viên: 350</p>
              </div>
            </div>
          </div>
        </div>
  
        <!-- Bảng dữ liệu mẫu -->
        <h4>Bảng thông tin</h4>
        <div class="table-responsive">
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th>#</th>
                <th>Tiêu đề</th>
                <th>Loại</th>
                <th>Ngày tạo</th>
                <th>Trạng thái</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>Bài viết mẫu 1</td>
                <td>Tin tức</td>
                <td>20/02/2025</td>
                <td>Hiển thị</td>
              </tr>
              <tr>
                <td>2</td>
                <td>Bài viết mẫu 2</td>
                <td>Sự kiện</td>
                <td>18/02/2025</td>
                <td>Ẩn</td>
              </tr>
              <tr>
                <td>3</td>
                <td>Bài viết mẫu 3</td>
                <td>Tin tức</td>
                <td>15/02/2025</td>
                <td>Hiển thị</td>
              </tr>
            </tbody>
          </table>
        </div>
      </main>
    </div>
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
