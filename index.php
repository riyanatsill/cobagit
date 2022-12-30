<?php
session_start();
if (!isset($_SESSION['username'])){
    $_SESSION['msg'] = 'anda harus login';
    header('Location: login.php');
}
?>

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


<h1>Daftar Hewan yang di titipkan</h1>



<a href="tambah.php">Tambah data Hewan</a>
<br></br>
<form action="" method="get">
	<input type="text" name="search" size="30" autofocus
	placeholder="Masukan keyword pencarian.." autocomplete="off">
	<!-- Autofocus buat user bisa langsung type saat buka halaman, autocomplete off buat matiin history pencarian -->
	<input type="submit" value="Search">
	<a href="logout.php">LOGOUT</a>
	<a href="bar.php">BAR</a>
	<a href="pie.php">PIE</a>
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

	<?php
				$batas = 3; 
				$halaman = $_GET['halaman'] ?? null;

				if(empty($halaman)){
					$posisi = 0; $halaman = 1;
				}else{
					$posisi = ($halaman-1) * $batas;
				}

				if(isset($_GET['search'])){ 
					$search = $_GET['search']; 
					$sql="SELECT * FROM penitipan WHERE hewan LIKE '%$search%' ORDER BY id ASC LIMIT $posisi, $batas"; 
				}else{ 
					$sql="SELECT * FROM penitipan ORDER BY id ASC LIMIT $posisi, $batas";
				}

				$hasil=mysqli_query($conn, $sql); 
				while ($data = mysqli_fetch_array($hasil)) {
			?>
				
			
					<tr>
		<td><?php echo $data['id']; ?></td>
		<td><?php echo  $data['nama']; ?></td>
		<td><?php echo $data['hewan']; ?></td>
		<td><?php echo $data['alamat']; ?></td>
		<td><?php echo  $data['email']; ?></td>
		<td>
			<a href="ubah.php?id=<?= $data["id"]; ?>">Edit data</a> | 
			<a href="hapus.php?id=<?= $data["id"]; ?>" onclick="return confirm('Apakah anda yakin menghapus data ini?');">Hapus data </a>
		</td>
		<?php } ?>
		</tr>
		<?php

			if(isset($_GET['search'])){
				$search= $_GET['search']; 
				$query2="SELECT * FROM penitipan WHERE hewan LIKE '%$search%' ORDER BY id ASC"; 
			}else{ 
				$query2="SELECT * FROM penitipan ORDER BY id ASC";
			}

			$result2 = mysqli_query($conn, $query2); 
			$jmldata = mysqli_num_rows($result2); 
			$jmlhalaman = ceil($jmldata/$batas);
		?>
	

</table>
<br>
<br>
<div>
	<nav>
<ul class="pagination justify-content-center">
<?php 
				for($i=1;$i<=$jmlhalaman; $i++) {
					if ($i != $halaman) { 
						if(isset($_GET['search'])){ 
							$search = $_GET['search'];
							echo "<li class='page-item'><a class='page-link' href='index.php?halaman=$i&search=$search'>
								  $i</a></li>";
						}else{ 
							echo "<li class='page-item'><a class='page-link' href='index.php?halaman=$i'>$i</a></li>";
						}
					} else {
						echo "<li class='page-item active'><a class='page-link' href='#'>$i</a></li>";
					}
				}
			?>
			</ul>
		
			</nav>
  		</div> 
	</div>
</article>
</body>
</html>