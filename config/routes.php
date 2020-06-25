<?php
use Feedz\Middleware\UserAuthMiddleware;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {

  $app->get('/',
    \Feedz\Action\HomeAction::class);

  $app->post('/auth',
    \Feedz\Action\Auth\LoginSubmitAction::class);

  $app->get('/logout',
    \Feedz\Action\Auth\LogoutAction::class);

  $app->get('/users',
    \Feedz\Action\User\UserListDataTableAction::class)->add(UserAuthMiddleware::class);

  $app->get('/users/add',
    \Feedz\Action\User\UserCreateFormAction::class)->add(UserAuthMiddleware::class);

  $app->post('/users/add',
    \Feedz\Action\User\UserCreateAction::class)->add(UserAuthMiddleware::class);

};
