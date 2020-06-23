<?php
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {

  $app->get('/',
    \Feedz\Action\HomeAction::class);

  $app->post('/auth',
    \Feedz\Action\AuthAction::class);

    // User
  $app->group('/users', function (RouteCollectorProxy $group) {

    $group->get('',
      \Feedz\Action\User\UsersListAction::class);

    $group->get('{:id}',
      \Feedz\Action\User\UserListAction::class);

    $group->post('',
      \Feedz\Action\User\UserCreateAction::class);

    });

};
