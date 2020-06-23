<?php
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App;

return function (App $app) {

    $app->get('/', \Feedz\Action\HomeAction::class);

    $app->post('/auth', \Feedz\Action\AuthAction::class);

};