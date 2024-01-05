<?php
    if (isset($_POST['delete_btn']) && isset($_POST['action'])){
        require("../model/connect_db.php");
        require("../model/identify_db.php");
        require("../model/customer_db.php");
        require("../model/course_db.php");
        require("../model/rating_db.php");
        require("../model/progress_db.php");
        require("../model/bill_db.php");

        switch ($_POST['action']){
            case 'taikhoan':
                $email = filter_input(INPUT_POST, "delete_id");
                if (!empty($email)){
                    delete_account($email);
                    echo "<script>alert('Xóa thành công!'); location.href='table.php?action=taikhoan';</script>";
                } else {
                    echo "<script>alert('Xóa thất bại!'); location.href='table.php?action=taikhoan';</script>";
                }
                break;
            case 'khach':
                $customer_id = filter_input(INPUT_POST, "delete_id");
                if (!empty($customer_id)){
                    delete_customer($customer_id);
                    echo "<script>alert('Xóa thành công!'); location.href='table.php?action=khach';</script>";
                } else {
                    echo "<script>alert('Xóa thất bại!'); location.href='table.php?action=khach';</script>";
                }
                break;
            case 'khoahoc':
                $course_id = filter_input(INPUT_POST, "delete_id");
                if (!empty($course_id)){
                    delete_course($course_id);
                    echo "<script>alert('Xóa thành công!'); location.href='table.php?action=khoahoc';</script>";
                } else {
                    echo "<script>alert('Xóa thất bại!'); location.href='table.php?action=khoahoc';</script>";
                }
                break;
            case 'hoadon':
                $bill_id = filter_input(INPUT_POST, "delete_id");
                if (!empty($bill_id)){
                    delete_bill($bill_id);
                    echo "<script>alert('Xóa thành công!'); location.href='table.php?action=hoadon';</script>";
                } else {
                    echo "<script>alert('Xóa thất bại!'); location.href='table.php?action=hoadon';</script>";
                }
                break;
            case 'danhgia':
                $rating_id = filter_input(INPUT_POST, "delete_id");
                if (!empty($rating_id)){
                    delete_rating($rating_id);
                    echo "<script>alert('Xóa thành công!'); location.href='table.php?action=danhgia';</script>";
                } else {
                    echo "<script>alert('Xóa thất bại!'); location.href='table.php?action=danhgia';</script>";
                }
                break;
            case 'tiendo':
                $progress_id = filter_input(INPUT_POST, "delete_id");
                if (!empty($progress_id)){
                    delete_progress($progress_id);
                    echo "<script>alert('Xóa thành công!'); location.href='table.php?action=tiendo';</script>";
                } else {
                    echo "<script>alert('Xóa thất bại!'); location.href='table.php?action=tiendo';</script>";
                }
                break;
        }
    }else{
        echo "<script>location.href='index.php';</script>";
    }
?>