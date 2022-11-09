<?php

//para evitar inyeccion SQL

$params = []; //creo el array
if($pagina){
    $queryStr .= "LIMIT ? OFFSET ?";// .= concatena
    array_push($params, 20);
    array_push($params, $pagina);

    $query = $pdo-> prepare ($queryStr);
    $query->excecute($params);

}


otra forma:

    $params = []; //creo el array
if($pagina){
    $queryStr .= "LIMIT :limit  OFFSET :offset";
    $params["limit"] = $limit;
    $params["offset"] = $offset;
    $query = $pdo-> prepare ($queryStr);
    $query->excecute($params);