<?php

Class ExpModel {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_holidays;charset=utf8', 'root', '');
    }


    public function getAll($orderBy, $order, $page, $limit){
        $offset = $page * $limit - $limit;
        $query = "SELECT * FROM experience ORDER BY $orderBy $order LIMIT $limit OFFSET $offset";
        $querydb = $this->db->prepare($query);
        $querydb->execute();
        $exps = $querydb->fetchAll(PDO::FETCH_OBJ); 
        return $exps;
    }

    public function getAllByColumn ($orderBy, $order, $limit, $page, $filtercolumn, $filtervalue){
        $offset = $page * $limit - $limit;
        $params = []; 
        $query = "SELECT * FROM experience WHERE $filtercolumn = ? ORDER BY $orderBy $order LIMIT $limit OFFSET $offset";
        array_push($params, $filtervalue);
        $querydb = $this->db->prepare($query);
        $querydb->execute($params);
        $exps = $querydb->fetchAll(PDO::FETCH_OBJ); 
        return $exps;
    }

    public function getExpById($id) {
        if($id != null){
            $query = $this->db->prepare("SELECT * FROM experience WHERE exp_id = ?");
            $query->execute([$id]);
            $exp = $query->fetch(PDO::FETCH_OBJ); 
            return $exp;
        }
    }
  
    public function insert($place, $days, $price, $description, $boat_id) {
        $query = $this->db->prepare("INSERT INTO experience (place, days, price, description, boat_id) VALUES (?, ?, ?, ?, ?)");
        $query->execute([$place, $days, $price, $description, $boat_id]);
        return $this->db->lastInsertId();
    }

    public function delete($id) {
        $query = $this->db->prepare('DELETE FROM experience WHERE exp_id = ?');
        $query->execute([$id]);
    }

    public function update($id, $place, $days, $price, $description, $boat_id){
        $query = $this->db->prepare("UPDATE experience SET place =?, days =?, price =?, description =?, boat_id =? 
        WHERE exp_id = ?");
        $query->execute([$place, $days, $price, $description, $boat_id, $id]);
    }


}
