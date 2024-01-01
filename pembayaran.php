<?php
session_start();
include 'koneksi.php';

// mendapatkan id pembelian dari url
$idpem = $_GET["id"];
$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$idpem'");
$datapem = $ambil->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/input_pembayaran.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <title>Sehad Store</title>

</head>

<body>
    <?php include 'menu.php'; ?>
    <br><br><br><br>
    <div class="container">
        <h2>Konfirmasi Pembayaran</h2>
        <div>Kirim bukti pembayaran anda</div>
        <div class="total">Total tagihan anda Rp. <strong>
                <?= number_format($datapem['total_pembelian']); ?>
            </strong> </div>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Nama Penyetor</label><br>
                <input type="text" name="nama">
            </div>
            <div class="form-group">
                <label for="">Bank</label> <br>
                <select name="bank">
                    <option value="">Pilih Bank</option>
                    <option value="Mandiri">Mandiri</option>
                    <option value="BRI">BRI</option>
                    <option value="BCA">BCA</option>
                    <option value="BNI">BNI</option>
                    <option value="Danamon">Danamon</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Jumlah biaya</label><br>
                <input type="number" name="jumlah" value="<?= $datapem['total_pembelian']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="">Foto Bukti</label><br>
                <img class="img-preview" style="display: none;" height="200" width="200">
                <input type="file" class="bukti" name="bukti" required id="image" onchange="previewImage();">
                <div class="foto"> foto bukti harus maksimal 2MB</div>
            </div>
            <button name="kirim">Kirim</button>
        </form>
    </div>

    <?php
    // jika tomnbol kirim ditekan
    if (isset($_POST['kirim'])) {
        // upload foto bukti
        $bukti = $_FILES['bukti']['name'];
        $lokasibukti = $_FILES['bukti']['tmp_name'];
        // $namafix =  date("YmdHis").$bukti;
        move_uploaded_file($lokasibukti, "foto_bukti_transfer/" . $bukti);
        $nama = $_POST["nama"];
        $bank = $_POST["bank"];
        $jumlah = $_POST["jumlah"];
        $tanggal = date("Y-m-d");

        $koneksi->query("INSERT INTO pembayaran (id_pembelian,nama,bank,jumlah,tanggal,bukti)
        VALUES('$idpem','$nama','$bank','$jumlah','$tanggal','$bukti')");

        // update data pembelian dari pending jadi sudah kirim pembayaran
        $koneksi->query("UPDATE pembelian SET status_pembelian='sudah membayar'
        WHERE id_pembelian='$idpem'");

        echo "<script> alert('pembayaran berhasil, barang akan segera kami proses');</script>";
        echo "<script>location='riwayat.php';</script>";
    }

    ?>
    <script>
        function previewImage() {
            const image = document.querySelector('#image');
            const img = document.querySelector('.img-preview');

            img.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                img.src = oFREvent.target.result;
            }
        }
    </script>
</body>

</html>