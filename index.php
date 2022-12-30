<?php 

require 'function.php';

$penitipan = query ("SELECT * FROM penitipan ORDER BY id ASC");
//Tombol cari ditekan
if( isset($_POST["cari"])) {

	$penitipan = cari($_POST["keyword"]);
}

					
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="assets/styles/style.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Halaman Admin</title>
</head>
<body>
<header style="text-align: center;">
<header>
 	<div class="jumbotron2">
		
     </div>
   </header>
   <article class="card" style="text-align: center;">


<h1>Daftar Hewan Penitipan Hewan</h1>



<a href="tambah.php">Tambah data Hewan</a>
<br></br>
<form action="" method="post">
	<input type="text" name="keyword" size="30" autofocus
	placeholder="Masukan keyword pencarian.." autocomplete="off">
	<!-- Autofocus buat user bisa langsung type saat buka halaman, autocomplete off buat matiin history pencarian -->
	<button type="submit" name="cari">Cari</button>

</form>
<br></br>
<div class="table-responsive">
<table class="table" border="1" cellspacing="0" cellpadding="10" style="margin: auto;">
	<tr>
		<th>No</th>
		<th>Nama </th>
		<th>Hewan</th>
		<th>Alamat</th>
		<th>Email</th>
		<th>Aksi</th>
	</tr>

	 <?php $batas = 4;
		$halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
		$halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;	
 		$previous = $halaman - 1;
		$next = $halaman + 1;
		$penitipan= mysqli_query($conn, "select * from penitipan");
		$jumlah_data = mysqli_num_rows($penitipan);
		$total_halaman = ceil($jumlah_data / $batas);
		$penitipan = mysqli_query($conn,"select * from penitipan limit $halaman_awal, $batas");
		$nomor = $halaman_awal+1;
		while($row= mysqli_fetch_array($penitipan)){
					?>
					<tr>
		<td><?php echo $nomor++; ?></td>
		<td><?php echo  $row['nama']; ?></td>
		<td><?php echo $row['hewan']; ?></td>
		<td><?php echo $row['alamat']; ?></td>
		<td><?php echo  $row['email']; ?></td>
		<td>
			<a href="ubah.php?id=<?= $row["id"]; ?>">Edit data</a> | 
			<a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('Apakah anda yakin menghapus data ini?');">Hapus data </a>
		</td>

	</tr>
	
	<?php
				}
				?>

</table>
<br>
<br>
<div>
	<nav>
<ul class="pagination justify-content-center">
				<li class="page-item">
					<a class="page-link" <?php if($halaman > 1){ echo "href='?halaman=$previous'"; } ?>>Previous</a>
				</li>
				<?php 
				for($x=1;$x<=$total_halaman;$x++){
					?> 
					<li class="page-item"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
					<?php
				}
				?>				
				<li class="page-item">
					<a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?halaman=$next'"; } ?>>Next</a>
				</li>
			</ul>
			</nav>
  		</div> 
	</div>
</article>
</body>
</html>