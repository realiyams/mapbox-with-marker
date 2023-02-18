<?php
	// connect.php
	include "connect.php";

	// GET DATA FROM index.php
	$id = $_POST['id'];

	//QUERY SQL
	$query = "DELETE FROM Destinasi WHERE id=". $id ."";

  // RUN SQL
	$sql = mysqli_query($connect, $query);
	if($sql){
		// REDIRECT TO index.php
		header("location: index.php"); 
	}else{
		// FAILURE
		echo "<center><h1>Terjadi kesalahan saat mencoba menghapus data.";
		echo "Halaman akan di redirect kurang dari 10 detik</center></h1>";
		sleep(10);
		header("location: index.php");
	}
?>