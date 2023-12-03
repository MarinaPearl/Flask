<?php
function connect($servername = "localhost", $username = "root", $password = "Malina3114", $dbname = "sample")
{
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  if (!$conn) {
    die("Ошибка подключения: " . mysqli_connect_error());
  }
  return $conn;
}
