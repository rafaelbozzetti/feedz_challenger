<?php

namespace Feedz\Domain\User\Repository;

use Feedz\Factory\QueryFactory;

/**
 * Repository.
 */
final class UserAuthRepository
{
    /**
     * @var QueryFactory
     */
    private $queryFactory;

    /**
     * Constructor.
     *
     * @param QueryFactory $queryFactory The query factory
     */
    public function __construct(QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
    }

    /**
     * Find user by email.
     *
     * @param string $email Email
     *
     * @return array The user
     */
    public function findUserByUsername(string $email): array
    {
        $query = $this->queryFactory->newSelect('users');

        $query->select([
            'id',
            'password',
            'email',
        ]);

        $query->andWhere([
            'email' => $email,
        ]);

        $row = $query->execute()->fetch('assoc');

        return $row ?: [];
    }
}
