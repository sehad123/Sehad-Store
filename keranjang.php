<?php
session_start();

include 'koneksi.php';
if (empty($_SESSION['keranjang']) or !isset($_SESSION['keranjang'])) {
    echo "<script>alert('silahkan berbelanja terlebih dahulu'); </script>";
    echo "<script>location='rubik.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/keranjang.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <title>Sehad Store</title>
</head>

<body>

    <?php include 'menu.php'; ?>

    <section class="konten">
        <div class="container">
            <h1 style="color:black;">Keranjang Belanja</h1>
            <hr>
            <table>
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Nama_produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Sub_harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nomor = 1; ?>
                    <?php foreach ($_SESSION['keranjang'] as $id_produk => $jumlah): ?>
                        <!-- menampilkan produk berdasarkan id produk -->
                        <?php
                        $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
                        $pecah = $ambil->fetch_assoc();
                        $subHarga = ($pecah['harga_produk']) * $jumlah;
                        ?>

                        <tr>
                            <td>
                                <?= $nomor; ?>
                            </td>
                            <td>
                                <?= $pecah['nama_produk']; ?>
                            </td>
                            <td>
                                <?= number_format($pecah['harga_produk']); ?>
                            </td>
                            <td>
                                <?= $jumlah; ?>
                            </td>
                            <td>
                                <?= number_format($subHarga); ?>
                            </td>
                            <td>
                                <a href="hapuskeranjang.php?id=<?= $id_produk ?>">Hapus</a>
                            </td>
                        </tr>
                        <?php $nomor++; ?>
                    <?php endforeach ?>
                </tbody>
            </table>
            <a href="rubik.php" class="lanjut">Lanjutkan belanja</a>
            <a href="checkout.php" class="cek">Checkout</a>
        </div>
    </section>