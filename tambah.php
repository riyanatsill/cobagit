<?php 

require 'function.php';

$penitipan = query ("SELECT * FROM penitipan ORDER BY id ASC");

//cek sudah ditekan atau belum
if( isset($_POST["submit"])) {

	

	if(tambah($_POST) > 0){
		echo " 
		<script>
		alert('berhasil')
		document.location.href = 'index.php?id=$id';
		</script>";

	}else{
		echo " 
		<script>
		alert('gagal')
		</script>";

	}

}

 ?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="assets/styles/style.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Tambah data Hewan</title>
</head>
<body>
	<header>
	
	<header>
 	<div class="jumbotron2">
		
     </div>
   </header>
   <br>
   <br>
    <article id="tambah" class="card2" style="margin-top: 0;">	
	<h1 style="text-align: center; padding-top: 2%; margin-bottom: 2px;">Tambah data hewan</h1>
	<form action="" method="post" enctype="multipart/form-data" style="text-align: center;">
		<ul >
			<li style="list-style: none;">
				<label for="hewan">hewan: </label><br>	
				<input type="text" name="hewan" id="hewan"required>
			</li>
			<li style="list-style: none;">
				<label for="nama">nama: </label><br>
				<input type="text" name="nama" id="nama" required>
			</li>
			<li style="list-style: none;">
				<label for="email"> email: </label><br>
				<input type="text" name="email" id="email"required>
			</li>
		
			<li style="list-style: none;">
				<label for="alamat"> alamat: </label><br>
				<input type="text" name="alamat" id="alamat"required>
			</li>

			<li style="list-style: none;"><br>
				<button type="Submit" name="submit">Submit</button>
			</li>

		</ul>
</form>
	</article>
</body>
</html>