<?php
  $host = "localhost";
  $username = "root";
  $password = "mysql";
  $database = "ecommerce_secondchange";

  // creating database connection
  $connection = mysqli_connect($host, $username, $password, $database);
  
  // check database connection
  if(!$connection){
    die("Connection Failed: ".mysqli_connect_error());
  } else{
    //echo "Connected Successfully";
  }
?>