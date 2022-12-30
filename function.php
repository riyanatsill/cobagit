<?php
  $host       = "localhost";
  $user       = "root";
  $pass       = "";
  $db         = "petshop";
  $conn    = mysqli_connect($host, $user, $pass, $db);
  
  function query($query){
      global $conn;
      $result= mysqli_query($conn, $query);
      $rows = [];
      while ( $row = mysqli_fetch_assoc($result)){
          $rows[] = $row;
      }
      return $rows;
  }


  function tambah($data) {
  	global $conn;
  	$hewan = htmlspecialchars($data["hewan"]);
  	$nama = htmlspecialchars($data["nama"]);
  	$email = htmlspecialchars($data["email"]);
  	$alamat= htmlspecialchars($data["alamat"]);

  
  	$query = "INSERT INTO penitipan
  				VALUES
  				(' ', '$hewan', '$nama','$email', '$alamat')";
  			mysqli_query($conn, $query);
  	return mysqli_affected_rows($conn);
  
  }


  
  function hapus($id) {
  	global $conn;
  	mysqli_query($conn, "DELETE FROM penitipan WHERE id = $id");
  	return mysqli_affected_rows($conn);
  }
  
	
  function ubah($data){
  global $conn;
  	$id = $data["id"];
  	$hewan = htmlspecialchars($data["hewan"]);
  	$nama = htmlspecialchars($data["nama"]);
	$email = htmlspecialchars($data["email"]);
  	$alamat= htmlspecialchars($data["alamat"]);
  	$query = "UPDATE penitipan SET
  				nama = '$nama',
  	 			email = '$email',
  				hewan = '$hewan',
  				alamat = '$alamat'
  				WHERE id = $id
  				";
  			mysqli_query($conn, $query);
  	return mysqli_affected_rows($conn);
  }
  
  function cari($keyword){
	
  	$query = "SELECT * FROM penitipan
  	WHERE
  	hewan LIKE  '%$keyword%' OR
  	nama LIKE '%$keyword%' OR
  	email LIKE '%$keyword%' OR
  	alamat LIKE  '%$keyword%'
  	";
  	return query($query);
	
  }
  

  ?>