<?php

namespace Feedz\Action\User;

use Feedz\Domain\User\Service\UserCreator;
use Feedz\Responder\Responder;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Action.
 */
final class UserCreateAction
{
    /**
     * @var Responder
     */
    private $responder;

    /**
     * @var UserCreator
     */
    private $userCreator;

    /**
     * @var Session
     */
    private $session;

    /**
     * The constructor.
     *
     * @param Responder $responder The responder
     * @param UserCreator $userCreator The service
     */
    public function __construct(Responder $responder, Session $session, UserCreator $userCreator)
    {
        $this->responder = $responder;
        $this->userCreator = $userCreator;
        $this->session = $session;
    }

    /**
     * Action.
     *
     * > curl -X POST -H "Content-Type: application/json" -d {\"key1\":\"value1\"} http://localhost/users
     *
     * @param ServerRequestInterface $request The request
     * @param ResponseInterface $response The response
     *
     * @return ResponseInterface The response
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $formData = (array)$request->getParsedBody();
        
        // Invoke the Domain with inputs and retain the result
        $userId = $this->userCreator->createUser($formData);
        if(! $userId ) {
            $flash = $this->session->getFlashBag();
            $flash->clear();
            $flash->set('error', 'Usuário existente');
            
            header('Location: /users/add');
            exit;
            //return $this->responder->redirect($response, 'user-add');
        }
        header('Location: /users');
        exit;
    }
}
