<?php 
session_start();
// koneksi database
include '../koneksi.php';

if(!isset($_SESSION['admin']))
{
echo"<script> alert('anda harus login');</script>";
echo"<script> location='login.php';</script>";
header('location:login.php');
exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/popup-image.css">
    <title>Dashboard</title>
</head>
<style>
    .sidebar h1{
        font-size: xx-large;
        margin-right: 90px;
    }
</style>
<body>
    <div class="sidebar">
        <div class="sidebar-brand">
            <h1> <span class="lab la-accusoft"></span> <b style="color: red;"> Sehad </b> <b> Store</b></h1>
        </div>
        <div class="sidebar-menu">
            <ul>
        <?php include '../koneksi.php';
                $id_admin = $_SESSION['admin']['id_admin'];
         $ambil=$koneksi->query("SELECT * FROM admin WHERE id_admin = '$id_admin'"); 
         $pecah = $ambil->fetch_assoc(); ?>
                <li class="gambar">
                    <img src="../foto_admin/<?php echo $pecah['foto_admin']; ?>" width="200" height="200" alt=".">
                </li>
                <li>
                    <a href="index.php"><span><i class="fa fa-bars"></i></span>
                        <span>Dashboard</span></a>
                </li>
                <li>
                    <a href="index.php?halaman=produk"><span><i class="fa-sharp fa-solid fa-box"></i></span>
                        <span>Product</span></a>
                </li>
                <li>
                    <a href="index.php?halaman=pembelian" class="beli"><span><i class="fa fa-shopping-cart"></i></span>
                        <span>Pembelian</span></a>
                </li>
                <li>
                    <a href="index.php?halaman=laporan_pembelian"><span><i class="fa fa-file"></i></span>
                        <span>Laporan</span></a>
                </li>
                <li>
                    <a href="index.php?halaman=pelanggan"><span><i class="fa-solid fa-user"></i></span>
                        <span>Customer</span></a>
                </li>
                <li>
                    <a href="index.php?halaman=logout"><span><i class="fa fa-sign-out"></i></span>
                        <span>Logout</span></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-content">
    <?php 
               
               if(isset($_GET['halaman']))
               {
                if($_GET['halaman']=='produk'){
                    include 'produk.php';
                }
                elseif($_GET['halaman']=='pembelian'){
                    include 'pembelian.php';
                }
                elseif($_GET['halaman']=='pelanggan'){
                    include 'pelanggan.php';
                }
                elseif($_GET['halaman']=='detail'){
                    include 'detail.php';
                }
                elseif($_GET['halaman']=='kategori'){
                    include 'kategori.php';
                }
                elseif($_GET['halaman']=='tambahproduk'){
                    include 'tambahproduk.php';
                }
                elseif($_GET['halaman']=='hapusproduk'){
                    include 'hapusproduk.php';
                }
                elseif($_GET['halaman']=='ubahproduk'){
                    include 'ubahproduk.php';
                }
                elseif($_GET['halaman']=='logout'){
                    include 'logout.php';
                }
                else if($_GET['halaman']=='pembayaran')
                {
                    include 'pembayaran.php';
                }
                else if($_GET['halaman']=='laporan_pembelian')
                {
                    include 'laporan_pembelian.php';
                }
                else if($_GET['halaman']=='cariproduk')
                {
                    include 'cariproduk.php';
                }
               }
               ?>
    </div>
</body>
</html>