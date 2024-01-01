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
    <link rel="stylesheet" type="text/css" href="css/style2.css">
    <link rel="stylesheet" type="text/css" href="css/style3.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <title>Sehad Store</title>
</head>

<body>
    <section class="section">
        <div class="slider">
            <h2>WELCOME TO <b style="color: red;">SEHAD </b>STORE</h2>
            <div class="slide">
                <input type="radio" name="radio-btn" id="radio1">
                <input type="radio" name="radio-btn" id="radio2">
                <input type="radio" name="radio-btn" id="radio3">
                <input type="radio" name="radio-btn" id="radio4">

                <div class="st first">
                    <img src="img/background/bg.jpg" alt="">
                </div>
                <div class="st">
                    <img src="img/background/rubik1.jpg" alt="">
                </div>
                <div class="st">
                    <img src="img/background/baner.jpg" alt="" style="filter: contrast(2);">
                </div>
                <div class="st">
                    <img src="img/background/rbk2.jpg" alt="">
                </div>
                <div class="nav-auto">
                    <div class="a-b1"></div>
                    <div class="a-b2"></div>
                    <div class="a-b3"></div>
                    <div class="a-b4"></div>
                </div>
            </div>
            <div class="nav-m">
                <label for="radio1" class="m-btn"></label>
                <label for="radio2" class="m-btn"></label>
                <label for="radio3" class="m-btn"></label>
                <label for="radio4" class="m-btn"></label>
            </div>
        </div>
    </section>
    <br> <br>
    <div class="deadline">
        <p id="time"></p>
    </div>
    <!-- Service -->
    <div class="container" style="margin-top: 78.4px;" id="accessories">
        <ul id="container">
            <?php $ambil = $koneksi->query("SELECT * FROM produk WHERE harga_produk<='50000' AND stok_produk > '0'"); ?>
            <?php while ($perProduk = $ambil->fetch_assoc()) { ?>
                <li class="col-4">
                    <h4>
                        <?= $perProduk['nama_produk']; ?>
                    </h4>
                    <div class="prd"><img src="foto_barang/<?= $perProduk['foto_produk']; ?>" alt=""></div>
                    <h4 style="padding:5px; transform: translateY(-10px);">
                        <?= $perProduk['nama_produk']; ?>
                    </h4>
                    <p> Rp <del> 500.000,00 </del> </p>
                    <p class="harga">Rp
                        <?= number_format($perProduk['harga_produk']); ?>,00
                    </p>
                    <br><br>
                    <span>
                        <a href="beli.php?id=<?= $perProduk['id_produk']; ?>" class="beli">Buy Now</a>
                        <a href="detail.php?id=<?= $perProduk['id_produk']; ?>" class="detail">Detail</a>
                    </span>
                </li>
            <?php } ?>
        </ul>
    </div>

    <h2>Gallery</h2>
    <div class="gallery">
        <img src="img/megaminx.jpg" alt="" width="200" height="200">
        <img src="img/prd/miror.jfif" alt="" width="200" height="200">
        <img src="img/yan3.jfif" alt="" width="200" height="200">
        <img src="img/new_product/qiyi_timer.jpg" alt="" width="200" height="200">
        <img src="img/prd/stiker.jfif" alt="" width="200" height="200">
        <img src="img/new_product/meilong.jpg" alt="" width="190" height="190">
        <img src="img/prd/sw.webp" alt="" width="240" height="240">
        <img src="img/prd/pyraminx.webp" alt="" width="200" height="190">
        <img src="img/prd/wq.webp" alt="" width="200" height="200">
        <img src="img/new_product/moyu_timer.jpg" alt="" width="200" height="200">
        <img src="img/new_product/tas.jpg" alt="" width="200" height="200">
        <img src="img/new_product/gantungan_kunci.jpg" alt="" width="200" height="200">
        <img src="img/new_product/gan_rs.jpg" alt="" width="180" height="180">
        <img src="img/prd/sq1.jfif" alt="" width="250" height="250">
        <img src="img/prd/lube.jpg" alt="" width="180" height="180">
    </div>
    <div class="popup-image">
        <span>&times;</span>
        <img src="img/megaminx.jpg" alt="" width="200" height="200">
    </div>
    <h2 class="last">OUR BRAND</h2>
    <div class="gallery dua">
        <img src="img/brand/moyu.png" alt="" width="100" height="100">
        <img src="img/brand/qiyi.jpg" alt="" width="100" height="100">
        <img src="img/brand/yj.png" alt="" width="100" height="100">
        <img src="img/brand/yx.jfif" alt="" width="100" height="100">
        <img src="img/brand/gan.jpg" alt="" width="100" height="100">
    </div>
    <!-- Footer -->
    <footer>
        <a href="https://www.facebook.com"><i class="fab fa-facebook"></i></a>
        <a href="https://www.youtube.com/@sehadofficial2233"><i class="fab fa-youtube"></i></a>
        <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
        <p>Copyright &copy; <span id="date"></span> - Setya Hadi Nugroho all right reserved <a
                href="mailto:222112358@stis.ac.id">(222112358@stis.ac.id)</a></p>
    </footer>
    <script src="js/script.js"></script>
    <script>

        // footer menampilkan tahun
        let y = new Date().getFullYear();
        document.querySelector('#date').innerHTML = y;

        // popup image gallery and brand
        document.querySelectorAll('.gallery img').forEach(image => {
            image.onclick = () => {
                document.querySelector('.popup-image').style.display = 'block';
                document.querySelector('.popup-image img').src = image.getAttribute('src');
            }
        });
        document.querySelector('.popup-image span').onclick = () => {
            document.querySelector('.popup-image').style.display = 'none';
        }
    </script>
</body>

</html>
<?php
include 'menu.php';
if (isset($_SESSION['pelanggan'])) {
    $id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
    $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan = '$id_pelanggan'");
    $pecah = $ambil->fetch_assoc();
    $nama = $pecah['nama_pelanggan'];
    echo "<script>
    alert(`Halo $nama \nSelamat datang di Sehad Store \nSelamat berbelanja `); </script>";
}
?>