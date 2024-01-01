<link rel="stylesheet" href="css/laporan.css">

<?php
$semuadata = array();
$tgl_mulai = "-";
$tgl_selesai = "-";
if (isset($_POST['kirim'])) {
    $tgl_mulai = $_POST['tglm'];
    $tgl_selesai = $_POST['tgls'];
    $status = $_POST['status'];
    $ambil = $koneksi->query("SELECT * FROM pembelian pm LEFT JOIN pelanggan pl ON
    pm.id_pelanggan=pl.id_pelanggan WHERE status_pembelian='$status' AND tanggal_pembelian BETWEEN '$tgl_mulai' AND '$tgl_selesai' ");
    while ($pecah = $ambil->fetch_assoc()) {
        $semuadata[] = $pecah;
    }
}
// echo"<pre>";
// print_r($semuadata);
// echo"</pre>";
?>


<h2>Laporan Pembelian dari
    <?= $tgl_mulai ?> hingga
    <?= $tgl_selesai ?>
</h2>
<hr>

<form method="post">
    <div class="row">
        <div class="col">
            <label for="">Tanggal Mulai</label> <br>
            <input type="date" name="tglm" value="<?= $tgl_mulai ?>" required>
        </div>
        <div class="col">
            <label for="">Tanggal Selesai</label> <br>
            <input type="date" name="tgls" value="<?= $tgl_selesai ?>" required>
        </div>
        <div class="col">
            <label for="">Status</label> <br>
            <Select name="status" required>
                <option value="">Pilih Status</option>
                <option value="barang dikirim">Barang dikirim</option>
                <option value="batal">Batal</option>
                <option value="barang sudah sampai">Barang Sudah Sampai</option>
                <option value="pending">Pending</option>
            </Select>
        </div>
        <div class="col">
            <label for="">&nbsp;</label> <br>
            <button name="kirim">Lihat</button>
        </div>
    </div>
</form>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Pelanggan</th>
            <th>Tanggal</th>
            <th>Jumlah</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php $total = 0; ?>
        <?php foreach ($semuadata as $key => $value) : ?>
            <?php $total += $value['total_pembelian'] ?>
            <tr>
                <td>
                    <?= $key + 1; ?>
                </td>
                <td>
                    <?= $value["nama_pelanggan"]; ?>
                </td>
                <td>
                    <?php echo date("d F Y", strtotime($value['tanggal_pembelian'])); ?>
                </td>
                <td>RP.
                    <?= number_format($value["total_pembelian"]); ?>
                </td>
                <td>
                    <?= $value["status_pembelian"]; ?>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="3">Total</th>
            <th>Rp.
                <?= number_format($total); ?>
            </th>
            <th></th>
        </tr>
    </tfoot>
</table>