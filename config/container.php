<?php

use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Factory\AppFactory;
use Slim\Middleware\ErrorMiddleware;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use Cake\Database\Connection;
use Selective\BasePath\BasePathMiddleware;
use Psr\Http\Message\ResponseFactoryInterface;
use Slim\Interfaces\RouteParserInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Twig\TwigFunction;


return [
    'settings' => function () {
        return require __DIR__ . '/settings.php';
    },

    App::class => function (ContainerInterface $container) {
        AppFactory::setContainer($container);

        return AppFactory::create();
    },

    // For the responder
    ResponseFactoryInterface::class => function (ContainerInterface $container) {
        return $container->get(App::class)->getResponseFactory();
    },

    // The Slim RouterParser
    RouteParserInterface::class => function (ContainerInterface $container) {
        return $container->get(App::class)->getRouteCollector()->getRouteParser();
    },

    Twig::class => function (ContainerInterface $container) {
        $settings = $container->get('settings');
        $twigSettings = $settings['twig'];

        $options = $twigSettings['options'];
        $options['cache'] = $options['cache_enabled'] ? $options['cache_path'] : false;

        $twig = Twig::create($twigSettings['paths'], $options);

        // Add extension here
        // ...

        /** @var FlashBagInterface $flashbag */
        $flashbag = $container->get(Session::class)->getFlashBag();
        $environment = $twig->getEnvironment();
        $environment->addGlobal('flashbag', $flashbag);
        $environment->addFunction(new TwigFunction(
            'flash',
            function (string $key, $default = null) use ($flashbag) {
                return $flashbag->get($key, $default ?? [])[0] ?? null;
            }
        ));
        return $twig;
    },
    
    TwigMiddleware::class => function (ContainerInterface $container) {
        return TwigMiddleware::createFromContainer(
            $container->get(App::class),
            Twig::class
        );
    },    

    PDO::class => function (ContainerInterface $container) {
        $settings = $container->get('settings')['db'];
    
        $host = $settings['host'];
        $dbname = $settings['database'];
        $username = $settings['username'];
        $password = $settings['password'];
        $charset = $settings['charset'];
        $flags = $settings['flags'];
        $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
    
        return new PDO($dsn, $username, $password, $flags);
    },

    Connection::class => function (ContainerInterface $container) {
        return new Connection($container->get('settings')['db']);
    },

    Session::class => function (ContainerInterface $container) {
        $settings = $container->get('settings')['session'];

        if (PHP_SAPI === 'cli') {
            return new Session(new MockArraySessionStorage());
        } else {
            return new Session(new NativeSessionStorage($settings));
        }
    },

    SessionInterface::class => function (ContainerInterface $container) {
        return $container->get(Session::class);
    },

    BasePathMiddleware::class => function (ContainerInterface $container) {
        $app = $container->get(App::class);

        return new BasePathMiddleware($app);
    },

    ErrorMiddleware::class => function (ContainerInterface $container) {
        $app = $container->get(App::class);
        $settings = $container->get('settings')['error'];

        return new ErrorMiddleware(
            $app->getCallableResolver(),
            $app->getResponseFactory(),
            (bool)$settings['display_error_details'],
            (bool)$settings['log_errors'],
            (bool)$settings['log_error_details']
        );
    },    


];