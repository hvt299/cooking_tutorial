<?php
    function get_progress() {
        global $db;
        $query = 'SELECT * FROM tiendo';
        $statement = $db->prepare($query);
        $statement->execute();
        $progress_list = $statement->fetchAll();
        $statement->closeCursor();
        return $progress_list;
    }

    function add_progress($progress_id, $customer_id, $course_id, $start_date){
        global $db;
        $query = 'INSERT INTO tiendo (IDTD, IDKhach, IDKH, NgayBatDau) VALUES (:progress_id, :customer_id, :course_id, :start_date)';
        $statement = $db->prepare($query);
        $statement->bindValue(':progress_id', $progress_id);
        $statement->bindValue(':customer_id', $customer_id);
        $statement->bindValue(':course_id', $course_id);
        $statement->bindValue(':start_date', $start_date);
        $statement->execute();
        $statement->closeCursor();
    }

    function edit_progress($progress_id, $customer_id, $course_id, $start_date) {
        global $db;
        $query = 'UPDATE tiendo SET IDKhach = :customer_id, IDKH = :course_id, NgayBatDau = :start_date WHERE IDTD = :progress_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':progress_id', $progress_id);
        $statement->bindValue(':customer_id', $customer_id);
        $statement->bindValue(':course_id', $course_id);
        $statement->bindValue(':start_date', $start_date);
        $statement->execute();
        $statement->closeCursor();
    }

    function delete_progress($progress_id){
        global $db;
        $query = 'DELETE FROM tiendo WHERE IDTD = :progress_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':progress_id', $progress_id);
        $statement->execute();
        $statement->closeCursor();
    }
?>