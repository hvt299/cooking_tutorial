<?php
session_start();
require('model/connect_db.php');
require('model/course_db.php');
require('model/bill_db.php');
require('model/bill_detail_db.php');
require('model/progress_db.php');

if (isset($_POST) && !empty($_POST)){
    if (isset($_POST['action'])){
        switch($_POST['action']){
            case 'add':
                if (isset($_POST['course_id'])){
                    $course = get_course_by_id($_POST['course_id']);
                    foreach($course as $c){
                        $course_id = $c['IDKH'];
                    }
                    if (isset($_SESSION['cart_item']) && !empty($_SESSION['cart_item'])){
                        if (isset($_SESSION['cart_item'][$course_id])){
                            echo "<script>alert('Khóa học đã có trong giỏ hàng!'); location.href='cart.php';</script>";
                        }else{
                            $cart_item = array();
                            foreach($course as $c){
                                $cart_item['IDKH'] = $c['IDKH'];
                                $cart_item['TenKH'] = $c['TenKH'];
                                $cart_item['HinhAnhKH'] = $c['HinhAnhKH'];
                                $cart_item['GiaGocKH'] = $c['GiaGocKH'];
                                $cart_item['GiaHienTaiKH'] = $c['GiaHienTaiKH'];
                                $_SESSION['cart_item'][$course_id] = $cart_item;
                                header("Location: cart.php");
                            }
                        }
                    }else{
                        $_SESSION['cart_item'] = array();
                        $cart_item = array();
                        foreach($course as $c){
                            $cart_item['IDKH'] = $c['IDKH'];
                            $cart_item['TenKH'] = $c['TenKH'];
                            $cart_item['HinhAnhKH'] = $c['HinhAnhKH'];
                            $cart_item['GiaGocKH'] = $c['GiaGocKH'];
                            $cart_item['GiaHienTaiKH'] = $c['GiaHienTaiKH'];
                            $_SESSION['cart_item'][$course_id] = $cart_item;
                            header("Location: cart.php");
                        }
                    }
                }
                break;
            case 'delete':
                if (isset($_POST['course_id'])) {
                    $course_id = $_POST['course_id'];
                    if (isset($_SESSION['cart_item'][$course_id])) {
                        unset($_SESSION['cart_item'][$course_id]);
                    }
                    header("Location: cart.php");
                }
                break;
            case 'payment':                
                if (isset($_COOKIE['username'])){
                    // Thêm vào bảng hoadon
                    $total = $_POST['total'];
                    $currentDateTime = date('Y-m-d H:i:s');
                    $datetime = DateTime::createFromFormat('Y-m-d H:i:s', $currentDateTime);
                    $zone_Asia_Ho_Chi_Minh = new DateTimeZone('Asia/Ho_Chi_Minh');
                    $datetime->setTimezone($zone_Asia_Ho_Chi_Minh);
                    $order_date = $datetime->format('Y-m-d H:i:s');
                    add_bill("", $_COOKIE['idkhach'], $total, $order_date, "Đang xử lý");

                    // Thêm vào bảng tiendo
                    foreach ($_SESSION['cart_item'] as $val_cart_item){
                        add_process("", $_COOKIE['idkhach'], $val_cart_item['IDKH'], $order_date);
                    }

                    // Thêm vào bảng chitiethoadon
                    $bill_id = get_current_bill_id($_COOKIE['idkhach'], $total, $order_date, "Đang xử lý");
                    foreach ($bill_id as $id){
                        $bill_id = $id['IDHD'];
                    }
                    foreach ($_SESSION['cart_item'] as $val_cart_item){
                        add_bill_detail("", $bill_id, $val_cart_item['IDKH']);
                    }

                    // Xóa thông tin khóa học trong giỏ hàng
                    unset($_SESSION['cart_item']);
                    echo "<script>alert('Thanh toán thành công!'); location.href='index.php';</script>";
                }else{
                    echo "<script>alert('Vui lòng đăng nhập để thanh toán!'); location.href='login.php';</script>";
                }
                break;
        }
    }
}
?>