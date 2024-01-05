<?php
    function get_process() {
        global $db;
        $query = 'SELECT * FROM tiendo';
        $statement = $db->prepare($query);
        $statement->execute();
        $process_list = $statement->fetchAll();
        $statement->closeCursor();
        return $process_list;
    }

    function add_process($process_id, $customer_id, $course_id, $start_date){
        global $db;
        $query = 'INSERT INTO tiendo (IDTD, IDKhach, IDKH, NgayBatDau) VALUES (:process_id, :customer_id, :course_id, :start_date)';
        $statement = $db->prepare($query);
        $statement->bindValue(':process_id', $process_id);
        $statement->bindValue(':customer_id', $customer_id);
        $statement->bindValue(':course_id', $course_id);
        $statement->bindValue(':start_date', $start_date);
        $statement->execute();
        $statement->closeCursor();
    }

    function edit_process($process_id, $customer_id, $course_id, $start_date) {
        global $db;
        $query = 'UPDATE tiendo SET IDKhach = :customer_id, IDKH = :course_id, NgayBatDau = :start_date WHERE IDTD = :process_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':process_id', $process_id);
        $statement->bindValue(':customer_id', $customer_id);
        $statement->bindValue(':course_id', $course_id);
        $statement->bindValue(':start_date', $start_date);
        $statement->execute();
        $statement->closeCursor();
    }

    function delete_process($process_id){
        global $db;
        $query = 'DELETE FROM tiendo WHERE IDTD = :process_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':process_id', $process_id);
        $statement->execute();
        $statement->closeCursor();
    }
?>