<?php
session_start();
include 'koneksi.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/riwayat.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <title>Sehad Store</title>
</head>

<body>
    <?php include 'menu.php'; ?>
    <br><br><br><br><br><br>
    <section class="riwayat">
        <div class="container">
            <h3>Riwayat Belanja
                <?= $_SESSION["pelanggan"]["nama_pelanggan"] ?>
            </h3>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // mendapatkan id pelanggan yang login dari session
                    $nomor = 1;
                    $id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
                    $ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pelanggan='$id_pelanggan'");
                    while ($pecah = $ambil->fetch_assoc()) {
                        ?>
                        <tr>
                            <td>
                                <?= $nomor; ?>
                            </td>
                            <td>
                                <?= date("d F Y", strtotime($pecah['tanggal_pembelian'])); ?>
                            </td>
                            <td>
                                <?= $pecah['status_pembelian']; ?> <br> <br>
                                <?php if (!empty($pecah['resi_pengiriman'])): ?>
                                    Resi :
                                    <?= $pecah['resi_pengiriman']; ?>
                                <?php endif ?>
                            </td>
                            <td>Rp.
                                <?= number_format($pecah['total_pembelian']); ?>
                            </td>
                            <td>
                                <a href="nota.php?id=<?= $pecah['id_pembelian']; ?>" class="nota">Nota</a>
                                <?php if ($pecah['status_pembelian'] == "pending"): ?>
                                    <a href="pembayaran.php?id=<?= $pecah['id_pembelian']; ?>" class="input">
                                        Input Pembayaran
                                    </a>
                                <?php else: ?>
                                    <a href="lihat_pembayaran.php?id=<?= $pecah['id_pembelian']; ?>" class="lihat">
                                        Lihat Pembayaran
                                    </a>
                                <?php endif ?>
                            </td>
                        </tr>
                        <?php $nomor++; ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </section>
</body>

</html>