<?php

namespace Feedz\Action\User;

use Feedz\Domain\User\Service\UserListDataTable;
use Feedz\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

/**
 * Action.
 */
final class UserListDataTableAction
{
    /**
     * @var Responder
     */
    private $responder;

    /**
     * @var UserListDataTable
     */
    private $userListDataTable;

    private $twig;

    /**
     * The constructor.
     *
     * @param Responder $responder The responder
     * @param UserListDataTable $userListDataTable The service
     */
    public function __construct(Responder $responder, UserListDataTable $userListDataTable, Twig $twig)
    {
        $this->responder = $responder;

        $this->userListDataTable = $userListDataTable;

        $this->twig = $twig;
    }

    /**
     * Action.
     *
     * @param ServerRequestInterface $request The request
     * @param ResponseInterface $response The response
     *
     * @return ResponseInterface The response
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $params = (array)$request->getParsedBody();

        $data = $this->userListDataTable->listAllUsers(array());
        
        return $this->twig->render($response, 'users.twig', $data);
    }
}
