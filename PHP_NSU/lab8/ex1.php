<?php
include("mysql_fun.php");
$conn = connect();

$query = "CREATE TABLE notebook (
  id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(50),
  city VARCHAR(50),
  address VARCHAR(50),
  birthday DATE,
  mail VARCHAR(20),
  PRIMARY KEY (id)
);";

$result = mysqli_query($conn, $query)
  or die("Table not created " . mysqli_error($conn));

mysqli_close($conn);