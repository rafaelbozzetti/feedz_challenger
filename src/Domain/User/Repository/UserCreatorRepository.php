<?php

namespace Feedz\Domain\User\Repository;

use Feedz\Factory\QueryFactory;
use Feedz\Repository\RepositoryInterface;
use Feedz\Repository\TableName;
use Cake\Chronos\Chronos;

/**
 * Repository.
 */
class UserCreatorRepository
{
    /**
     * @var PDO The database connection
     */
    private $queryFactory;

    /**
     * Constructor.
     *
     * @param PDO $connection The database connection
     */
    public function __construct(QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
    }

    /**
     * Insert user row.
     *
     * @param array $user The user
     *
     * @return int The new ID
     */
    public function insertUser(array $user): int
    {

        $password = password_hash($user['password'], PASSWORD_DEFAULT);

        $row = [
            'name' => $user['name'],
            'email' => $user['email'],
            'password' => $password
        ];

        $sql = "INSERT INTO users SET 
                name=:name, 
                email=:email, 
                password=:password;";

        return (int)$this->queryFactory->newInsert(TableName::USERS, $row)->execute()->lastInsertId();
    }
}
