<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ScuoleController
{

  public function allSchools(Request $request, Response $response, $args){
    sleep(3);
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $result = $mysqli_connection->query("SELECT * FROM scuole");
    $results = $result->fetch_all(MYSQLI_ASSOC);

    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }
  
  public function singleSchool(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $result = $mysqli_connection->query("SELECT * FROM scuole WHERE id = ".$args['scuola_id']);
    $results = $result->fetch_all(MYSQLI_ASSOC);

    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }
  
  public function createSchool(Request $request, Response $response, $args){
    $body = json_decode($request->getBody()->getContents(), true);
    $nome = $body["nome"];
    $indirizzo = $body["indirizzo"]; 
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $creation = $mysqli_connection->query("INSERT INTO `scuole`(`nome`, `indirizzo`) VALUES ('$nome','$indirizzo')");

    $response->getBody()->write("created");
    return $response->withHeader("Content-type", "application/json")->withStatus(201);
  }

  public function updateSchool(Request $request, Response $response, $args){
    $body = json_decode($request->getBody()->getContents(), true);
    $nome = $body["nome"];
    $indirizzo = $body["indirizzo"]; 
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $creation = $mysqli_connection->query("UPDATE `scuole` SET `nome`='$nome',`indirizzo`='$indirizzo' WHERE id = $args[scuola_id]");

    $response->getBody()->write("updated");
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  public function deleteSchool(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $result = $mysqli_connection->query("DELETE FROM `scuole` WHERE id = $args[scuola_id]");

    $response->getBody()->write("deleted");
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  public function filterSchool(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $result = $mysqli_connection->query("SELECT * FROM `scuole` WHERE (nome LIKE '%$args[txt]%' OR indirizzo LIKE '%$args[txt]%')");
    $results = $result->fetch_all(MYSQLI_ASSOC);

    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

}
