<?php

namespace TorjaPHP\Core;

class Database {
    private $host = DB_HOST;
    private $dbname = DB_NAME;
    private $user = DB_USER;
    private $pass = DB_PASS;

    private $dbh;
    private $stmt;
    private $error;

    protected function connect() {
        $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname . ";charset=utf8";

        $options = [
            \PDO::ATTR_PERSISTENT => TRUE,
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
        ];

        try {
            $this->dbh = new \PDO($dsn, $this->user, $this->pass, $options);
        } catch (\PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    protected function prepare($sql) {
        $this->stmt = $this->dbh->prepare($sql);
    }

    protected function bind($param, $value, $type = NULL) {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = \PDO::PARAM_INT;
                break;
                case is_null($value):
                    $type = \PDO::PARAM_NULL;
                break;
                case is_bool($value):
                    $type = \PDO::PARAM_BOOL;
                break;
                default:
                    $type = \PDO::PARAM_STR;
            }
        }

        return $this->stmt->bindValue($param, $value, $type);
    }

    protected function execute() {
        return $this->stmt->execute();
    }

    protected function all() {
        return $this->execute() ? $this->stmt->fetchAll() : NULL;
    }

    protected function single() {
        return $this->execute() ? $this->stmt->fetch() : NULL;
    }
}