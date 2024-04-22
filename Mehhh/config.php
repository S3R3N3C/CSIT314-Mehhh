<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "realtyrealm";

define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DB', 'realtyrealm');


class DB {
  public $conn;

  function __construct() {
      $this->conn = mysqli_connect(HOST, USER, PASS, DB);
      if (!$this->conn) {
          die("Connection Error: " . mysqli_connect_error());
      }
  }
}
?>