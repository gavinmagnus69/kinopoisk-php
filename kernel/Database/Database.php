<?php

namespace App\Kernel\Database;

use App\Kernel\Config\ConfigInterface;
use mysqli;

class Database implements DatabaseInterface {


    //private \PDO $pdo;

    private ConfigInterface $config;

    public function __construct(ConfigInterface $config)
    {

        $this->config = $config;
        dd($config);
        $this->connect();
    }

    public function insert(string $table, array $data): int|false
    {
        if($table == "mom"){
            return false;
        }

        return 0;

    }

    private function connect() {

        //$driver = $this->config->get('database.driver');
        $host = $this->config->get('database.host');
        //$port = $this->config->get('database.port');
        $database = $this->config->get('database.database');
        $username = $this->config->get('database.username');
        $password = $this->config->get('database.password');
        //$charset = $this->config->get('database.charset');

        $conn = mysqli_connect($host, $username, $password, $database);

        if($conn){
            echo "suck";
        } else {
            echo 'could not connect';
        }
        //$this->pdo = new \PDO("$driver:host=$host;port=$port;dbname=$database;charset=$charset", $username, $password);

    }


};



?>