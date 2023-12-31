<?php
    function get_course() {
        global $db;
        $query = 'SELECT * FROM khoahoc';
        $statement = $db->prepare($query);
        $statement->execute();
        $course_list = $statement->fetchAll();
        $statement->closeCursor();
        return $course_list;
    }

    function get_course_by_id($course_id) {
        global $db;
        $query = 'SELECT * FROM khoahoc
                  WHERE IDKH = :idkh';
        $statement = $db->prepare($query);
        $statement->bindValue(':idkh', $course_id);
        $statement->execute();
        $course = $statement->fetchAll();
        $statement->closeCursor();
        return $course;
    }

    function add_course($course_id, $course_name, $course_author, $course_description, $origin_price, $current_price, $image){
        global $db;
        $query = 'INSERT INTO khoahoc (IDKH, TenKH, TacGiaKH, MoTaKH, GiaGocKH, GiaHienTaiKH, HinhAnhKH) VALUES (:course_id, :course_name, :course_author, :course_description, :origin_price, :current_price, :image)';
        $statement = $db->prepare($query);
        $statement->bindValue(':course_id', $course_id);
        $statement->bindValue(':course_name', $course_name);
        $statement->bindValue(':course_author', $course_author);
        $statement->bindValue(':course_description', $course_description);
        $statement->bindValue(':origin_price', $origin_price);
        $statement->bindValue(':current_price', $current_price);
        $statement->bindValue(':image', $image);
        $statement->execute();
        $statement->closeCursor();
    }

    function edit_course($course_id, $course_name, $course_author, $course_description, $origin_price, $current_price, $image) {
        global $db;
        $query = 'UPDATE khoahoc SET TenKH = :course_name, TacGiaKH = :course_author, MoTaKH = :course_description, GiaGocKH = :origin_price, GiaHienTaiKH = :current_price, HinhAnhKH = :image WHERE IDKH = :course_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':course_id', $course_id);
        $statement->bindValue(':course_name', $course_name);
        $statement->bindValue(':course_author', $course_author);
        $statement->bindValue(':course_description', $course_description);
        $statement->bindValue(':origin_price', $origin_price);
        $statement->bindValue(':current_price', $current_price);
        $statement->bindValue(':image', $image);
        $statement->execute();
        $statement->closeCursor();
    }

    function delete_course($course_id){
        global $db;
        $query = 'DELETE FROM khoahoc WHERE IDKH = :course_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':course_id', $course_id);
        $statement->execute();
        $statement->closeCursor();
    }

    function get_course_number(){
        global $db;
        $query = 'SELECT COUNT(*) AS SoLuongKhoaHoc FROM khoahoc';
        $statement = $db->prepare($query);
        $statement->execute();
        $course_number = $statement->fetchAll();
        $statement->closeCursor();
        return $course_number;
    }

    function get_course_by_name($course_name){
        global $db;
        $query = 'SELECT * FROM khoahoc
                  WHERE TenKH LIKE :tenkh';
        $statement = $db->prepare($query);
        $course_name = '%'.$course_name.'%';
        $statement->bindValue(':tenkh', $course_name);
        $statement->execute();
        $course = $statement->fetchAll();
        $statement->closeCursor();
        return $course;
    }
?>