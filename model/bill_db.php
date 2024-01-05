<?php
    function get_bill() {
        global $db;
        $query = 'SELECT * FROM hoadon';
        $statement = $db->prepare($query);
        $statement->execute();
        $bill_list = $statement->fetchAll();
        $statement->closeCursor();
        return $bill_list;
    }

    function get_current_bill_id($customer_id, $total, $order_date, $status) {
        global $db;
        $query = 'SELECT IDHD FROM hoadon
                  WHERE IDKhach = :customer_id AND TongThanhToan = :total AND NgayMua = :order_date AND TinhTrang = :status';
        $statement = $db->prepare($query);
        $statement->bindValue(':customer_id', $customer_id);
        $statement->bindValue(':total', $total);
        $statement->bindValue(':order_date', $order_date);
        $statement->bindValue(':status', $status);
        $statement->execute();
        $bill_id = $statement->fetchAll();
        $statement->closeCursor();
        return $bill_id;
    }

    function add_bill($bill_id, $customer_id, $total, $order_date, $status){
        global $db;
        $query = 'INSERT INTO hoadon (IDHD, IDKhach, TongThanhToan, NgayMua, TinhTrang) VALUES (:bill_id, :customer_id, :total, :order_date, :status)';
        $statement = $db->prepare($query);
        $statement->bindValue(':bill_id', $bill_id);
        $statement->bindValue(':customer_id', $customer_id);
        $statement->bindValue(':total', $total);
        $statement->bindValue(':order_date', $order_date);
        $statement->bindValue(':status', $status);
        $statement->execute();
        $statement->closeCursor();
    }

    function edit_bill($bill_id, $customer_id, $total, $order_date, $status) {
        global $db;
        $query = 'UPDATE hoadon SET IDKhach = :customer_id, TongThanhToan = :total, NgayMua = :order_date, TinhTrang = :status WHERE IDHD = :bill_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':bill_id', $bill_id);
        $statement->bindValue(':customer_id', $customer_id);
        $statement->bindValue(':total', $total);
        $statement->bindValue(':order_date', $order_date);
        $statement->bindValue(':status', $status);
        $statement->execute();
        $statement->closeCursor();
    }

    function delete_bill($bill_id){
        global $db;
        $query = 'DELETE FROM hoadon WHERE IDHD = :bill_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':bill_id', $bill_id);
        $statement->execute();
        $statement->closeCursor();
    }
?>