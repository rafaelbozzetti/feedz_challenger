<?php

namespace Feedz\Middleware;

use Feedz\Domain\User\Data\UserAuthData;
use Feedz\Domain\User\Service\UserAuth;
use Feedz\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Middleware.
 */
final class UserAuthMiddleware implements MiddlewareInterface
{
    /**
     * @var Responder
     */
    private $responder;

    /**
     * @var Session
     */
    private $session;

    /**
     * @var UserAuth
     */
    private $auth;

    /**
     * The constructor.
     *
     * @param Responder $responder The responder
     * @param Session $session The session
     * @param UserAuth $auth The user auth
     */
    public function __construct(
        Responder $responder,
        Session $session,
        UserAuth $auth
    ) {
        $this->responder = $responder;
        $this->session = $session;
        $this->auth = $auth;
    }

    /**
     * Invoke middleware.
     *
     * @param ServerRequestInterface $request The request
     * @param RequestHandlerInterface $handler The handler
     *
     * @return ResponseInterface The response
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $user = $this->session->get('user');

        if ($user instanceof UserAuthData) {
            // User is logged in
            $this->auth->setUser($user);

            return $handler->handle($request);
        }

        return $this->responder->redirect($this->responder->createResponse(), 'login');
    }
}
