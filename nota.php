<?php
session_start();
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/nota.css">
    <link rel="stylesheet" type="text/css" href="css/nota2.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <title>Sehad Store</title>
</head>
<style>
    table th {
        padding: 10px 55px;
    }
</style>

<body>
    <?php include 'menu.php'; ?>
    <section class="konten">
        <div class="container">
            <br><br><br><br>
            <h2>Detail Pembelian</h2>
            <?php
            $ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan 
ON pembelian.id_pelanggan=pelanggan.id_pelanggan
WHERE pembelian.id_pembelian='$_GET[id]'");
            $detail = $ambil->fetch_assoc();
            ?>
            <div class="row">
                <div class="col">
                    <h3>Pembelian</h3>
                    No. pembelian:
                    <?= $detail['id_pembelian']; ?></Strong><br>
                    Tanggal :
                    <?php echo date("d F Y", strtotime($detail['tanggal_pembelian'])); ?> <br>
                    Total : Rp.
                    <?= number_format($detail['total_pembelian']); ?>

                </div>
                <div class="col">
                    <h3>Pelanggan</h3>
                    Nama :
                    <?php echo $detail['nama_pelanggan']; ?></strong>
                    <br>
                    No telp/WA :
                    <?php echo $detail['telepon_pelanggan']; ?> <br>
                    Email :
                    <?php echo $detail['email_pelanggan']; ?>

                </div>
                <div class="col">
                    <h3>Data Pengirimnan</h3>
                    Alamat :
                    <?= $detail['tipe']; ?>
                    <?= $detail['distrik']; ?>
                    <?= $detail['provinsi']; ?></strong> <br>
                    Ongkos pengiriman : Rp.
                    <?= number_format($detail['ongkir']); ?> <br>
                    Ekspedisi :
                    <?= $detail['ekspedisi']; ?>
                    <?= $detail['paket']; ?>
                    <?= $detail['estimasi']; ?> <br>
                </div>
            </div>
            <br>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Berat</th>
                        <th>Jumlah</th>
                        <th>Sub berat</th>
                        <th>Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
                    $ambil2 = $koneksi->query("SELECT * FROM pembelian WHERE id_pelanggan='$id_pelanggan'");
                    $nomor = 1;
                    $pecah2 = $ambil2->fetch_assoc(); ?>

                    <?php $ambil = $koneksi->query("SELECT * FROM pembelian_produk WHERE id_pembelian ='$_GET[id]'"); ?>
                    <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                        <tr>
                            <td>
                                <?= $nomor; ?>
                            </td>
                            <td>
                                <?= $pecah['nama']; ?>
                            </td>
                            <td> RP.
                                <?= number_format($pecah['harga']); ?>
                            </td>
                            <td>
                                <?= $pecah['berat']; ?> Gram
                            </td>
                            <td>
                                <?= $pecah['jumlah']; ?>
                            </td>
                            <td>
                                <?= $pecah['subberat']; ?> Gram
                            </td>
                            <td> Rp.
                                <?= number_format($pecah['subharga']); ?>
                            </td>
                        </tr>
                        <?php $nomor++; ?>
                    <?php } ?>
                </tbody>
            </table>
            <div class="col">
                <div class="bayar">
                    <br>
                    <p> Silahkan melakukan pembayaran Rp. <b>
                            <?php echo number_format($detail['total_pembelian']); ?>
                        </b> ke <br> </p>
                    <ul>
                        <li> BANK MANDIRI 123-45678-321 AN. SETYA HADI NUGROHO </li>
                        <li> BANK BCA 123-45678-321 AN. SETYA HADI NUGROHO </li>
                        <li> BANK BRI 123-45678-321 AN. SETYA HADI NUGROHO </li>
                        <li> BANK BNI 123-45678-321 AN. SETYA HADI NUGROHO </li>
                        <li> BANK DANAMON 123-45678-321 AN. SETYA HADI NUGROHO </li>
                    </ul>
                </div>
            </div>
            <a href="riwayat.php" class="input">
                Bayar Sekarang
            </a>
        </div>
    </section>

    <footer>
        <a href="https://www.facebook.com"><i class="fab fa-facebook"></i></a>
        <a href="https://www.youtube.com/@sehadofficial2233"><i class="fab fa-youtube"></i></a>
        <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
        <p>Copyright &copy; <span id="date"></span> - Setya Hadi Nugroho all right reserved <a href="mailto:222112358@stis.ac.id">(222112358@stis.ac.id)</a></p>
    </footer>
</body>

</html>