<?php

class DB
{
  private $host     = "localhost";
  private $dbname   = "powerfuel-customer-web";
  private $username = "root";
  private $password = "";

  public function connect()
  {
    $conn_str = "mysql:host=$this->host;dbname=$this->dbname";
    $conn = new PDO($conn_str, $this->username, $this->password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $conn;
  }
}
