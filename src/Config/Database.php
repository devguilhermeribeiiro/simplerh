<?php

namespace App\Config;

use mysqli;

class Database
{
    private $_host;
    private $_dbname;
    private $_user;
    private $_password;
    private $_conn;

    public function __construct()
    {
        $dotenv = file(__DIR__ . '/../../.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $env = [];

        foreach ($dotenv as $line) {
            if (strpos($line, '#') === 0) {
                continue;
            }
            list($key, $value) = explode('=', $line, 2);
            $env[$key] = $value;
            putenv("$key=$value");
        }

        $this->_host = getenv('DB_HOST');
        $this->_dbname = getenv('DB_NAME');
        $this->_user = getenv('DB_USER');
        $this->_password = getenv('DB_PASSWORD');
    }


    public function connect()
    {
        try {
            $this->_conn = new mysqli($this->_host, $this->_user, $this->_password, $this->_dbname);

            if ($this->_conn->connect_error) {
                throw new \Exception("Erro ao conectar ao banco de dados" . $this->_conn->connect_error);
            }

            return $this->_conn;
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }
}
