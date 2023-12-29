<?php
    if (isset($_POST['signup'])){
        require("model/connect_db.php");
        require("model/identify_db.php");
        require("model/customer_db.php");

        $email = filter_input(INPUT_POST, "email");
        $name = filter_input(INPUT_POST, "username");

        $password = filter_input(INPUT_POST, "password");
        $re_password = filter_input(INPUT_POST, "re-password");

        if (!empty($email) && !empty($name) && !empty($password) && !empty($re_password) && ($password == $re_password)){
            $currentDateTime = date('Y-m-d H:i:s');
            $datetime = DateTime::createFromFormat('Y-m-d H:i:s', $currentDateTime);
            $zone_Asia_Ho_Chi_Minh = new DateTimeZone('Asia/Ho_Chi_Minh');
            $datetime->setTimezone($zone_Asia_Ho_Chi_Minh);
            $created_at = $datetime->format('Y-m-d H:i:s');
            
            add_account($email, $name, $password, "Khách hàng", "", $created_at);
            add_customer("", $name, "", "", "", $email, "");
            echo "<script>alert('Đăng ký thành công!'); location.href='login.php';</script>";
        } else {
            echo "<script>alert('Đăng ký thất bại!'); location.href='login.php';</script>";
        }
    }
?>