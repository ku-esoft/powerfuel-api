<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Selective\BasePath\BasePathMiddleware;
use Slim\Factory\AppFactory;

$app = AppFactory::create();

// get all outlets
$app->get('/outlets', function (Request $request, Response $response) {
  $sql = "SELECT * FROM outlets";

  try {
    $db   = new DB();
    $conn = $db->connect();

    $stmt = $conn->query($sql);
    $data = $stmt->fetchAll(PDO::FETCH_OBJ);
    $db   = null;

    $response->getBody()->write(json_encode($data));
    return $response
      ->withHeader('content-type', 'application/json')
      ->withStatus(200);
  } catch (PDOException $e) {
    $error = array(
      "message" => $e->getMessage()
    );

    $response->getBody()->write(json_encode($error));
    return $response
      ->withHeader('content-type', 'application/json')
      ->withStatus(500);
  }
})->setName('getAllOutlets');

// get single outlet
$app->get('/outlets/{id}', function (Request $request, Response $response, array $args) {
  $id = $args['id'];

  $sql = "SELECT * FROM outlets WHERE id = $id";

  try {
    $db   = new DB();
    $conn = $db->connect();

    $stmt = $conn->query($sql);
    $data = $stmt->fetch(PDO::FETCH_OBJ);
    $db   = null;

    $response->getBody()->write(json_encode($data));
    return $response
      ->withHeader('content-type', 'application/json')
      ->withStatus(200);
  } catch (PDOException $e) {
    $error = array(
      "message" => $e->getMessage()
    );

    $response->getBody()->write(json_encode($error));
    return $response
      ->withHeader('content-type', 'application/json')
      ->withStatus(500);
  }
})->setName('getSingleOutlet');
