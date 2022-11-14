<?php
require_once './app/models/exp-api.model.php';
require_once './app/views/api.view.php';

class ExpApiController {
    private $model;
    private $view;
    private $body;
    private $limit_default;

    public function __construct() {
        $this->model = new ExpModel();
        $this->view = new ApiView();
        $this->body = file_get_contents("php://input");
        $this->limit_default = 30;
    }

    private function getBody() {
        return json_decode($this->body);
    }

    public function getExps($params = null) {
        try {
            $filtercolumn = $_GET["filtercolumn"] ?? null;
            $filtervalue = $_GET["filtervalue"] ?? null;
            $orderBy = $_GET["orderBy"] ?? "exp_id";
            $order = $_GET["order"] ?? "asc";
            $page =  $_GET["page"] ?? 1;
            $limit = $_GET["limit"] ?? $this->limit_default;

            $exps = 0;

            $this->verifyParams($filtercolumn, $filtervalue, $orderBy, $order, $page, $limit);

            if (($filtercolumn != null) && ($filtervalue != null)) {
                $exps = $this->model->getAllByColumn($orderBy, $order, $limit, $page, $filtercolumn, $filtervalue);
            } elseif ($filtercolumn == null) {
                $exps = $this->model->getAll($orderBy, $order, $page, $limit);
            }
            if ($exps != 0)
                return $this->view->response($exps, 200);
            else
                $this->view->response("There are not experiences", 404);
        } catch (Exception $e) {
            return $this->view->response("Internal Server Error: $e->getMessage()", 500);
        }
    }

    private function verifyParams($filtercolumn, $filtervalue, $orderBy, $order, $page, $limit) {
        $columns = [
            "exp_id", 
            "place", 
            "days", 
            "price", 
            "description", 
            "boat_id"
        ];

        if ($filtercolumn != null && !in_array(strtolower($filtercolumn), $columns)) {
            $this->view->response("Wrong query param filtercolumn: $filtercolumn in GET request", 400);
            die;
        }

        if ($filtercolumn != null && $filtervalue == null) {
            $this->view->response("Wrong or missing param filtervalue in GET request", 400);
            die;
        }

        if ($orderBy != null && !in_array(strtolower($orderBy), $columns)) {
            $this->view->response("Wrong query param orderBy: $orderBy in GET request", 400);
            die;
        }

        if ($order != null && $order != "asc" && $order != "desc") {
            $this->view->response("Wrong query param order in GET request", 400);
            die;
        }

        if ($page != null && (!is_numeric($page) || $page <= 0)) {
            $this->view->response("Wrong query param page in GET request", 400);
            die;
        }

        if ($limit != null && (!is_numeric($limit) || $limit <= 0)) {
            $this->view->response("Wrong query param limit in GET request", 400);
            die;
        }
    }


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

    public function insertExp() {
        $exp = $this->getBody();
        if (empty($exp->place) || empty($exp->days) || empty($exp->boat_id)) {
            $this->view->response("place, days and boat id are required ", 400);
        } else {
            $id = $this->model->insert($exp->place, $exp->days, $exp->price, $exp->description, $exp->boat_id);
            $this->view->response("The experience id = $id has been added", 201);
        }
    }

    public function updateExp($params = null) {
        $exp = $this->getBody();
        $exp_id = $params[':ID'];
        if (empty($exp->place) || empty($exp->days) || empty($exp->price) || empty($exp->description) || empty($exp->boat_id)) {
            $this->view->response("Missing properties in PUT request ", 400);
        } else {
            $id = $this->model->update($exp_id, $exp->place, $exp->days, $exp->price, $exp->description, $exp->boat_id);
            $this->view->response("The experience id = $exp_id has been updated", 200);
        }
    }
}
