<?php
session_start();
include 'koneksi.php';
$id_pembelian = $_GET['id'];

$ambil = $koneksi->query("SELECT * FROM pembayaran
LEFT JOIN pembelian ON pembayaran.id_pembelian=pembelian.id_pembelian
 WHERE pembelian.id_pembelian = '$id_pembelian'");
$detail = $ambil->fetch_assoc();

// jika blm ada data pembayaran
if (empty($detail)) {
    echo "<script> alert('belum ada data pembayaran');</script>";
    echo "<script>location='riwayat.php';</script>";
    exit();
}

//  jika data pembayaran tdk sesuai dengan yang login
if ($_SESSION['pelanggan']['id_pelanggan'] !== $detail['id_pelanggan']) {
    echo "<script> alert('anda tidak berhak ,melihat pembayaran orang lain');</script>";
    echo "<script>location='riwayat.php';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/pembayaran.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <title>Sehad Store</title>
</head>

<body>
    <?php include 'menu.php'; ?>
    <div class="container">
        <br><br><br><br>
        <h3>Detail Pembayaran</h3>
        <div class="row">
            <div class="col">
                <table>
                    <tr>
                        <th>Nama</th>
                        <td>
                            <?= $detail['nama'] ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Bank</th>
                        <td>
                            <?= $detail['bank'] ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td>
                    <?php echo date("d F Y", strtotime($detail['tanggal_pembelian'])); ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Jumlah</th>
                        <td>
                            <?= number_format($detail['jumlah']) ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Bukti Transfer</th>
                        <td>
                            <img src="foto_bukti_transfer/<?= $detail['bukti'] ?>" alt="" width="150" height="150">
                        </td>
                    </tr>
                </table>
            </div>

        </div>
    </div>

</body>

</html>