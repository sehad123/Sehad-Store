<link rel="stylesheet" href="css/home.css">

<?php
$koneksi = mysqli_connect("localhost", "root", "", "sehaddstore");
$penjualan = mysqli_query($koneksi, "SELECT jumlah FROM kategori order by id_kategori asc");
$merk = mysqli_query($koneksi, "SELECT nama_kategori FROM kategori order by id_kategori asc");

$penjualan1 = mysqli_query($koneksi, "SELECT stok_produk FROM produk order by id_produk asc");
$merk1 = mysqli_query($koneksi, "SELECT nama_produk FROM produk order by id_produk asc");
?>

<h2>Selamat datang Administrator</h2>

<?php
//  print_r($_SESSION); 
include '../koneksi.php';
$ambil = $koneksi->query("SELECT SUM(total_pembelian) as jumlah FROM pembelian WHERE status_pembelian = 'barang sudah sampai'");
$ambil4 = $koneksi->query("SELECT COUNT(total_pembelian) as jml FROM pembelian WHERE status_pembelian = 'barang dikirim'");
$ambil2 = $koneksi->query("SELECT COUNT(*) as total FROM pelanggan");
$ambil3 = $koneksi->query("SELECT COUNT(*) as subtotal FROM produk");
$pecah = $ambil->fetch_assoc();
$pecah2 = $ambil2->fetch_assoc();
$pecah3 = $ambil3->fetch_assoc();
$pecah4 = $ambil4->fetch_assoc();
?>
<div class="container">
  <div class="card">
    <p>
      <span><i class="fa-solid fa-user"></i></span>
      Customers
    </p>
    <h1>
      <?= $pecah2['total']; ?>
    </h1>
  </div>
  <div class="card">
    <p>
      <span><i class="fa-sharp fa-solid fa-box"></i></span>
      Product
    </p>
    <h1>
      <?= $pecah3['subtotal']; ?>
    </h1>
  </div>
  <div class="card">
    <p>
      <span><i class="fa fa-car"></i></span>
      Onprocces
    </p>
    <h1>
      <?= $pecah4['jml']; ?>
    </h1>
  </div>
  <div class="card">
    <p>
      <span><i class="fa-solid fa-sack-dollar"></i></span>
      Income
    </p>
    <h1>Rp
      <?php echo number_format($pecah['jumlah']); ?>
    </h1>
  </div>

</div>
<div class="grafik">
  <h2>Persentase Produk Berdasarkan Kategori</h2>
  <canvas id="piechart" width="100" height="100"></canvas>
</div>
<br><br>
<h2>Jumlah Produk</h2>
<div class="grafik">
  <canvas id="barchart" width="100" height="100"></canvas>
</div>

</main>
<script src="js/Chart.js"></script>
<script type="text/javascript">
  var ctx = document.getElementById("piechart").getContext("2d");
  var data = {
    labels: [<?php while ($p = mysqli_fetch_array($merk)) {
                echo '"' . $p['nama_kategori'] . '",';
              } ?>],
    datasets: [{
      label: "Penjualan Barang",
      data: [<?php while ($p = mysqli_fetch_array($penjualan)) {
                echo '"' . $p['jumlah'] . '",';
              } ?>],
      backgroundColor: [
        '#29B0D0',
        '#2A516E',
        '#F07124',
        '#CBE0E3',
        '#979193'
      ]
    }]
  };

  var myPieChart = new Chart(ctx, {
    type: 'doughnut',
    data: data,
    options: {
      responsive: true
    }
  });

  var ctx = document.getElementById("barchart").getContext("2d");
  var data = {
    labels: [<?php while ($p = mysqli_fetch_array($merk1)) {
                echo '"' . $p['nama_produk'] . '",';
              } ?>],
    datasets: [{
      label: "Penjualan Barang",
      data: [<?php while ($p = mysqli_fetch_array($penjualan1)) {
                echo '"' . $p['stok_produk'] . '",';
              } ?>],
      backgroundColor: [
        '#29B0D0',
        '#2A516E',
        '#F07124',
        '#CBE0E3',
        '#979193'
      ]
    }]
  };

  var myBarChart = new Chart(ctx, {
    type: 'bar',
    data: data,
    options: {
      legend: {
        display: false
      },
      barValueSpacing: 20,
      scales: {
        yAxes: [{
          ticks: {
            min: 0,
          }
        }],
        xAxes: [{
          gridLines: {
            color: "rgba(0, 0, 0, 0)",
          }
        }]
      }
    }
  });
</script>