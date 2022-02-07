<?php

class DbConnect
{
    private string $host = "127.0.0.1:3306";
    private string $user = "root";
    private string $pwd = "password";
    private string $dbName = "collectorapp";

    protected function connect(): PDO
    {
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;
        $pdo = new PDO($dsn, $this->user, $this->pwd);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    }
}

class Bottles extends DbConnect
{
    protected function getBottles()
    {
        $sql = "SELECT * FROM `bottles`";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll();
        return $results;
    }
}

class BottlesView extends Bottles
{
    public function showBottles()
    {
        $results = $this->getBottles();
        return $results;
    }

}