<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class DocentiController
{
  public function allDocenti(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $result = $mysqli_connection->query("SELECT * FROM docenti where scuola_id = $args[scuola_id]" );
    $results = $result->fetch_all(MYSQLI_ASSOC);

    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  public function singleDocente(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $result = $mysqli_connection->query("SELECT docenti.* FROM docenti WHERE scuola_id = $args[scuola_id] AND id = $args[id_docente]");
    $results = $result->fetch_all(MYSQLI_ASSOC);

    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  public function createDocente(Request $request, Response $response, $args){
    $body = json_decode($request->getBody()->getContents(), true);
    $nome = $body["nome"];
    $cognome = $body["cognome"];
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $creation = $mysqli_connection->query("INSERT INTO `docenti`(`scuola_id`, `nome`, `cognome`) VALUES ('$args[scuola_id]', '$nome', '$cognome')");

    $response->getBody()->write("created");
    return $response->withHeader("Content-type", "application/json")->withStatus(201);
  }

  public function updateDocente(Request $request, Response $response, $args){
    $body = json_decode($request->getBody()->getContents(), true);
    $nome = $body["nome"];
    $cognome = $body["cognome"];
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $update = $mysqli_connection->query("UPDATE `docenti` SET `nome`='$nome',`cognome`='$cognome' WHERE scuola_id = $args[scuola_id] AND id = $args[id_docente]");

    $response->getBody()->write("updated");
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  public function deleteDocente(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $result = $mysqli_connection->query("DELETE FROM `docenti` WHERE scuola_id = $args[scuola_id] AND id = $args[id_docente]");

    $response->getBody()->write("deleted");
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  public function filterDocenti(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $result = $mysqli_connection->query("SELECT * FROM `scuole` WHERE (nome LIKE '%$args[txt]%' OR cognome LIKE '%$args[txt]%')");
    $results = $result->fetch_all(MYSQLI_ASSOC);

    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

}
