<?php
    function get_rating() {
        global $db;
        $query = 'SELECT khachhang.TenKhach, khoahoc.TenKH, NoiDungDG, SaoDG
                  FROM khachhang, khoahoc, danhgia
                  WHERE khachhang.IDKhach = danhgia.IDKhach AND khoahoc.IDKH = danhgia.IDKH
                  LIMIT 0, 10;';
        $statement = $db->prepare($query);
        $statement->execute();
        $rating_list = $statement->fetchAll();
        $statement->closeCursor();
        return $rating_list;
    }

    function get_rating_2() {
        global $db;
        $query = 'SELECT * FROM danhgia';
        $statement = $db->prepare($query);
        $statement->execute();
        $rating_list = $statement->fetchAll();
        $statement->closeCursor();
        return $rating_list;
    }

    function get_rating_by_course_id($course_id) {
        global $db;
        $query = 'SELECT khachhang.TenKhach, khoahoc.IDKH, khoahoc.TenKH, NoiDungDG, SaoDG, khachhang.IDKhach
                  FROM khachhang, khoahoc, danhgia
                  WHERE khachhang.IDKhach = danhgia.IDKhach AND khoahoc.IDKH = danhgia.IDKH AND danhgia.IDKH = :idkh
                  LIMIT 0, 10;';
        $statement = $db->prepare($query);
        $statement->bindValue(':idkh', $course_id);
        $statement->execute();
        $ratings = $statement->fetchAll();
        $statement->closeCursor();
        return $ratings;
    }

    function get_rating_by_customer_id_course_id($customer_id, $course_id) {
        global $db;
        $query = 'SELECT khachhang.TenKhach, khoahoc.IDKH, khoahoc.TenKH, NoiDungDG, SaoDG, khachhang.IDKhach
                  FROM khachhang, khoahoc, danhgia
                  WHERE khachhang.IDKhach = danhgia.IDKhach AND danhgia.IDKhach = :idkhach AND khoahoc.IDKH = danhgia.IDKH AND danhgia.IDKH = :idkh;';
        $statement = $db->prepare($query);
        $statement->bindValue(':idkhach', $customer_id);
        $statement->bindValue(':idkh', $course_id);
        $statement->execute();
        $my_rating = $statement->fetchAll();
        $statement->closeCursor();
        return $my_rating;
    }

    function add_rating($rating_id, $customer_id, $course_id, $review_content, $star_rating, $rating_date){
        global $db;
        $query = 'INSERT INTO danhgia (IDDG, IDKhach, IDKH, NoiDungDG, SaoDG, NgayDG) VALUES (:rating_id, :customer_id, :course_id, :review_content, :star_rating, :rating_date)';
        $statement = $db->prepare($query);
        $statement->bindValue(':rating_id', $rating_id);
        $statement->bindValue(':customer_id', $customer_id);
        $statement->bindValue(':course_id', $course_id);
        $statement->bindValue(':review_content', $review_content);
        $statement->bindValue(':star_rating', $star_rating);
        $statement->bindValue(':rating_date', $rating_date);
        $statement->execute();
        $statement->closeCursor();
    }

    function get_idrating_by_student_course($customer_id, $course_id) {
        global $db; 
        $query = 'SELECT IDDG FROM danhgia WHERE IDKhach = :customer_id AND IDKH = :course_id';
        $statement = $db->prepare($query);
        $statement->bindParam(':customer_id', $customer_id, PDO::PARAM_INT);
        $statement->bindParam(':course_id', $course_id, PDO::PARAM_INT);
        $statement->execute();
        $idrating = $statement->fetchColumn();
        $statement->closeCursor();
        return $idrating;
    }
    
    function update_rating($rating_id, $review_content, $star_rating) {
        global $db;
        $query = 'UPDATE danhgia
                  SET NoiDungDG = :review_content, SaoDG = :star_rating
                  WHERE IDDG = :rating_id';
        $statement = $db->prepare($query);
        $statement->bindParam(':rating_id', $rating_id, PDO::PARAM_INT);
        $statement->bindParam(':review_content', $review_content);
        $statement->bindParam(':star_rating', $star_rating, PDO::PARAM_INT);
        $result = $statement->execute();
        $statement->closeCursor();
    }

    function edit_rating($rating_id, $customer_id, $course_id, $review_content, $star_rating, $rating_date) {
        global $db;
        $query = 'UPDATE danhgia SET IDKhach = :customer_id, IDKH = :course_id, NoiDungDG = :review_content, SaoDG = :star_rating, NgayDG = :rating_date WHERE IDDG = :rating_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':rating_id', $rating_id);
        $statement->bindValue(':customer_id', $customer_id);
        $statement->bindValue(':course_id', $course_id);
        $statement->bindValue(':review_content', $review_content);
        $statement->bindValue(':star_rating', $star_rating);
        $statement->bindValue(':rating_date', $rating_date);
        $statement->execute();
        $statement->closeCursor();
    }

    function delete_rating($rating_id){
        global $db;
        $query = 'DELETE FROM danhgia WHERE IDDG = :rating_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':rating_id', $rating_id);
        $statement->execute();
        $statement->closeCursor();
    }

    function get_avg_star_rating_by_course_id($course_id) {
        global $db;
        $query = 'SELECT AVG(danhgia.SaoDG) AS avg_star_rating
                  FROM danhgia
                  WHERE IDKH = :idkh
                  GROUP BY danhgia.IDKH;';
        $statement = $db->prepare($query);
        $statement->bindValue(':idkh', $course_id);
        $statement->execute();
        $avg_star_rating = $statement->fetchAll();
        $statement->closeCursor();
        return $avg_star_rating;       
    }

    function get_rating_number(){
        global $db;
        $query = 'SELECT COUNT(*) AS SoLuongDanhGia FROM danhgia';
        $statement = $db->prepare($query);
        $statement->execute();
        $rating_number = $statement->fetchAll();
        $statement->closeCursor();
        return $rating_number;
    }

    function get_avg_star_rating(){
        global $db;
        $query = 'SELECT AVG(SaoDG) AS TiLeDanhGia
                  FROM danhgia';
        $statement = $db->prepare($query);
        $statement->execute();
        $avg_star_rating = $statement->fetchAll();
        $statement->closeCursor();
        return $avg_star_rating;
    }
?>