<?php
    function get_customer() {
        global $db;
        $query = 'SELECT * FROM khachhang';
        $statement = $db->prepare($query);
        $statement->execute();
        $customer_list = $statement->fetchAll();
        $statement->closeCursor();
        return $customer_list;
    }

    function get_customer_by_id($current_customer_id) {
        global $db;
    
        try {
            $query = 'SELECT * FROM khachhang WHERE IDKhach = :current_customer_id';
            $statement = $db->prepare($query);
            $statement->bindParam(':current_customer_id', $current_customer_id, PDO::PARAM_INT);
            $statement->execute();
            $customer = $statement->fetch(PDO::FETCH_ASSOC);
            $statement->closeCursor();
            return $customer;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return;
        }
    }

    function add_customer($customer_id, $customer_name, $gender, $dob, $hometown, $email, $phone) {
        global $db;
        $query = 'INSERT INTO khachhang
                     (IDKhach, TenKhach, GioiTinh, NgaySinh, QueQuan, Email, SDT)
                  VALUES
                     (:customer_id, :customer_name, :gender, :dob, :hometown, :email, :phone)';
        $statement = $db->prepare($query);
        $statement->bindValue(':customer_id', $customer_id);
        $statement->bindValue(':customer_name', $customer_name);
        $statement->bindValue(':gender', $gender);
        $statement->bindValue(':dob', $dob);
        $statement->bindValue(':hometown', $hometown);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':phone', $phone);
        $result = $statement->execute();
        $statement->closeCursor();
        // if false throw error
        if(!$result) throw new ErrorException("Can not insert data");
        return $result;
    }

    function edit_customer($customer_id, $customer_name, $gender, $dob, $hometown, $email, $phone) {
        global $db;
        try{
            $query = 'UPDATE khachhang SET TenKhach = :customer_name, GioiTinh = :gender, NgaySinh = :dob, QueQuan = :hometown, Email = :email, SDT = :phone WHERE IDKhach = :customer_id';
            $statement = $db->prepare($query);
            $statement->bindValue(':customer_id', $customer_id, PDO::PARAM_INT);
            $statement->bindValue(':customer_name', $customer_name, PDO::PARAM_STR);
            $statement->bindValue(':gender', $gender, PDO::PARAM_STR);
            $statement->bindValue(':dob', $dob, PDO::PARAM_STR);
            $statement->bindValue(':hometown', $hometown, PDO::PARAM_STR);
            $statement->bindValue(':email', $email, PDO::PARAM_STR);
            $statement->bindValue(':phone', $phone, PDO::PARAM_STR);
            $result = $statement->execute();
            $statement->closeCursor();
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            return;
        }
    }

    function delete_customer($customer_id){
        global $db;
        $query = 'DELETE FROM khachhang WHERE IDKhach = :customer_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':customer_id', $customer_id);
        $statement->execute();
        $statement->closeCursor();
    }

    function get_customer_number(){
        global $db;
        $query = 'SELECT COUNT(*) AS SoLuongKhachHang FROM khachhang';
        $statement = $db->prepare($query);
        $statement->execute();
        $customer_number = $statement->fetchAll();
        $statement->closeCursor();
        return $customer_number;
    }

    function has_number($current_customer_id, $course_id) {
        global $db;
    
        $query = 'SELECT COUNT(*) AS SoLuongDanhGia FROM danhgia WHERE IDKhach = :current_customer_id and IDKH = :course_id';
        $statement = $db->prepare($query);
        $statement->bindParam(':current_customer_id', $current_customer_id, PDO::PARAM_INT);
        $statement->bindParam(':course_id', $course_id, PDO::PARAM_INT);
        $statement->execute();
        $number_comment = $statement->fetchColumn();  
        return $number_comment == 0;
    }
?>