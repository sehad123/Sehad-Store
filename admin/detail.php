<link rel="stylesheet" href="css/detail.css">

<h2>Detail Pembelian</h2>
<?php
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan 
ON pembelian.id_pelanggan=pelanggan.id_pelanggan
WHERE pembelian.id_pembelian='$_GET[id]'");
$detail = $ambil->fetch_assoc();
?>
<div class="row">
    <div class="col">
        <h3>Pembelian</h3> <br>
        <p> Status :
            <?= $detail['status_pembelian']; ?>
        </p>
        <p> Tanggal :
            <?php echo date("d F Y", strtotime($detail['tanggal_pembelian'])); ?>
        </p>
        <p> Total + Ongkir :
            <strong>Rp.
                <?= number_format($detail['total_pembelian']); ?>
            </strong>
        </p>
    </div>

    <div class="col">
        <h3>Pelanggan</h3> <br>
        <p> nama :
            <?php echo $detail['nama_pelanggan']; ?>
        </p>
        <p>Telepon :
            <?php echo $detail['telepon_pelanggan']; ?>
        </p>
        <p> Email :
            <?php echo $detail['email_pelanggan']; ?>
        </p>
    </div>

    <div class="col">
        <h3>Pengiriman</h3> <br>
        <p>Ongkos pengiriman :
            <strong> Rp
                <?= number_format($detail['ongkir']); ?>
            </strong>
        </p>
        <p> Ekspedisi :
            <?= $detail['ekspedisi']; ?>
            <?= $detail['paket']; ?>
            <?= $detail['estimasi']; ?>
        </p>
        <p> Alamat Pengiriman:
            <?= $detail['alamat_pengiriman']; ?>
        </p>
    </div>

</div>
<table>
    <caption>Daftar Produk yang dibeli</caption>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Sub Total</th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor = 1; ?>
        <?php $ambil = $koneksi->query("SELECT * FROM pembelian_produk JOIN produk 
        ON pembelian_produk.id_produk=produk.id_produk
        WHERE pembelian_produk.id_pembelian ='$_GET[id]'"); ?>
        <?php $total = 0; ?>
        <?php while ($pecah = $ambil->fetch_assoc()) { ?>
            <?php $total += $pecah['harga_produk']; ?>
            <tr>
                <td>
                    <?php echo $nomor; ?>
                </td>
                <td>
                    <?= $pecah['nama_produk']; ?>
                </td>
                <td>
                    Rp
                    <?= number_format($pecah['harga_produk']); ?>
                </td>
                <td>
                    <?= $pecah['jumlah']; ?>
                </td>
                <td>
                    RP
                    <?= number_format($pecah['harga_produk'] * $pecah['jumlah']); ?>
                </td>
            </tr>
            <?php $nomor++; ?>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="4">Total</th>
            <th>Rp.
                <?= number_format($total); ?>
            </th>
        </tr>
    </tfoot>
</table>