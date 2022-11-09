<?php

Class ExpModel {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_holidays;charset=utf8', 'root', '');
    }

   public function getAll($orderBy, $order, $limit, $page){
       // $offset = $page * $limit - $limit;
        // $params = []; //creo el array
        // if($orderBy){
        //     $queryStr .= "LIMIT :limit  OFFSET :offset";
        //     $params["limit"] = $limit;
        //     $params["offset"] = $offset;

        $query_sentence = "SELECT * FROM experience ";
        //ordena datos sin paginar
        if($orderBy != null && $order != null && $limit == null && $page == null){
            $query_sentence = "SELECT * FROM experience ORDER BY $orderBy $order";
        }
        //ordena y pagina
        if($orderBy != null && $order != null && $page != null && $limit != null){
            $query_sentence = "SELECT * FROM experience ORDER BY $orderBy $order LIMIT $limit OFFSET $offset";
        }
        //Pagina datos sin ordenar
        if($orderBy == null && $order == null && $page != null && $limit != null){
            $query_sentence = "SELECT * FROM experience  LIMIT $limit OFFSET $offset";
        }
        $query = $this->db->prepare($query_sentence);
        $query->execute();
        $exps = $query->fetchAll(PDO::FETCH_OBJ); 
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

    //ver esta funcion seria para listar por cualquier columna ver si no se puede modificar la de arriba y hacer 1 sola
    public function GetByCodition ($column, $value) {
        $query = $this->db->prepare("SELECT * FROM experience WHERE $column = ?");
        $query->execute([$value]);
        $exps = $query->fetchAll(PDO::FETCH_OBJ); 
        return $exps;
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
