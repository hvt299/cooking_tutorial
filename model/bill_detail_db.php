<?php
    function get_bill_detail() {
        global $db;
        $query = 'SELECT * FROM chitiethoadon';
        $statement = $db->prepare($query);
        $statement->execute();
        $bill_detail_list = $statement->fetchAll();
        $statement->closeCursor();
        return $bill_detail_list;
    }

    function add_bill_detail($bill_detail_id, $bill_id, $course_id){
        global $db;
        $query = 'INSERT INTO chitiethoadon (IDCTHD, IDHD, IDKH) VALUES (:bill_detail_id, :bill_id, :course_id)';
        $statement = $db->prepare($query);
        $statement->bindValue(':bill_detail_id', $bill_detail_id);
        $statement->bindValue(':bill_id', $bill_id);
        $statement->bindValue(':course_id', $course_id);
        $statement->execute();
        $statement->closeCursor();
    }

    function edit_bill_detail($bill_detail_id, $bill_id, $course_id) {
        global $db;
        $query = 'UPDATE chitiethoadon SET IDHD = :bill_id, IDKH = :course_id WHERE IDCTHD = :bill_detail_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':bill_detail_id', $bill_detail_id);
        $statement->bindValue(':bill_id', $bill_id);
        $statement->bindValue(':course_id', $course_id);
        $statement->execute();
        $statement->closeCursor();
    }

    function delete_bill_detail($bill_detail_id){
        global $db;
        $query = 'DELETE FROM chitiethoadon WHERE IDCTHD = :bill_detail_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':bill_detail_id', $bill_detail_id);
        $statement->execute();
        $statement->closeCursor();
    }
?>