<?php
session_start();
include 'koneksi.php';
// jika tidak ada session pelanggan atau belum login
if (!isset($_SESSION['pelanggan'])) {
    echo "<script> alert('anda harus login dahulu');</script>";
    echo "<script>location='login.php';</script>";
} else {

}
if (empty($_SESSION['keranjang']) or !isset($_SESSION['keranjang'])) {
    echo "<script>alert('silahkan berbelanja terlebih dahulu'); </script>";
    echo "<script>location='rubik.php';</script>";
} else {
    echo "<script>alert('harap hidupkan koneksi internet terlebih dahulu'); </script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/checkout.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <title>Sehad Store</title>
</head>

<body>
    <?php include 'menu.php'; ?>
    <br><br><br>
    <section class="konten">
        <div class="container">
            <h1 style="color:black;">Checkout</h1>
            <hr>
            <table>
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Nama_produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Sub_harga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nomor = 1; ?>
                    <?php $totalberat = 0; ?>
                    <?php $totalbelanja = 0; ?>
                    <?php foreach ($_SESSION['keranjang'] as $id_produk => $jumlah): ?>
                        <!-- menampilkan produk berdasarkan id produk -->
                        <?php
                        $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
                        $pecah = $ambil->fetch_assoc();
                        $subHarga = $pecah['harga_produk'] * $jumlah;
                        // sub berat diperoleh dari berat*jumlah
                        $sberat = $pecah['berat_produk'] * $jumlah;
                        $totalberat += $sberat;
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
                        </tr>
                        <?php $nomor++; ?>
                        <?php $totalbelanja += $subHarga; ?>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4">Total Belanja</th>
                        <th>Rp.
                            <?= number_format( $totalbelanja); ?>
                        </th>
                    </tr>
                </tfoot>
            </table>
            <form method="post">
                <div class="row">
                    <div class="col">
                        <label for="">Nama pelanggan</label> <br>
                        <input type="text" readonly value="<?= $_SESSION["pelanggan"]['nama_pelanggan']; ?>">
                    </div>

                    <div class="col">
                        <label for="">Telepon Pelanggan</label> <br>
                        <input type="text" readonly value="<?= $_SESSION["pelanggan"]['telepon_pelanggan']; ?>">
                    </div>
                </div>
                <label class="alamat">Alamat Pengiriman</label> <br>
                <textarea name="alamat_pengiriman" placeholder="Masukkan alamat lengkap pengiriman" required></textarea>
                <div class="row2">
                    <div class="col2">
                        <label for=""> Pilih Provinsi</label> <br>
                        <select name="nama_provinsi">
                        </select>
                    </div>
                    <div class="col2">
                        <label for="">Pilih Kota/Kabupaten</label> <br>
                        <select name="nama_distrik">
                        </select>
                    </div>
                    <div class="col2">
                        <label for=""> Pilih Ekspedisi</label> <br>
                        <select name="nama_ekspedisi">
                        </select>
                    </div>
                    <div class="col2">
                        <label for=""> Pilih Paket</label> <br>
                        <select name="nama_paket"> </select>
                    </div>
                </div>
                <br>
                <h3>Data yang terinput</h3>
                <br>
                <div class="row3">
                    <div class="col3">
                        <label>Berat ( gram )</label> <br>
                        <input type="text" name="total_berat" value="<?= $totalberat ?>" readonly>
                    </div>

                    <div class="col3">
                        <label for="">Provinsi</label> <br>
                        <input type="text" name="provinsi" readonly>
                    </div>

                    <div class="col3">
                        <label for="">Kabupaten/Kota</label> <br>
                        <input type="text" name="distrik" readonly>
                    </div>

                    <div class="col3">
                        <label for="">Kodepos</label> <br>
                        <input type="text" name="kodepos" readonly>
                    </div>

                    <div class="col3">
                        <label for="">Tipe</label> <br>
                        <input type="text" name="tipe" readonly>
                    </div>

                    <div class="col3">
                        <label for="">Ekspedisi</label> <br>
                        <input type="text" name="ekspedisi" readonly>
                    </div>

                    <div class="col3">
                        <label for="">Paket</label> <br>
                        <input type="text" name="paket" readonly>
                    </div>

                    <div class="col3">
                        <label for="">Ongkir</label> <br>
                        <input type="text" name="ongkir" readonly>
                    </div>

                    <div class="col3">
                        <label for="">Estimasi ( hari )</label> <br>
                        <input type="text" name="estimasi" readonly>
                    </div>
                </div>
                <button name="checkout">Checkout</button>
            </form>
            <script src="js/jquery.min.js"></script>

            <?php
            if (isset($_POST['checkout'])) {
                $id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
                $tanggalpembelian = date("Y-m-d");
                $alamat_pengiriman = $_POST['alamat_pengiriman'];

                $total_berat = $_POST["total_berat"];
                $provinsi = $_POST["provinsi"];
                $distrik = $_POST["distrik"];
                $tipe = $_POST["tipe"];
                $kodepos = $_POST["kodepos"];
                $ekspedisi = $_POST["ekspedisi"];
                $paket = $_POST["paket"];
                $ongkir = $_POST["ongkir"];
                $estimasi = $_POST["estimasi"];
                $totalpembelian = $totalbelanja + $ongkir;

                // menyimpan data ke tabel pembelian
                $koneksi->query("INSERT INTO pembelian(
    id_pelanggan,tanggal_pembelian,total_pembelian,alamat_pengiriman,total_berat,provinsi,distrik,tipe,kodepos,ekspedisi,paket,ongkir,estimasi)
    VALUES ('$id_pelanggan','$tanggalpembelian','$totalpembelian','$alamat_pengiriman','$total_berat','$provinsi','$distrik','$tipe','$kodepos','$ekspedisi','$paket','$ongkir','$estimasi')");

                //mendapatkan id pembelian barusan terjadi
                $idbeli = $koneksi->insert_id;

                foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) {
                    // mendapatkan data berdasarkan id produk
                    $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk = '$id_produk'");
                    $perproduk = $ambil->fetch_assoc();

                    $nama = $perproduk['nama_produk'];
                    $harga = $perproduk['harga_produk'];
                    $berat = $perproduk['berat_produk'];
                    $nama = $perproduk['nama_produk'];

                    $subberat = $perproduk['berat_produk'] * $jumlah;
                    $subharga = $perproduk['harga_produk'] * $jumlah;

                    $koneksi->query("INSERT INTO pembelian_produk (id_pembelian,id_produk,nama,harga,berat,subberat,subharga,jumlah)
        VALUES('$idbeli','$id_produk','$nama','$harga','$berat','$subberat','$subharga','$jumlah')");

                    // update stok
                    $koneksi->query("UPDATE produk SET stok_produk = stok_produk - $jumlah 
        WHERE id_produk='$id_produk'");
                }
                // mengkosongkan keranjang belanja
                unset($_SESSION['keranjang']);
                // tampilan dialihkan ke halaman nota dari pembelian
                echo "<script> alert('pembelian berhasil');</script>";
                echo "<script>location='nota.php?id=$idbeli;';</script>";
            }
            ?>
        </div>
    </section>
    <footer>
        <a href="https://www.facebook.com"><i class="fab fa-facebook"></i></a>
        <a href="https://www.youtube.com/@sehadofficial2233"><i class="fab fa-youtube"></i></a>
        <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
        <p>Copyright &copy; <span id="date"></span> - Setya Hadi Nugroho all right reserved <a
                href="mailto:222112358@stis.ac.id">(222112358@stis.ac.id)</a></p>
    </footer>
    <script>
        $(document).ready(function () {
            $.ajax({
                type: 'post',
                url: 'dataprovinsi.php',
                success: function (hasil_provinsi) {
                    $("select[name=nama_provinsi]").html(hasil_provinsi);
                }
            });

            $("select[name=nama_provinsi").on("change", function () {
                //     // ambil id provinsi yang dipilih dari atribut pribadi
                var $idprov = $("option:selected", this).attr("id_provinsi");
                $.ajax({
                    type: 'get',
                    url: 'datakota.php',
                    data: 'id_provinsi=' + $idprov,
                    success: function (hasil_kota) {
                        $("select[name=nama_distrik]").html(hasil_kota);
                    }
                });
            });

            $.ajax({
                type: 'post',
                url: 'ekspedisi.php',
                success: function (hasil_ekspedisi) {
                    $("select[name=nama_ekspedisi").html(hasil_ekspedisi);
                }
            });
            $("select[name=nama_ekspedisi]").on("change", function () {
                // mendapatkan data ongkir kirim

                // mendapatkan ekspedisi yang dipilih
                var ekspedisi = $("select[name=nama_ekspedisi]").val();
                //mendapatkan id_district yang kita pilih
                var distrik = $("option:selected", "select[name=nama_distrik]").attr("id_distrik");
                //mendapatkan total berat dari inputan
                var berat = $("input[name=total_berat]").val();
                $.ajax({
                    type: 'post',
                    url: 'datapaket.php',
                    data: 'ekspedisi=' + ekspedisi + '&distrik=' + distrik + '&berat=' + berat,
                    success: function (hasil_paket) {
                        // console.log(hasil_paket);
                        $("select[name=nama_paket]").html(hasil_paket);

                        //letakkan nama ekspedisi terpilihi di input ekspedisi
                        $("input[name=ekspedisi]").val(ekspedisi);

                    }
                });
            });
            $("select[name=nama_distrik]").on("change", function () {
                var prov = $("option:selected", this).attr("nama_provinsi");
                var dist = $("option:selected", this).attr("nama_distrik");
                var tipe = $("option:selected", this).attr("tipe_distrik");
                var kodepos = $("option:selected", this).attr("kodepos");
                $("input[name=provinsi]").val(prov);
                $("input[name=distrik]").val(dist);
                $("input[name=tipe]").val(tipe);
                $("input[name=kodepos]").val(kodepos);
            });
            $("select[name=nama_paket]").on("change", function () {
                var paket = $("option:selected", this).attr("paket");
                var ongkir = $("option:selected", this).attr("ongkir");
                var etd = $("option:selected", this).attr("etd");
                $("input[name=paket]").val(paket);
                $("input[name=ongkir]").val(ongkir);
                $("input[name=estimasi]").val(etd);
            })
        });

    </script>

</body>

</html>