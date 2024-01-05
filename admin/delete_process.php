<?php
    if (isset($_POST['delete_btn']) && isset($_POST['action'])){
        require("../model/connectdb.php");
        require("../model/newsdb.php");
        require("../model/guestdb.php");
        require("../model/identifydb.php");
        require("../model/characterdb.php");

        switch ($_POST['action']){
            case 'taikhoan':
                $email = filter_input(INPUT_POST, "delete_id");
                if (!empty($email)){
                    delete_acc($email);
                    echo "<script>alert('Xóa thành công!'); location.href='table.php?action=taikhoan';</script>";
                } else {
                    echo "<script>alert('Xóa thất bại!'); location.href='table.php?action=taikhoan';</script>";
                }
                break;
            case 'khach':
                $guest_id = filter_input(INPUT_POST, "delete_id");
                if (!empty($guest_id)){
                    delete_guest($guest_id);
                    echo "<script>alert('Xóa thành công!'); location.href='table.php?action=khach';</script>";
                } else {
                    echo "<script>alert('Xóa thất bại!'); location.href='table.php?action=khach';</script>";
                }
                break;
            case 'news':
                $news_id = filter_input(INPUT_POST, "delete_id");
                if (!empty($news_id)){
                    delete_news($news_id);
                    echo "<script>alert('Xóa thành công!'); location.href='table.php?action=news';</script>";
                } else {
                    echo "<script>alert('Xóa thất bại!'); location.href='table.php?action=news';</script>";
                }
                break;
            case 'nhanvat':
                $nv_id = filter_input(INPUT_POST, "delete_id");
                if (!empty($nv_id)){
                    delete_nv($nv_id);
                    echo "<script>alert('Xóa thành công!'); location.href='table.php?action=nhanvat';</script>";
                } else {
                    echo "<script>alert('Xóa thất bại!'); location.href='table.php?action=nhanvat';</script>";
                }
                break;
        }
    }else{
        echo "<script>location.href='index.php';</script>";
    }
?>