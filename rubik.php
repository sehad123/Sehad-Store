<?php
session_start();
// koneksi database
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/produk.css">
    <link rel="stylesheet" type="text/css" href="css/produk2.css">
    <link rel="stylesheet" type="text/css" href="css/produk3.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <title>Sehad Store | Rubik </title>
</head>

<body>
    <?php include 'menu.php'; ?>
    <!-- Service -->
    <div class="container" style="margin-top: 78.4px;" id="accessories">
        <h2>OUR PRODUCT</h2>
        <form action="#" method="post" id="forms">
            <input type="text" name="keyword" autofocus placeholder="masukkan pencarian..." autocomplete="off"
                id="keyword">
            <img src="img/loader.gif" alt="" width="140">
        </form>
        </form>
        <br> <br>
        <ul id="container">
            <?php $ambil = $koneksi->query("SELECT * FROM produk WHERE id_kategori='1' AND stok_produk > '0'"); ?>
            <?php while ($perProduk = $ambil->fetch_assoc()) { ?>
                <li class="col-4">
                    <h4>
                        <?= $perProduk['nama_produk']; ?>
                    </h4>
                    <div class="prd"><img src="foto_barang/<?= $perProduk['foto_produk']; ?>" alt=""></div>
                    <h4>
                        <?= $perProduk['nama_produk']; ?>
                    </h4>
                    <p>Rp
                        <?= number_format($perProduk['harga_produk']); ?>,00
                    </p>
                    <span>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star satu"></i>
                    </span>
                    <br>
                    <a href="beli.php?id=<?= $perProduk['id_produk']; ?>" class="beli">Buy Now</a>
                    <a href="detail.php?id=<?= $perProduk['id_produk']; ?>" class="detail">Detail</a>
                </li>
            <?php } ?>

        </ul>
    </div>

    <!-- Footer -->
    <footer>
        <a href="https://www.facebook.com"><i class="fab fa-facebook"></i></a>
        <a href="https://www.youtube.com/@sehadofficial2233"><i class="fab fa-youtube"></i></a>
        <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
        <p>Copyright &copy; <span id="date"></span> - Setya Hadi Nugroho all right reserved <a
                href="mailto:222112358@stis.ac.id">(222112358@stis.ac.id)</a></p>
    </footer>
    <script>
    </script>
    <script src="js/script.js"></script>
    <script src="js/rubik.js"></script>
    <script>
        let y = new Date().getFullYear();
        document.querySelector('#date').innerHTML = y;
    </script>
</body>

</html>