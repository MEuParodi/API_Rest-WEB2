<?php
require_once './app/models/exp.model.php';
require_once './app/views/api.view.php';

class ExpApiController {
    private $model;
    private $view;

    private $body;

    public function __construct() {
        $this->model = new ExpModel();
        $this->view = new ApiView();
        
        // lee el body del request
        $this->body = file_get_contents("php://input");
    }

    private function getBody() {
        return json_decode($this->body);
    }

    public function getExps($params = null){
        // aca podria hacer un for recorriendo todas las columnas de la tabla
            $orderBy = $_GET["orderBy"] ?? null;
            $order = $_GET["order"] ?? null;
            $limit = $_GET["limit"] ?? null;
            $page =  $_GET["page"] ?? null;
            $column =  $_GET["column"] ?? null;  // ?column=nombre&filterval=nico  ?nombre=nico
            $filtervalue = $_GET["filtervalue"] ?? null;
            $columns = [
                "id" => "id",
                "place" => "place",
                "days" => "days",
                "price" => "price",
                "description" => "description",
                "boat_id" => "boat_id"
            ];
            foreach ($_GET as $key => $value) {
                if(in_array(strtolower($key), $columns)){
                    $column = $columns[strtolower ($key)];
                    $filtervalue = $value;
                }
            }
            $exps = $this->model->getAll($orderBy, $order, $limit, $page, $column, $filtervalue);

        if($exps)
            return $this->view->response($exps, 200);
        else
            $this->view->response("There are not experiences", 404);
     }

    //http://localhost/Web2/TPE-2/api/experiencies/52
    public function getExpById($params = null) {
        $id = $params[':ID'];
        $exp = $this->model->getExpById($id);
        if ($exp)
            $this->view->response($exp);
        else 
            $this->view->response("The experience id=$id does not exist", 404);
    }

    
    public function deleteExp($params = null) {
        $id = $params[':ID'];
        $exp = $this->model->getExpById($id);
        if ($exp) {
            $this->model->delete($id);
            $this->view->response($exp);
        } else 
            $this->view->response("The experience id=$id does not exist", 404);
    }


    public function insertExp($params = null) {
        $exp = $this->getBody();

        if (empty($exp->place) || empty($exp->days) || empty($exp->boat_id)) {
            $this->view->response("place, days and boat id are required ", 400);
        } else {
            $id = $this->model->insert($exp->place, $exp->days, $exp->price, $exp->description, $exp->boat_id);
            $this->view->response("The experience id = $id has been added", 201);
        }
    }
    
}