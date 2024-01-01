<link rel="stylesheet" href="css/pembayaran.css">

<h2>Data pembayaran</h2>
<?php
// mendapatkan id pembelian dari URL
$id_pembelian = $_GET["id"];

// mengambil data pembayaran berdasarkan id pembelian
$ambil = $koneksi->query("SELECT * FROM pembayaran WHERE id_pembelian = '$id_pembelian'");
$detail = $ambil->fetch_assoc();

$ambil2 = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian = '$id_pembelian'");
$pecah = $ambil2->fetch_assoc();
?>

<div class="row">
    <div class="col">
        <table>
            <tr>
                <th>Nama</th>
                <td>
                    <?= $detail['nama']; ?>
                </td>
            </tr>
            <tr>
                <th>Bank</th>
                <td>
                    <?= $detail['bank']; ?>
                </td>
            </tr>
            <tr>
                <th>Jumlah</th>
                <td>Rp
                    <?= number_format($detail['jumlah']); ?>
                </td>
            </tr>
            <tr>
                <th>Tanggal</th>
                <td>
                    <?= $detail['tanggal']; ?>
                </td>
            </tr>
        </table>
    </div>
    <div class="col">
        <img src="../foto_bukti_transfer/<?= $detail['bukti']; ?>" alt="bukti_pembayaran" width="300" height="300">
    </div>
    <div class="col">
        <form method="post">
            <?php if (($pecah['status_pembelian'] == "sudah membayar")) : ?>
                <div>
                    <label for="">No Resi Pengiriman</label> <br>
                    <input type="text" name="resi">
                </div>
            <?php endif ?>
            <div>
                <label for="">Status</label> <br>
                <select name="status">
                    <option value="">Pilih Status</option>
                    <option value="barang dikirim">Barang dikirim</option>
                    <option value="batal">Batal</option>
                    <option value="barang sudah sampai">Barang Sudah Sampai</option>
                </select>
            </div>
            <button name="process">Proses</button>
        </form>
    </div>
    <?php
    if (isset($_POST['process'])) {
        $resi = $_POST['resi'];
        $status = $_POST['status'];
        $koneksi->query("UPDATE pembelian SET resi_pengiriman ='$resi',status_pembelian='$status' 
    WHERE id_pembelian = '$id_pembelian'");

        echo "<script> alert('data pembelian terupdate');</script>";
        echo "<script>location='index.php?halaman=pembelian';</script>";
    }
    ?>
</div>