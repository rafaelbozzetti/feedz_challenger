<?php

namespace Feedz\Domain\User\Service;

use Feedz\Domain\User\Repository\UserListDataTableRepository;

/**
 * Service.
 */
final class UserListDataTable
{
    /**
     * @var UserListDataTableRepository
     */
    private $repository;

    /**
     * Constructor.
     *
     * @param UserListDataTableRepository $repository The repository
     */
    public function __construct(UserListDataTableRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * List all users.
     *
     * @param array $params The parameters
     *
     * @return array The result
     */
    public function listAllUsers(array $params): array
    {
        return $this->repository->getTableData($params);
    }
}
