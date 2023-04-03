<?php
  require_once 'config.php';

  class Database extends Config {
    // Insert User Into Database
    public function insert($fname, $lname, $email, $phone) {
      $sql = 'INSERT INTO users (first_name, last_name, email, phone) VALUES (:fname, :lname, :email, :phone)';
      $stmt = $this->conn->prepare($sql);
      $stmt->execute([
        'fname' => $fname,
        'lname' => $lname,
        'email' => $email,
        'phone' => $phone
      ]);
      return true;
    }
    //Fetch All Users Form Database
    public function read()
{
    $sql = 'SELECT * FROM users ORDER BY id DESC';
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(); 
    $result = $stmt->fetchAll();
    return $result;
}
// Fetch Singel User From Database
public function readOne($id)
{
  $sql = 'SELECT * FROM users WHERE id = :id';
  $stmt = $this->conn->prepare($sql);
  $stmt->execute(['id' => $id]);
  $result = $stmt->fetch();
  return $result;
}
}

