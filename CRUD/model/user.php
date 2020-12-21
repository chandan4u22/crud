<?php

$config_path = str_replace('model','classes',__DIR__);
include_once $config_path . DIRECTORY_SEPARATOR . 'connection.php';
class user{

  private $id;
  private $firstname;
  private $lastname;
  private $email;
  private $password;
  private $connection;

  public function __construct(){
    $this->connection = new Connection();
  }

  public function getId(){
    return $this->id;
  }

  public function setFirstname($firstname){
    $this->firstname = $this->connection->escape($firstname);
  }

  public function getFirstname(){
    return $this->firstname;
  }

  public function setLastname($lastname){
    $this->lastname = $this->connection->escape($lastname);
  }

  public function getLastname(){
    return $this->lastname;
  }

  public function setEmail($email) {
    $this->email = $this->connection->escape($email);
  }

  public function getEmail(){
    return $this->email;
  }

  public function setPassword($password) {
    $this->password = md5($password);
  }

  public function getPassword() {
    return $this->password;
  }

  public function addUser() {
    $sql = "INSERT INTO student SET firstname = '" . $this->firstname . "', lastname = '". $this->lastname ."', email = '". $this->email ."', password = '". $this->password . "'";
    $this->connection->query($sql);
  }

  public function update($id) {
    $sql = "UPDATE student SET ";

    $sql .= " firstname = '" . $this->firstname . "'";

    $sql .= ", lastname = '" . $this->lastname . "'";

    $sql .= ", email = '" . $this->email . "'";

    if ($this->password) {
      $sql .= ", password = '" . $this->password . "'";
    }

    $sql .= " WHERE id = $id ";
    $this->connection->query($sql);
}

  public function delete($id){
    $this->connection->query("DELETE FROM student WHERE id=$id");
  }


  public function getList($filters = []) {
    $sql = "SELECT * FROM student WHERE 1";
    if (isset($filters['firstname'])) {
      $sql .= " AND firstname LIKE '" . $this->connection->escape($filters['firstname']) . "%'";
    }

    $this->connection->query($sql);
    return $this->connection->rows;
  }

  public function getUser($id) {
    $sql = "SELECT * FROM student WHERE id = $id";

    $this->connection->query($sql);
    return $this->connection->row;
  }
}
?>
