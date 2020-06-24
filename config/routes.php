<?php
use Feedz\Middleware\UserAuthMiddleware;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {

  $app->get('/',
    \Feedz\Action\HomeAction::class);

  $app->post('/auth',
    \Feedz\Action\Auth\LoginSubmitAction::class);

  $app->get('/users',
    \Feedz\Action\User\UserListDataTableAction::class);

    // User
  // $app->group('/users', function (RouteCollectorProxy $group) {

  //   $group->get('',
  //     \Feedz\Action\User\UserDataTableAction::class);

  //   $group->get('{:id}',
  //     \Feedz\Action\User\UserListAction::class);

  //   $group->post('',
  //     \Feedz\Action\User\UserCreateAction::class);

  //   });

};
