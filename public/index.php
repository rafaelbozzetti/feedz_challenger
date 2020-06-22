<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();


// Routes 

$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Home");
    return $response;
});

$app->post('/auth/login', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Auth");
    return $response;
});


$app->run();