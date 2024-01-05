<?php
    if (isset($_POST['add_btn']) && isset($_POST['action'])){
        require("../model/connect_db.php");
        require("../model/identify_db.php");
        require("../model/customer_db.php");
        require("../model/course_db.php");
        require("../model/rating_db.php");
        require("../model/progress_db.php");
        require("../model/bill_db.php");
        require("../model/bill_detail_db.php");

        switch ($_POST['action']){
            case 'taikhoan':
                $email = filter_input(INPUT_POST, "email");
                $name = filter_input(INPUT_POST, "username");
                $password = filter_input(INPUT_POST, "password");
                $vaitro = filter_input(INPUT_POST, "vaitro");
                $matkhauungdung = filter_input(INPUT_POST, 'matkhauungdung');
                
                $currentDateTime = date('Y-m-d H:i:s');
                $datetime = DateTime::createFromFormat('Y-m-d H:i:s', $currentDateTime);
                $zone_Asia_Ho_Chi_Minh = new DateTimeZone('Asia/Ho_Chi_Minh');
                $datetime->setTimezone($zone_Asia_Ho_Chi_Minh);
                $ngaytao = $datetime->format('Y-m-d H:i:s');
        
                if (empty($vaitro)){
                    $vaitro = 'Khách';
                }
        
                if (!empty($email) && !empty($name) && !empty($password)){
                    add_account($email, $name, $password, $vaitro, $matkhauungdung, $ngaytao);
                    if ($vaitro == "Khách") add_customer("", $name, "", "", "", $email, "");
                    echo "<script>alert('Thêm thành công!'); location.href='table.php?action=taikhoan';</script>";
                } else {
                    echo "<script>alert('Thêm thất bại!'); location.href='table.php?action=taikhoan';</script>";
                }
                break;
            case 'khach':
                $customer_name = filter_input(INPUT_POST, "username");
                $gender = filter_input(INPUT_POST, 'gioitinh');
                $dob = filter_input(INPUT_POST, "ngaysinh");
                $hometown = filter_input(INPUT_POST, "quequan");
                $email = filter_input(INPUT_POST, 'email');
                $phone = filter_input(INPUT_POST, "sdt");
                
                if (!empty($customer_name) && !empty($email)){
                    add_customer("", $customer_name, $gender, $dob, $hometown, $email, $phone);
                    echo "<script>alert('Thêm thành công!'); location.href='table.php?action=khach';</script>";
                } else {
                    echo "<script>alert('Thêm thất bại!'); location.href='table.php?action=khach';</script>";
                }
                break;
            case 'khoahoc':
                $course_name = filter_input(INPUT_POST, "tenkhoahoc");
                $course_author = filter_input(INPUT_POST, 'tacgia');
                $course_description = filter_input(INPUT_POST, "mota");
                $origin_price = filter_input(INPUT_POST, "giagoc");
                $current_price = filter_input(INPUT_POST, 'giahientai');
                $image = filter_input(INPUT_POST, "hinhanh");
                
                if (!empty($course_name) && !empty($course_author) && !empty($course_description) && !empty($origin_price) && !empty($current_price) && !empty($image)){
                    add_course("", $course_name, $course_author, $course_description, $origin_price, $current_price, $image);
                    echo "<script>alert('Thêm thành công!'); location.href='table.php?action=khoahoc';</script>";
                } else {
                    echo "<script>alert('Thêm thất bại!'); location.href='table.php?action=khoahoc';</script>";
                }
                break;
            case 'hoadon':
                $customer_id = filter_input(INPUT_POST, "idk");
                $total = filter_input(INPUT_POST, "tongthanhtoan");
                $order_date = filter_input(INPUT_POST, "ngaymua");
                $status = filter_input(INPUT_POST, "tinhtrang");

                if (!empty($customer_id) && !empty($total) && !empty($order_date) && !empty($status)){
                    add_bill("", $customer_id, $total, $order_date, $status);
                    echo "<script>alert('Thêm thành công!'); location.href='table.php?action=hoadon';</script>";
                } else {
                    echo "<script>alert('Thêm thất bại!'); location.href='table.php?action=hoadon';</script>";
                }
                break;
            case 'chitiethoadon':
                $bill_id = filter_input(INPUT_POST, "idhd");
                $course_id = filter_input(INPUT_POST, "idkh");

                if (!empty($bill_id) && !empty($course_id)){
                    add_bill_detail("", $bill_id, $course_id);
                    echo "<script>alert('Thêm thành công!'); location.href='table.php?action=chitiethoadon';</script>";
                } else {
                    echo "<script>alert('Thêm thất bại!'); location.href='table.php?action=chitiethoadon';</script>";
                }
                break;
            case 'danhgia':
                $customer_id = filter_input(INPUT_POST, "idk");
                $course_id = filter_input(INPUT_POST, "idkh");
                $review_content = filter_input(INPUT_POST, "noidung");
                $star_rating = filter_input(INPUT_POST, 'saodanhgia');
                $rating_date = filter_input(INPUT_POST, "ngaydanhgia");

                if (!empty($customer_id) && !empty($course_id) && !empty($review_content) && !empty($star_rating) && !empty($rating_date)){
                    add_rating("", $customer_id, $course_id, $review_content, $star_rating, $rating_date);
                    echo "<script>alert('Thêm thành công!'); location.href='table.php?action=danhgia';</script>";
                } else {
                    echo "<script>alert('Thêm thất bại!'); location.href='table.php?action=danhgia';</script>";
                }
                break;
            case 'tiendo':
                    $customer_id = filter_input(INPUT_POST, "idk");
                    $course_id = filter_input(INPUT_POST, "idkh");
                    $start_date = filter_input(INPUT_POST, "ngaybatdau");
                        
                    if (!empty($customer_id) && !empty($course_id) && !empty($start_date)){
                        add_progress("", $customer_id, $course_id, $start_date);
                        echo "<script>alert('Thêm thành công!'); location.href='table.php?action=tiendo';</script>";
                    } else {
                        echo "<script>alert('Thêm thất bại!'); location.href='table.php?action=tiendo';</script>";
                    }
                    break;
        }
    }else{
        echo "<script>location.href='index.php';</script>";
    }
?>