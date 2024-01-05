<?php
    session_start();
    require("../model/connect_db.php");
    require("../model/identify_db.php");
    require("../model/customer_db.php");
    require("../model/course_db.php");
    require("../model/rating_db.php");
    require("../model/progress_db.php");
    require("../model/bill_db.php");



    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL){
        $action = 'taikhoan';
    }

    $account_list = get_account();
    $customer_list = get_customer();
    $course_list = get_course();
    $rating_list = get_rating_2();
    $bill_list = get_bill();
    $process_list = get_progress();


    if (!isset($_COOKIE['vaitro']) || $_COOKIE['vaitro'] != "Quản lý"){
        echo "<script>alert('Vui lòng đăng nhập với quyền quản lý để tiếp tục!');location.href='../login.php';</script>";
    }else{
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?php echo $_COOKIE['username']; ?> - Tables</title>

    <!-- Custom fonts for this template -->
    <script src="https://kit.fontawesome.com/73d99ea241.js" crossorigin="anonymous"></script>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">CO Admin</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Chức năng chính
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTables"
                    aria-expanded="true" aria-controls="collapseTables">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span>
                </a>
                <div id="collapseTables" class="collapse" aria-labelledby="headingTables" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Danh sách các bảng:</h6>
                        <form action="table.php" method="GET">
                            <a class="collapse-item" href="table.php?action=taikhoan">Tài khoản</a>
                            <a class="collapse-item" href="table.php?action=khach">Khách Hàng</a>
                            <a class="collapse-item" href="table.php?action=khoahoc">Khóa Học</a>
                            <a class="collapse-item" href="table.php?action=hoadon">Hóa Đơn</a>
                            <a class="collapse-item" href="table.php?action=danhgia">Đánh Giá</a>
                            <a class="collapse-item" href="table.php?action=tiendo">Tiến Độ</a>
                        </form>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Chức năng phụ
            </div>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_COOKIE['username']; ?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">
                        <?php
                            switch ($action){
                                case 'taikhoan':
                                    echo "Quản lý tài khoản";
                                    break;
                                case 'khach':
                                    echo "Quản lý khách";
                                    break;
                                case 'khoahoc':
                                    echo "Quản lý khóa học";
                                    break;
                                case 'danhgia';
                                    echo "Quản lý đánh giá";
                                    break;
                                case 'hoadon';
                                    echo "Quản lý hóa đơn";
                                    break;
                                case 'tiendo';
                                    echo "Quản lý tiến độ";
                                    break;
                            }
                        ?>
                    </h1>
                    <p class="mb-4">Trang quản lý các bảng</p>

                    <!-- Add_Modal -->
                    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        <?php
                                            switch ($action){
                                                case 'taikhoan':
                                                    echo "Thêm tài khoản";
                                                    break;
                                                case 'khach':
                                                    echo "Thêm khách";
                                                    break;
                                                case 'khoahoc':
                                                    echo "Thêm khóa học";
                                                    break;
                                                case 'hoadon';
                                                    echo "Thêm hóa đơn";
                                                    break;
                                                case 'danhgia';
                                                    echo "Thêm đánh giá";
                                                    break;
                                                case 'tiendo';
                                                    echo "Thêm tiến độ";
                                                    break;
                                            }
                                        ?>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="add_process.php" method="POST">
                                    <div class="modal-body">
                                        <input type="hidden" name="action" value="<?php echo $action; ?>">
                                        <?php switch ($action):
                                                case "taikhoan": ?>
                                                <!-- Thêm tài khoản -->
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" name="email" class="form-control" placeholder="Nhập email" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Tên</label>
                                                <input type="text" name="username" class="form-control" placeholder="Nhập username" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Vai trò</label>
                                                <input type="text" name="vaitro" class="form-control" placeholder="Nhập vai trò">
                                            </div>
                                            <div class="form-group">
                                                <label>Mật khẩu ứng dụng</label>
                                                <input type="text" name="matkhauungdung" class="form-control" placeholder="Nhập mật khẩu ứng dụng">
                                            </div>
                                            <?php break; ?>

                                            <?php case "khach": ?>
                                                <!-- Thêm khách -->
                                                <div class="form-group">
                                                    <label>Tên người dùng</label>
                                                    <input type="text" name="username" class="form-control" placeholder="Nhập tên người dùng" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Giới tính</label>
                                                    <input type="text" name="gioitinh" class="form-control" placeholder="Nhập giới tính">
                                                </div>
                                                <div class="form-group">
                                                    <label>Ngày Sinh</label>
                                                    <input type="text" name="ngaysinh" class="form-control" placeholder="Nhập ngày sinh">
                                                </div>
                                                <div class="form-group">
                                                    <label>Quê Quán</label>
                                                    <input type="text" name="quequan" class="form-control" placeholder="Nhập quê quán">
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="email" name="email" class="form-control" placeholder="Nhập email" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>SĐT</label>
                                                    <input type="text" name="sdt" class="form-control" placeholder="Nhập số điện thoại">
                                                </div>
                                            <?php break; ?>

                                            <?php case "khoahoc": ?>
                                                <!-- Thêm khóa học -->
                                                <div class="form-group">
                                                    <label>Tên khóa học</label>
                                                    <input type="text" name="tenkhoahoc" class="form-control" placeholder="Nhập tên khóa học" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Tác giả</label>
                                                    <input type="text" name="tacgia" class="form-control" placeholder="Nhập tác giả" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Mô tả</label>
                                                    <input type="text" name="mota" class="form-control" placeholder="Nhập mô tả" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Giá gốc</label>
                                                    <input type="text" name="giagoc" class="form-control" placeholder="Nhập giá gốc" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Giá hiện tại</label>
                                                    <input type="text" name="giahientai" class="form-control" placeholder="Nhập giá hiện tại" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Hình ảnh</label>
                                                    <input type="text" name="hinhanh" class="form-control" placeholder="Nhập đường dẫn hình ảnh" required>
                                                </div>
                                            <?php break; ?>

                                            <?php case "hoadon": ?>
                                                <!-- Thêm hoadon -->
                                                <div class="form-group">
                                                    <label>ID Khách</label>
                                                    <input type="text" name="idk" class="form-control" placeholder="Nhập ID" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Tổng Thanh Toán</label>
                                                    <input type="text" name="tongthanhtoan" class="form-control" placeholder="Nhập Số tiền" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Ngày Mua</label>
                                                    <input type="text" name="ngaymua" class="form-control" placeholder="Nhập ngày mua" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Tình Trạng</label>
                                                    <input type="text" name="tinhtrang" class="form-control" placeholder="Nhập tình trạng" required>
                                                </div>
                                            <?php break; ?>

                                            <?php case "danhgia": ?>
                                                <!-- Thêm đánh giá -->
                                                <div class="form-group">
                                                    <label>ID Khách</label>
                                                    <input type="text" name="idk" class="form-control" placeholder="Nhập ID Khách" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>IDKH</label>
                                                    <input type="text" name="idkh" class="form-control" placeholder="Nhập IDKH" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Nội dung</label>
                                                    <input type="text" name="noidung" class="form-control" placeholder="Nhập nội dung" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Sao đánh giá</label>
                                                    <input type="text" name="saodanhgia" class="form-control" placeholder="Nhập sao đánh giá (1-5)" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Ngày đánh giá</label>
                                                    <input type="text" name="ngaydanhgia" class="form-control" placeholder="Nhập ngày đánh giá" required>
                                                </div>
                                            <?php break; ?>

                                            <?php case "tiendo": ?>
                                                <!-- Thêm tiến độ -->
                                                <div class="form-group">
                                                    <label>ID Khách</label>
                                                    <input type="text" name="idk" class="form-control" placeholder="Nhập ID khách" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>ID Khóa Học</label>
                                                    <input type="text" name="idkh" class="form-control" placeholder="Nhập ID khóa học" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Ngày Bắt Đầu</label>
                                                    <input type="text" name="ngaybatdau" class="form-control" placeholder="Nhập ngày bắt đầu" required>
                                                </div>
                                            <?php break; ?>
                                        <?php endswitch; ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                                        <button type="submit" name="add_btn" class="btn btn-primary">Lưu thay đổi</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Edit_Modal -->
                    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        <?php
                                            switch ($action){
                                                case 'taikhoan':
                                                    echo "Sửa tài khoản";
                                                    break;
                                                case 'khach':
                                                    echo "Sửa khách hàng";
                                                    break;
                                                case 'khoahoc':
                                                    echo "Sửa khóa học";
                                                    break;
                                                case 'hoadon';
                                                    echo "Sửa hóa đơn";
                                                    break;
                                                case 'danhgia';
                                                    echo "Sửa đánh giá";
                                                    break;
                                                case 'tiendo';
                                                    echo "Sửa tiến độ";
                                                    break;
                                            }
                                        ?>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="edit_process.php" method="POST">
                                    <div class="modal-body">
                                        <input type="hidden" name="action" value="<?php echo $action; ?>">
                                        <input type="hidden" name="edit_id" id="edit_id">

                                        <?php switch ($action):
                                                case "taikhoan": ?>
                                                <!-- Sửa tài khoản -->
                                            <div class="form-group">
                                                <label>Tên</label>
                                                <input type="text" name="username" id="value_2" class="form-control" placeholder="Nhập username" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" name="password" id="value_3" class="form-control" placeholder="Nhập mật khẩu" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Vai trò</label>
                                                <input type="text" name="vaitro" id="value_4" class="form-control" placeholder="Nhập vai trò">
                                            </div>
                                            <div class="form-group">
                                                <label>Mật khẩu ứng dụng</label>
                                                <input type="text" name="matkhauungdung" id="value_5" class="form-control" placeholder="Nhập mật khẩu ứng dụng">
                                            </div>
                                            <div class="form-group">
                                                <label>Ngày tạo</label>
                                                <input type="text" name="ngaytao" id="value_6" class="form-control" placeholder="Nhập ngày tạo">
                                            </div>
                                            <?php break; ?>

                                            <?php case "khach": ?>
                                                <!-- Sửa khách -->
                                                <div class="form-group">
                                                    <label>Tên khách</label>
                                                    <input type="text" name="username" id="value_2" class="form-control" placeholder="Nhập tên người dùng" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Giới tính</label>
                                                    <input type="text" name="gioitinh" id="value_3" class="form-control" placeholder="Nhập giới tính">
                                                </div>
                                                <div class="form-group">
                                                    <label>Ngày Sinh</label>
                                                    <input type="text" name="ngaysinh" id="value_4" class="form-control" placeholder="Nhập ngày sinh">
                                                </div>
                                                <div class="form-group">
                                                    <label>Quê Quán</label>
                                                    <input type="text" name="quequan" id="value_5" class="form-control" placeholder="Nhập quê quán">
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="email" name="email" id="value_6" class="form-control" placeholder="Nhập email" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>SĐT</label>
                                                    <input type="text" name="sdt" id="value_7" class="form-control" placeholder="Nhập số điện thoại">
                                                </div>
                                            <?php break; ?>

                                            <?php case "khoahoc": ?>
                                                <!-- Sửa khóa học -->
                                                <div class="form-group">
                                                    <label>Tên khóa học</label>
                                                    <input type="text" name="tenkhoahoc" id="value_2" class="form-control" placeholder="Nhập tên khóa học" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Tác giả</label>
                                                    <input type="text" name="tacgia" id="value_3" class="form-control" placeholder="Nhập tác giả" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Mô tả</label>
                                                    <input type="text" name="mota" id="value_4" class="form-control" placeholder="Nhập mô tả" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Giá gốc</label>
                                                    <input type="text" name="giagoc" id="value_5" class="form-control" placeholder="Nhập giá gốc" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Giá hiện tại</label>
                                                    <input type="text" name="giahientai" id="value_6" class="form-control" placeholder="Nhập giá hiện tại" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Hình ảnh</label>
                                                    <input type="text" name="hinhanh" id="value_7" class="form-control" placeholder="Nhập đường dẫn hình ảnh" required>
                                                </div>
                                            <?php break; ?>

                                            <?php case "hoadon": ?>
                                                <!-- Sửa hoadon -->
                                                <div class="form-group">
                                                    <label>ID Khách</label>
                                                    <input type="text" name="idk" id="value_2" class="form-control" placeholder="Nhập ID" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Tổng Thanh Toán</label>
                                                    <input type="text" name="tongthanhtoan" id="value_3" class="form-control" placeholder="Nhập Số tiền" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Ngày Mua</label>
                                                    <input type="text" name="ngaymua" id="value_4" class="form-control" placeholder="Nhập ngày mua" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Tình Trạng</label>
                                                    <input type="text" name="tinhtrang" id="value_5" class="form-control" placeholder="Nhập tình trạng" required>
                                                </div>
                                            <?php break; ?>

                                            <?php case "danhgia": ?>
                                                <!-- Sửa đánh giá -->
                                                <div class="form-group">
                                                    <label>ID Khách</label>
                                                    <input type="text" name="idk" id="value_2" class="form-control" placeholder="Nhập ID Khách" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>IDKH</label>
                                                    <input type="text" name="idkh" id="value_3" class="form-control" placeholder="Nhập IDKH" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Nội dung</label>
                                                    <input type="text" name="noidung" id="value_4" class="form-control" placeholder="Nhập nội dung" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Sao đánh giá</label>
                                                    <input type="text" name="saodanhgia" id="value_5" class="form-control" placeholder="Nhập sao đánh giá (1-5)" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Ngày đánh giá</label>
                                                    <input type="text" name="ngaydanhgia" id="value_6" class="form-control" placeholder="Nhập ngày đánh giá" required>
                                                </div>
                                            <?php break; ?>
                                            <?php case "tiendo": ?>
                                                <!-- Sửa tiến độ -->
                                                <div class="form-group">
                                                    <label>ID Khách</label>
                                                    <input type="text" name="idk" id="value_2" class="form-control" placeholder="Nhập ID khách" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>ID Khóa Học</label>
                                                    <input type="text" name="idkh" id="value_3" class="form-control" placeholder="Nhập ID khóa học" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Ngày Bắt Đầu</label>
                                                    <input type="text" name="ngaybatdau" id="value_4" class="form-control" placeholder="Nhập ngày bắt đầu" required>
                                                </div>
                                            <?php break; ?>
                                        <?php endswitch; ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                                        <button type="submit" name="edit_btn" class="btn btn-primary">Lưu thay đổi</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Delete_Modal -->
                    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        <?php
                                            switch ($action){
                                                case 'taikhoan':
                                                    echo "Xóa tài khoản";
                                                    break;
                                                case 'khach':
                                                    echo "Xóa người dùng";
                                                    break;
                                                case 'khoahoc':
                                                    echo "Xóa khóa học";
                                                    break;
                                                case 'hoadon';
                                                    echo "Xóa hóa đơn";
                                                    break;
                                                case 'danhgia';
                                                    echo "Xóa đánh giá";
                                                    break;
                                                case 'tiendo';
                                                    echo "Xóa tiến độ";
                                                    break;
                                            }
                                        ?>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="delete_process.php" method="POST">
                                    <div class="modal-body">
                                        <input type="hidden" name="action" value="<?php echo $action; ?>">
                                        <input type="hidden" name="delete_id" id="delete_id">
                                        <?php switch ($action):
                                                case "taikhoan": ?>
                                                <!-- Xóa tài khoản -->
                                                <label>Bạn có muốn xóa tài khoản này không?</label>
                                            <?php break; ?>

                                            <?php case "khach": ?>
                                                <!-- Xóa user -->
                                                <label>Bạn có muốn xóa người dùng này không?</label>
                                            <?php break; ?>

                                            <?php case "khoahoc": ?>
                                                <!-- Xóa khóa học -->
                                                <label>Bạn có muốn xóa khóa học này không?</label>
                                            <?php break; ?>

                                            <?php case "hoadon": ?>
                                                <!-- Xóa hóa đơn -->
                                                <label>Bạn có muốn xóa hóa đơn này không?</label>
                                            <?php break; ?>

                                            <?php case "danhgia": ?>
                                                <!-- Xóa đánh giá -->
                                                <label>Bạn có muốn xóa đánh giá này không?</label>
                                            <?php break; ?>

                                            <?php case "tiendo": ?>
                                                <!-- Xóa tiến độ -->
                                                <label>Bạn có muốn xóa tiến độ này không?</label>
                                            <?php break; ?>
                                        <?php endswitch; ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                                        <button type="submit" data-id="" name="delete_btn" class="btn btn-primary">Lưu thay đổi</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- DataBase table Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">
                                <?php
                                    switch ($action){
                                        case 'taikhoan':
                                            echo "Bảng tài khoản&emsp;";
                                            # Button trigger modal
                                            echo "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#add'>Thêm tài khoản</button>";
                                            break;
                                        case 'khach':
                                            echo "Bảng người dùng&emsp;";
                                            # Button trigger modal
                                            echo "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#add'>Thêm người dùng</button>";
                                            break;
                                        case 'khoahoc':
                                            echo "Bảng khóa học&emsp;";
                                            # Button trigger modal
                                            echo "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#add'>Thêm khóa học</button>";
                                            break;
                                        case 'hoadon';
                                            echo "Bảng hóa đơn&emsp;";
                                            # Button trigger modal
                                            echo "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#add'>Thêm hóa đơn</button>";
                                            break;
                                        case 'danhgia';
                                            echo "Bảng đánh giá&emsp;";
                                            # Button trigger modal
                                            echo "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#add'>Thêm đánh giá</button>";
                                            break;
                                        case 'tiendo';
                                            echo "Bảng tiến độ&emsp;";
                                            # Button trigger modal
                                            echo "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#add'>Thêm tiến độ</button>";
                                            break;
                                    }
                                ?>
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <?php switch ($action):
                                                  case "taikhoan": ?>
                                                  <!-- Bảng tài khoản -->
                                            <th>Email</th>
                                            <th>Tên</th>
                                            <th>Password</th>
                                            <th>Vai Trò</th>
                                            <th>Mật khẩu ứng dụng</th>
                                            <th>Ngày Tạo</th>
                                            <th>Thao Tác</th>
                                            <?php break; ?>

                                            <?php case "khach": ?>
                                                <!-- Bảng khách -->
                                            <th>IDK</th>
                                            <th>Tên người dùng</th>
                                            <th>Giới tính</th>
                                            <th>Ngày Sinh</th>
                                            <th>Quê Quán</th>
                                            <th>Email</th>
                                            <th>SĐT</th>
                                            <th>Thao Tác</th>
                                            <?php break; ?>

                                            <?php case "khoahoc": ?>
                                                <!-- Bảng khóa học -->
                                            <th>IDKH</th>
                                            <th>Tên Khóa Học</th>
                                            <th>Tác Giả KH</th>
                                            <th>Mô Tả KH</th>
                                            <th>Giá Gốc</th>
                                            <th>Giá Hiện Tại</th>
                                            <th>Hình Ảnh</th>
                                            <th>Thao Tác</th>
                                            <?php break; ?>

                                            <?php case "hoadon": ?>
                                                <!-- Bảng hóa đơn -->
                                            <th>IDHD</th>
                                            <th>ID Khách</th>
                                            <th>Tổng Thanh Toán</th>
                                            <th>Ngày Mua</th>
                                            <th>Tình Trạng</th>
                                            <th>Thao Tác</th>
                                            <?php break; ?>

                                            <?php case "danhgia": ?>
                                                <!-- Bảng đánh giá -->
                                            <th>ID Đánh Giá</th>
                                            <th>ID Khách</th>
                                            <th>ID Khóa Học</th>
                                            <th>Nội Dung Đánh Giá</th>
                                            <th>Sao Đánh Giá</th>
                                            <th>Ngày Đánh Giá</th>
                                            <th>Thao Tác</th>
                                            <?php break; ?>

                                            <?php case "tiendo": ?>
                                                <!-- Bảng tiến độ -->
                                            <th>ID Tiến độ</th>
                                            <th>ID Khách</th>
                                            <th>ID Khóa Học</th>
                                            <th>Ngày Bắt Đầu</th>
                                            <th>Thao Tác</th>
                                            <?php break; ?>
                                            <?php endswitch; ?>                                           
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php switch ($action):
                                              case "taikhoan": ?>
                                              <!-- Bảng tài khoản -->
                                        <?php foreach ($account_list as $account): ?>
                                        <tr>
                                            <td><?php echo $account['Email']; ?></td>
                                            <td><?php echo $account['Name']; ?></td>
                                            <td><?php echo $account['Password']; ?></td>
                                            <td><?php echo $account['VaiTro']; ?></td>
                                            <td><?php echo $account['MatKhauUngDung']; ?></td>
                                            <td><?php echo $account['NgayTao']; ?></td>
                                            <td>
                                                <button type="submit" name="edit_btn" class="btn btn-success edit-btn">Sửa</button>
                                                <button type="submit" name="delete_btn" class="btn btn-danger delete-btn">Xóa</button>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php break; ?>

                                        <?php case "khach": ?>
                                            <!-- Bảng khách -->
                                        <?php foreach ($customer_list as $customer): ?>
                                        <tr>
                                            <td><?php echo $customer['IDKhach']; ?></td>
                                            <td><?php echo $customer['TenKhach']; ?></td>
                                            <td><?php echo $customer['GioiTinh']; ?></td>
                                            <td><?php echo $customer['NgaySinh']; ?></td>
                                            <td><?php echo $customer['QueQuan']; ?></td>
                                            <td><?php echo $customer['Email']; ?></td>
                                            <td><?php echo $customer['SDT']; ?></td>
                                            <td>
                                                <button type="submit" name="edit_btn" class="btn btn-success edit-btn">Sửa</button>
                                                <button type="submit" name="delete_btn" class="btn btn-danger delete-btn">Xóa</button>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php break; ?>

                                        <?php case "khoahoc": ?>
                                            <!-- Bảng khóa học -->
                                        <?php foreach ($course_list as $course): ?>
                                        <tr>
                                            <td><?php echo $course['IDKH']; ?></td>
                                            <td><?php echo $course['TenKH']; ?></td>
                                            <td><?php echo $course['TacGiaKH']; ?></td>
                                            <td><?php echo $course['MoTaKH']; ?></td>
                                            <td><?php echo $course['GiaGocKH']; ?></td>
                                            <td><?php echo $course['GiaHienTaiKH']; ?></td>
                                            <td><?php echo $course['HinhAnhKH']; ?></td>
                                            <td>
                                                <button type="submit" name="edit_btn" class="btn btn-success edit-btn">Sửa</button>
                                                <button type="submit" name="delete_btn" class="btn btn-danger delete-btn">Xóa</button>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php break; ?>

                                        <?php case "danhgia": ?>
                                            <!-- Bảng đánh giá -->
                                        <?php foreach ($rating_list as $r): ?>
                                        <tr>
                                            <td><?php echo $r['IDDG']; ?></td>                                            
                                            <td><?php echo $r['IDKhach']; ?></td>
                                            <td><?php echo $r['IDKH']; ?></td>
                                            <td><?php echo $r['NoiDungDG']; ?></td>
                                            <td><?php echo $r['SaoDG']; ?></td>
                                            <td><?php echo $r['NgayDG']; ?></td>

                                            <td>
                                                <button type="submit" name="edit_btn" class="btn btn-success edit-btn">Sửa</button>
                                                <button type="submit" name="delete_btn" class="btn btn-danger delete-btn">Xóa</button>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php break; ?>
                                        
                                        <?php case "hoadon": ?>
                                            <!-- Bảng hóa đơn -->
                                        <?php foreach ($bill_list as $bill): ?>
                                        <tr>
                                            <td><?php echo $bill['IDHD']; ?></td>
                                            <td><?php echo $bill['IDKhach']; ?></td>
                                            <td><?php echo $bill['TongThanhToan']; ?></td>
                                            <td><?php echo $bill['NgayMua']; ?></td>
                                            <td><?php echo $bill['TinhTrang']; ?></td>
                                            <td>
                                                <button type="submit" name="edit_btn" class="btn btn-success edit-btn">Sửa</button>
                                                <button type="submit" name="delete_btn" class="btn btn-danger delete-btn">Xóa</button>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php break; ?>

                                        <?php case "tiendo": ?>
                                            <!-- Bảng tiến độ -->
                                        <?php foreach ($process_list as $process): ?>
                                        <tr>
                                            <td><?php echo $process['IDTD']; ?></td>
                                            <td><?php echo $process['IDKhach']; ?></td>
                                            <td><?php echo $process['IDKH']; ?></td>
                                            <td><?php echo $process['NgayBatDau']; ?></td>
                                            <td>
                                                <button type="submit" name="edit_btn" class="btn btn-success edit-btn">Sửa</button>
                                                <button type="submit" name="delete_btn" class="btn btn-danger delete-btn">Xóa</button>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php break; ?>
                                        <?php endswitch; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>&copy; <?php echo date("Y"); ?> Cooking Tutorial.</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bạn có thực sự muốn đăng xuất không?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <!-- <div class="modal-body">Chọn "Logout" để đăng xuất hoặc "Cancel" để hủy bỏ</div> -->
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy bỏ</button>
                    <a class="btn btn-primary" href="../logout.php">Đăng xuất</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    <script>
        $(document).ready(function () {
            $('.edit-btn').on('click', function() {
                $('#edit').modal('show');

                    $tr = $(this).closest('tr');
                    var data = $tr.children("td").map(function() {
                        return $(this).text();
                    }).get();

                    console.log(data);

                    $('#edit_id').val(data[0]);
                    $('#value_2').val(data[1]);
                    $('#value_3').val(data[2]);
                    $('#value_4').val(data[3]);
                    $('#value_5').val(data[4]);
                    $('#value_6').val(data[5]);
                    $('#value_7').val(data[6]);
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $('.delete-btn').on('click', function() {
                $('#delete').modal('show');

                    $tr = $(this).closest('tr');
                    var data = $tr.children("td").map(function() {
                        return $(this).text();
                    }).get();

                    console.log(data);

                    $('#delete_id').val(data[0]);
            });
        });
    </script>

</body>

</html>
<?php } ?>