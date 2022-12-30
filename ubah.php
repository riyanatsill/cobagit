<?php 

require 'function.php';

//ambil data di url
$id = $_GET["id"];
//query data penitipan berdasarkan id

$pntp = query("SELECT * FROM penitipan WHERE id = $id")[0];
$penitipan = query ("SELECT * FROM penitipan WHERE id = '$id'");

//cek sudah ditekan atau belum
if( isset($_POST["submit"])) {
//cek apakah data berhasil diubah atau tidak
	if(ubah($_POST) > 0){
		echo " 
		<script>
		alert('berhasil diubah')
		document.location.href = 'ubah.php?id=$id';
		</script>";

	}else{
		echo " 
		<script>
		alert('gagal diubah')
		</script>";

	}

}
if( isset($_POST["back"])) {
	echo "
	<script>
	document.location.href ='index.php?id=$id';
	</script>";
}

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Ubah data penitipan</title>
	<link rel="stylesheet" href="assets/styles/style.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<header>
 	<div class="jumbotron2">
		
     </div>
   </header>
   <aside style="float: left;margin-top: 5%; width: 30%; ">
   <div class="card2" style="width: 60%; text-align: center;">
	<?php foreach ($penitipan as $data) : ?>
		
		
		<p style="text-align: left; margin-left: 15%;">hewan:  
 		  <?= $data["hewan"]; ?></p>
 		  <p style="text-align: left; margin-left: 15%;">nama:  
 		  <?= $data["nama"]; ?></p>
 		  <p style="text-align: left; margin-left: 15%;">alamat:  
 		  <?= $data["alamat"]; ?></p>
 		  <p style="text-align: left; margin-left: 15%;">email:  
 		  <?= $data["email"]; ?></p>
 		  
	<?php endforeach; ?>
	
				 </div>
				 </aside>
				 <div class="card2" style="margin-top: 5%; text-align: center;">
	<h1>Ubah data hewan</h1>
	<form action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?= $pntp["id"]; ?>">
		
		<ul style="list-style: none; margin-right: 40%; text-align: right;" >
			
			<li>
				<label for="hewan">hewan: </label>
				<input style="resize: horizontal; width: 100px; height: 30px; margin-bottom: 10px; border: none; box-shadow: inset 0px 0px 2px rgba(0,0,0,0.2);" type="text" name="hewan" id="hewan" required value="<?= $pntp["hewan"];?>">
			</li>
			<li>
				<label for="nama"> nama: </label>
				<input style="resize: horizontal; width: 100px; height: 30px; margin-bottom: 10px; border: none; box-shadow: inset 0px 0px 2px rgba(0,0,0,0.2);" type="text" name="nama" id="nama"required value="<?= $pntp["nama"];?>">
			</li>
			<li>
				<label for="email">email: </label>
				<input style="resize: horizontal; width: 100px; height: 30px; margin-bottom: 10px; border: none; box-shadow: inset 0px 0px 2px rgba(0,0,0,0.2);" type="text" name="email" id="email"required value="<?= $pntp["email"];?>">
			</li>
			<li>
				<label for="alamat"> alamat: </label>
				<input style="resize: horizontal; width: 100px; height: 30px; margin-bottom: 10px; border: none; box-shadow: inset 0px 0px 2px rgba(0,0,0,0.2);" type="text" name="alamat" id="alamat"required value="<?= $pntp["alamat"];?>">
			</li>

				<button type="Submit" name="submit" class="btn">Edit</button>
					<button type="Submit" name="back" class="btn2">Back</button>

		</ul>

	</form>
</div>

</body>
</html>