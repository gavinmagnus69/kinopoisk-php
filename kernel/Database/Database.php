<?php

namespace App\Kernel\Database;

use App\Kernel\Config\ConfigInterface;
use Exception;
use mysqli;

class Database implements DatabaseInterface
{
    //private \PDO $pdo;

    private ConfigInterface $config;

    private mysqli $connection;

    public function __construct(ConfigInterface $config)
    {

        $this->config = $config;

        $this->connect();
        // dd($config);
        // $this->connect();
    }

    public function first(string $table, array $conditions = []): ?array {

        $where = '';

        if(count($conditions) > 0){
            $where = implode(' AND ', array_map(fn ($field) => "$field = ".$conditions[$field], array_keys($conditions)));
        }

        
        $sql = "SELECT * FROM $table WHERE $where LIMIT 1";
        
        dd($sql);

        $result = mysqli_query($this->connection, $sql);

        dd($result);
        return $result;
    }   


    public function insert(string $table, array $data): int|false
    {

        $cls = [];

        $bns = [];

        foreach ($data as $key => $val) {
            array_push($cls, $key);
            array_push($bns, $val);
        }

        $columns = implode(',', $cls);

        $binds = implode(',', array_map(fn ($el) => "'$el'", $bns));

        // dd($columns, $binds)

        $sql = "INSERT INTO $table ($columns) VALUES ($binds)";

        try {
            mysqli_query($this->connection, $sql);
        } catch (Exception $exp) {
            exit("Error while inserting in db $exp");
        }

        // dd($columns, $binds);

        $id = mysqli_insert_id($this->connection);
        // dd($id);

        return $id;

    }

    private function connect()
    {

        //$driver = $this->config->get('database.driver');
        $host = $this->config->get('database.host');
        //$port = $this->config->get('database.port');
        $database = $this->config->get('database.database');
        $username = $this->config->get('database.username');
        $password = $this->config->get('database.password');
        //$charset = $this->config->get('database.charset');
        try {
            $this->connection = mysqli_connect($host, $username, $password, $database);
        } catch (Exception $exception) {
            exit("Database connection failed {$exception->getMessage()}");
        }

        //$this->pdo = new \PDO("$driver:host=$host;port=$port;dbname=$database;charset=$charset", $username, $password);

    }
}
