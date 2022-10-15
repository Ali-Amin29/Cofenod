<?php
// singlton design pattern
class DB
{
    static private $connection;
    private function __construct($database_type, $host, $database_name, $username, $password)
    {
        $db = "$database_type:host=$host;dbname=$database_name";
        DB::$connection = new PDO($db, $username, $password);
    }
    static function connect($database_type, $host, $database_name, $username, $password)
    {
        if (!isset(DB::$connection)) {
            new DB($database_type, $host, $database_name, $username, $password);
        }
        return DB::$connection;
    }
    static public function getAll($table)
    {
        $query = "SELECT * FROM $table";
        $sql =  DB::$connection->prepare($query);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    static public function getOne($table, $id)
    {
        $query = "SELECT * FROM $table WHERE id=$id";
        $sql = DB::$connection->prepare($query);
        $sql->execute();
        return $sql->fetch(PDO::FETCH_ASSOC);
    }
    static public function update($table, $cond, $data)
    {
        $query = "UPDATE $table SET ";
        foreach ($data as $key => $value) {
            $query .= "$key = '$value',";
        }
        // $query = substr($query, 0, strlen($query) - 1);
        $query = rtrim($query, ',');
        $query .= ' WHERE ';
        foreach ($cond as $key => $value) {
            $query .= "$key = '$value'";
        }
        $sql = DB::$connection->prepare($query);
        return $sql->execute();
    }
    static public function create($table, $data)
    {
        $query = "INSERT INTO $table(";
        $col = [];
        $values = [];
        foreach ($data as $key => $value) {
            array_push($col, "`$key`");
            array_push($values, "'$value'");
        }
        $col = implode(',', $col);
        $values = implode(',', $values);
        $query .= "$col) VALUES($values)";
        $sql = DB::$connection->prepare($query);
        return $sql->execute();
    }
    static public function delete($table, $id)
    {
        $query = "DELETE FROM $table WHERE id=$id";
        $sql = DB::$connection->prepare($query);
        return $sql->execute();
    }
}
