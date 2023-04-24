<?php 
class Database{

  private $pdo;
  public function __construct() {
   $this->connect("localhost","3306","crudoperations","root","");
  }

  public function connect($host, $port, $database, $username, $password) {
    $dsn = "mysql:host=$host;port=$port;dbname=$database;charset=utf8mb4";
    $this->pdo = new PDO($dsn, $username, $password);
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
    public function insert($table, $columns, $values) {
        $columns_str = implode(',', $columns);
        $placeholders_str = rtrim(str_repeat('?,', count($values)), ',');
        $sql = "INSERT INTO $table ($columns_str) VALUES ($placeholders_str)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($values);
        return $this->pdo->lastInsertId();
      }

      public function select($table) {
        $stmt = $this->pdo->query("SELECT * FROM $table");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }

      public function update($table, $id, $fields) {
        $set_str = implode('=?,', array_keys($fields)).'=?';
        $sql = "UPDATE $table SET $set_str WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array_merge(array_values($fields), [$id]));
        return $stmt->rowCount();
      }

      public function delete($table, $id) {
        $stmt = $this->pdo->prepare("DELETE FROM $table WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->rowCount();
      }

}

?>