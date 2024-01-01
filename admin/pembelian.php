<link rel="stylesheet" href="css/pembelian.css">
<h2>Data Pembelian</h2>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Pelanggan</th>
            <th>Tanggal</th>
            <th>Status Pembelian</th>
            <th>Total</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>

        <?php $nomor = 1; ?>
        <?php $ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.
        id_pelanggan=pelanggan.id_pelanggan"); ?>
        <?php while ($pecah = $ambil->fetch_assoc()) { ?>
            <tr>
                <td>
                    <?php echo $nomor; ?>
                </td>
                <td>
                    <?php echo $pecah['nama_pelanggan']; ?>
                </td>
                <td>
                    <?php echo date("d F Y", strtotime($pecah['tanggal_pembelian'])); ?>
                </td>
                <td>
                    <?php echo $pecah['status_pembelian']; ?>
                </td>
                <td>RP
                    <?php echo number_format($pecah['total_pembelian']); ?>
                </td>
                <td>
                    <a href="index.php?halaman=detail&id=<?php echo $pecah['id_pembelian']; ?>" class="detail">detail</a>
                    <?php if (($pecah['status_pembelian'] !== "barang sudah sampai") and ($pecah['status_pembelian'] !== "pending") and ($pecah['status_pembelian'] !== "batal")) : ?>
                        <a href="index.php?halaman=pembayaran&id=<?= $pecah['id_pembelian']; ?>" class="bayar">Update</a>
                    <?php endif ?>
                </td>
            </tr>
            <?php $nomor++; ?>
        <?php } ?>
    </tbody>
</table>