<?php
  // Supabase database credentials
  $host = getenv("DB_HOST");
  $username = getenv("DB_USER");
  $password = getenv("DB_PASSWORD");
  $database = getenv("DB_NAME");
  $port = getenv("DB_PORT");

  // Create PostgreSQL connection
  $connection = pg_connect(
      "host=$host port=$port dbname=$database user=$username password=$password"
  );

  // Check connection
  if (!$connection) {
      die("Connection failed.");
  } else {
      // echo "Connected successfully";
  }

/*
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
  }*/
?>