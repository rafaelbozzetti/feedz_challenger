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
    private $connection;

    /**
     * Constructor.
     *
     * @param PDO $connection The database connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
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
        $row = [
            'name' => $user['name'],
            'email' => $user['email'],
            'password' => $user['password']
        ];

        $sql = "INSERT INTO users SET 
                name=:name, 
                email=:email, 
                password=:password;";

        $this->connection->prepare($sql)->execute($row);

        return (int)$this->connection->lastInsertId();
    }
}
