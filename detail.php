<?php session_start(); ?>
<?php
include 'koneksi.php';
?>
<?php
// mendapatkan id produk dari URL
$id_produk = $_GET["id"];

// query ambil data
$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk = '$id_produk'");
$detail = $ambil->fetch_assoc();
// echo "<pre><br><br><br><br><br>";
// print_r($detail);
// echo"</pre>";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/detail.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <title>Sehad Store</title>
</head>
<?php include 'menu.php'; ?>
<br><br><br><br><br>
<section class="konten">
    <div class="container">
        <div class="row">
            <div class="col">
                <img src="foto_barang/<?= $detail['foto_produk']; ?>" alt="" width="500" height="500">
            </div>
            <div class="col">
                <h2>
                    <?= $detail['nama_produk']; ?>
                </h2>
                <h4>Harga : Rp.
                    <?= number_format($detail['harga_produk']); ?>
                </h4>
                <h4>Stok :
                    <?= $detail['stok_produk']; ?>
                </h4>
                <h4>Deskripsi :
                    <?= $detail['deskripsi_produk']; ?>
                </h4>
                <form method="post">
                    <h3 style="text-align:left;"> Ingin beli berapa ? </h3>
                    <input type="number" min="1" name="jumlah" class="form-control" max="<?= $detail['stok_produk'] ?>"
                        required>
                    <button name="beli">Buy Now</button>
                </form>
                <?php
                // jika ada tombol beli
                if (isset($_POST['beli'])) { // mendapatkan jumllah yang diinputkan
                    $jumlah = $_POST['jumlah'];
                    // masukkan ke keranjang belanja
                    $_SESSION['keranjang'][$id_produk] = $jumlah;
                    echo "<script> alert('produk telah masuk ke keranjang belanja');</script>";
                    echo "<script> location='keranjang.php';</script>";
                }
                ?>
            </div>
        </div>
    </div>
</section>

</body>

</html>