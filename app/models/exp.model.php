<?php

Class ExpModel {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_holidays;charset=utf8', 'root', '');
    }

   public function getAll($orderBy, $order, $limit, $page, $column, $filtervalue){
       
        $params = []; //creo el array
        // if($orderBy){
        //     $queryStr .= "LIMIT :limit  OFFSET :offset";
        //     $params["limit"] = $limit;
        //     $params["offset"] = $offset;

        $query_sentence = "SELECT * FROM experience ";
        
        if($column != null){
            //aca tengo que ver si el $filter
            $query_sentence .= " WHERE  $column = ?";
            array_push($params, $filtervalue);
        }

        if($orderBy != null){
            $query_sentence .= "ORDER BY $orderBy";
            //array_push($params, $orderBy); no va
        }
        if($order != null){
            $query_sentence .= " $order";
           // array_push($params, $order); no va
        }
       
        if($page == null){
            $page=0;
        }

        if($limit != null){
            $offset = $page * $limit - $limit;
            $query_sentence .= " LIMIT  $limit OFFSET $offset";
        }



        //var_dump($query_sentence);
        $query = $this->db->prepare($query_sentence);
        $query->execute($params);
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
