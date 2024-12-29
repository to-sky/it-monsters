<?php

declare(strict_types=1);

namespace Core;

use PDO;

class Database
{
    private static $instance = null;

    private $connection;
    private $statement;

    /**
     * Database constructor.
     * @param array $config
     */
    private function __construct(array $config)
    {
        $dsn = "mysql:host={$config['database']['host']};dbname={$config['database']['dbname']}";

        $this->connection = new PDO($dsn, $config['database']['username'], $config['database']['password'], [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ]);
    }

    /**
     * @param null $config
     * @return Database|null
     * @throws \Exception
     */
    public static function getInstance($config = null): ?Database
    {
        if (self::$instance === null) {
            if ($config === null) {
                throw new \Exception('Database configuration is required.');
            }
            self::$instance = new self($config);
        }

        return self::$instance;
    }

    /**
     * @param $query
     * @param array $params
     * @return $this
     */
    public function query($query, $params = []): static
    {
        $this->statement = $this->connection->prepare($query);

        $this->statement->execute($params);

        return $this;
    }

    /**
     * Get single row
     * @return mixed
     */
    public function get(): mixed
    {
        return $this->statement->fetch();
    }

    /**
     * Get all data
     * @return mixed
     */
    public function all(): mixed
    {
        return $this->statement->fetchAll();
    }
}