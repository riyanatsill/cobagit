<?php
include('function.php');
$produk = mysqli_query($conn, "SELECT * from penitipan"); //query mengambil data di tabel transaction
while ($row = mysqli_fetch_array($produk)){ //extract data hasil query di baris 3 dan datanya disimpan di variabel row
    $nama_produk[] = $row['hewan'];
    $query = mysqli_query($conn, "SELECT sum(jumlah) AS jumlah FROM penitipan where hewan='".$row['hewan']."'");
    $row = $query->fetch_array();
    $jumlah_produk[] = $row['jumlah'];
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PIE</title>
</head>
<body>

<div class="row">
    <div class="col-12">
        <div>
            <canvas id="chart-area" style="height:40vh; width:70vw; margin:0 auto"></canvas>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById("chart-area").getContext("2d");
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: <?php echo json_encode($nama_produk); ?>,
            datasets: [{
                label: 'Grafik Penjualan',
                data: <?php echo json_encode($jumlah_produk); ?>,
                backgroundColor:['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)'],
                borderColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)'],
                borderWidth: 1
            }]
        },
        option: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
</script>
</body>
</html>