<link rel="stylesheet" href="css/produk.css">

<form action="cariproduk.php" method="get">
    <input type="text" name="keyword">
    <button>Search</button>
</form>

<h2>Data Produk</h2>
<a href="index.php?halaman=tambahproduk">Add Product <i class="fa fa-plus"></i> </a>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kategori</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Berat</th>
            <th>Stok</th>
            <th>Foto</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor = 1; ?>
        <?php $ambil = $koneksi->query("SELECT * FROM produk LEFT JOIN kategori ON produk.id_kategori=kategori.id_kategori"); ?>
        <?php while ($pecah = $ambil->fetch_assoc()) { ?>
            <tr>
                <td>
                    <?php echo $nomor; ?>
                </td>
                <td>
                    <?php echo $pecah['nama_kategori']; ?>
                </td>
                <td>
                    <?php echo $pecah['nama_produk']; ?>
                </td>
                <td>
                    <?php echo $pecah['harga_produk']; ?>
                </td>
                <td>
                    <?php echo $pecah['berat_produk']; ?>
                </td>
                <td>
                    <?php echo $pecah['stok_produk']; ?>
                </td>
                <td>
                    <img src="../foto_barang/<?php echo $pecah['foto_produk']; ?>" width="100">
                </td>
                <td>
                    <a href="index.php?halaman=hapusproduk&id=<?= $pecah['id_produk']; ?>">hapus</a>
                    <a href="index.php?halaman=ubahproduk&id=<?= $pecah['id_produk']; ?>">ubah</a>
                </td>
            </tr>
            <?php $nomor++; ?>
        <?php } ?>
    </tbody>
</table>