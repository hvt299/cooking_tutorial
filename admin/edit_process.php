<?php
    if (isset($_POST['edit_btn']) && isset($_POST['action'])){
        require("../model/connectdb.php");
        require("../model/newsdb.php");
        require("../model/guestdb.php");
        require("../model/identifydb.php");
        require("../model/characterdb.php");

        switch ($_POST['action']){
            case 'taikhoan':
                $email = filter_input(INPUT_POST, "edit_id");
                $name = filter_input(INPUT_POST, "username");
                $password = filter_input(INPUT_POST, "password");
                $vaitro = filter_input(INPUT_POST, "vaitro");
                $matkhauungdung = filter_input(INPUT_POST, 'matkhauungdung');
        
                if (empty($vaitro)){
                    $vaitro = 'Khách';
                }
        
                if (!empty($name) && !empty($password)){
                    edit_account($email, $name, $password, $vaitro, $matkhauungdung);
                    echo "<script>alert('Sửa thành công!'); location.href='table.php?action=taikhoan';</script>";
                } else {
                    echo "<script>alert('Sửa thất bại!'); location.href='table.php?action=taikhoan';</script>";
                }
                break;
            case 'khach':
                $guest_id = filter_input(INPUT_POST, "edit_id");
                $guest_name = filter_input(INPUT_POST, "username");
                $gender = filter_input(INPUT_POST, 'gioitinh');
                $email = filter_input(INPUT_POST, 'email');
                $phone = filter_input(INPUT_POST, "sdt");
                
                if (!empty($guest_name) && !empty($email)){
                    edit_guest($guest_id, $guest_name, $gender, $email, $phone);
                    echo "<script>alert('Sửa thành công!'); location.href='table.php?action=khach';</script>";
                } else {
                    echo "<script>alert('Sửa thất bại!'); location.href='table.php?action=khach';</script>";
                }
                break;
            case 'news':
                $news_id = filter_input(INPUT_POST, "edit_id");
                $news_name = filter_input(INPUT_POST, "newsname");
                $image = filter_input(INPUT_POST, "hinhanh");
                $news_description = filter_input(INPUT_POST, "mota");
                
                if (!empty($news_name) && !empty($news_description) && !empty($image)){
                    edit_news($news_id, $news_name, $image, $news_description);
                    echo "<script>alert('Sửa thành công!'); location.href='table.php?action=news';</script>";
                } else {
                    echo "<script>alert('Sửa thất bại!'); location.href='table.php?action=news';</script>";
                }
                break;
            case 'nhanvat':
                $nv_id = filter_input(INPUT_POST, "edit_id");
                $nv_name = filter_input(INPUT_POST, "TenNv");
                $nv_description = filter_input(INPUT_POST, "mota");
                $image = filter_input(INPUT_POST, "hinhanh");
                    
                if (!empty($nv_name) && !empty($nv_description) && !empty($image)){
                    edit_nv($nv_id, $nv_name, $nv_description, $image);
                    echo "<script>alert('Sửa thành công!'); location.href='table.php?action=nhanvat';</script>";
                } else {
                    echo "<script>alert('Sửa thất bại!'); location.href='table.php?action=nhanvat';</script>";
                }
                break;
        }
    }else{
        echo "<script>location.href='index.php';</script>";
    }
?>