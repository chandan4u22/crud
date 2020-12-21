<?php

$config_path = str_replace('classes','config', __DIR__);
include_once $config_path . DIRECTORY_SEPARATOR . 'config.php';
class Connection{
  public $connection;
  public $rows = [];
  public $row;

  public function __construct(){
    $this->connection = new \mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD, DB_DATABASE,DB_PORT);
  }
  public function query($sql){
    $result = $this->connection->query($sql);
// echo "<pre>"; print_r(gettype($result)); echo "</pre>"; die;
    if (gettype($result) != 'boolean') {
      while ($row = $result->fetch_assoc()) {
        $this->rows[] = $row;
      }

      $this->row = isset($this->rows[0]) ? $this->rows[0]: [];
    }

    return $result;
  }
  public function escape($string) {
    return $this->connection->real_escape_string($string);
  }

  public function __destruct(){
    $this->connection->close();
  }

  public function rows() {

  }
}

 ?>
