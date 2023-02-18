<?php
  require __DIR__ . '/vendor/autoload.php'; 

  $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
  $dotenv->load();

  // CONFIG
  $host =  $_ENV['host']; 
  $username = $_ENV['username'];
  $password = $_ENV['password'];
  $database = $_ENV['database'];

  // CONNECT TO MYSQL
  $connect = mysqli_connect($host, $username, $password, $database);
?>
