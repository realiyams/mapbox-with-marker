<?php
  include "connect.php";

  // sql to create table
  $query = "CREATE TABLE IF NOT EXISTS Destinasi(
    id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    lokasi VARCHAR(50) NOT NULL,
    latitude VARCHAR(25) NOT NULL,
    longitude VARCHAR(25) NOT NULL
  )";
  $sql = mysqli_query($connect, $query);

  $query = "INSERT INTO Destinasi(lokasi, latitude, longitude) VALUES('Bandung, Jawa Barat, Indonesia', '-6.934469', '107.604954'), ('Bandung Barat, Jawa Barat, Indonesia', '-6.854814', '107.52404') , ('Parongpong, Bandung Barat, Jawa Barat, Indonesia', '-6.843022', '107.578365')";
  $sql = mysqli_query($connect, $query);
?>