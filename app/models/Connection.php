<?php

namespace App\Models;

class Connection
{
    private $connection = null;

    public function __construct()
    {
        try {
            $this->connection = new \PDO(DBDRIVE . ':host=' . DBHOST . ';dbname=' . DBNAME, DBUSER, DBPASS);
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            http_response_code(500);
            throw new \Exception($e->getMessage(), 500);
        }
    }

    public function insert($statement = '', $parameters = [])
    {
        try {
            $this->executeStatement($statement, $parameters);
            return $this->connection->lastInsertId();
        } catch (\Exception $e) {
            http_response_code(500);
            throw new \Exception($e->getMessage(), 500);
        }
    }

    public function select($statement = '', $parameters = [])
    {
        try {
            $stmt = $this->executeStatement($statement, $parameters);
            return $stmt->fetchAll();
        } catch (\Exception $e) {
            http_response_code(500);
            throw new \Exception($e->getMessage(), 500);
        }
    }

    public function update($statement = '', $parameters = [])
    {
        try {
            $this->executeStatement($statement, $parameters);
        } catch (\Exception $e) {
            http_response_code(500);
            throw new \Exception($e->getMessage(), 500);
        }
    }

    public function delete($statement = '', $parameters = [])
    {
        try {
            $this->executeStatement($statement, $parameters);
        } catch (\Exception $e) {
            http_response_code(500);
            throw new \Exception($e->getMessage(), 500);
        }
    }

    private function executeStatement($statement = '', $parameters = [])
    {
        try {
            $stmt = $this->connection->prepare($statement);
            $stmt->execute($parameters);
            return $stmt;
        } catch (\Exception $e) {
            http_response_code(500);
            throw new \Exception($e->getMessage(), 500);
        }
    }
}
