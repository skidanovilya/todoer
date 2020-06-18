<?php 

namespace TorjaPHP\Core;

class Model extends Database{
    private $table;
    
    public function __construct() {
        $this->connect();

        $class_name = get_class($this);
        $class_name = \explode("\\", $class_name);
        $class_name = $class_name[count($class_name) - 1];
        $class_name = mb_strtolower($class_name);

        $this->table = $class_name . "s";
    }

    public function get($id = NULL) {
        $sql = "SELECT * FROM " . $this->table;
        if (!is_null($id)) {
            $sql .= " WHERE id = :id";
        }

        $this->prepare($sql);

        if (!is_null($id)) {
            $this->bind(":id", $id, \PDO::PARAM_INT);
        }

        return !is_null($id) ? $this->single() : $this->all();
    }

    public function insert($data) {
        $params = array_keys($data);

        $sql = "INSERT INTO " . $this->table . " (" . implode(",", $params) . ")";
        $sql .= " VALUES (" . implode(",", array_map(function($p) {return ":" . $p;}, $params)) .  ")";

        $this->prepare($sql);
        foreach ($data as $key => $value) {
            $this->bind(":" . $key, $value);
        }

        return $this->execute();
    }

    public function delete($id) {
        $sql = "DELETE FROM " . $this->table . " WHERE id = :id";

        $this->prepare($sql);

        $this->bind(":id", $id, \PDO::PARAM_INT);

        return $this->execute();
    }

    public function update($id, $column, $value) {
        $sql = "UPDATE " . $this->table . " SET $column = :value WHERE id = :id";

        $this->prepare($sql);

        $this->bind(":value", $value);
        $this->bind(":id", $id, \PDO::PARAM_INT);

        return $this->execute();
    } 

    public function count() {
        $sql = "SELECT COUNT(*) as count FROM " . $this->table;

        $this->prepare($sql);

        return $this->single()->count;
    }

    public function search($serach_by, $value, $single = FALSE) {
        $sql = "SELECT * FROM " . $this->table . " WHERE $serach_by = :value";

        $this->prepare($sql);

        $this->bind(":value", $value, \PDO::PARAM_STR);

        return $single ? $this->single() : $this->all();
    }
}