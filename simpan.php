<?php
	// connect.php
	include "connect.php";

	// GET DATA FROM index.php
	$lokasi = $_POST['lokasi'];
	$latitude = $_POST['latitude'];
	$longitude = $_POST['longitude'];

	//QUERY SQL
	$query = "INSERT INTO Destinasi(lokasi, latitude, longitude) VALUES('".$lokasi."', '".$latitude."', '".$longitude."')";

  // RUN SQL
	$sql = mysqli_query($connect, $query);
	if($sql){
		// REDIRECT TO index.php
		header("location: index.php"); 
	}else{
		// FAILURE
		echo "<center><h1>Terjadi kesalahan saat mencoba menyimpan data.";
		echo "Halaman akan di redirect kurang dari 10 detik</center></h1>";
		sleep(10);
		header("location: index.php");
	}
?>