<link rel="stylesheet" href="css/search.css">

<?php
// koneksi database
include '../koneksi.php';
?>
<?php
$keyword = $_GET['keyword'];

$semuadata = array();
$ambil = $koneksi->query("SELECT * FROM produk LEFT JOIN kategori ON produk.id_kategori=kategori.id_kategori 
WHERE nama_produk LIKE '%$keyword%' OR nama_kategori LIKE '%$keyword%'");
while ($pecah = $ambil->fetch_assoc()) {
    $semuadata[] = $pecah;
}
?>
<?php include 'index2.php'; ?>
<form action="cariproduk.php" method="get">
    <input type="text" name="keyword">
    <button>Search</button>
</form>

<h2>Data Produk</h2>
<a href="index.php?halaman=tambahproduk">Add Product <i class="fa fa-plus"></i> </a>
<table style="margin-left:400px;">
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
        <?php foreach ($semuadata as $key => $value): ?>
            <tr>
                <td>
                    <?php echo $key + 1; ?>
                </td>
                <td>
                    <?php echo $value['nama_kategori']; ?>
                </td>
                <td>
                    <?php echo $value['nama_produk']; ?>
                </td>
                <td>
                    <?php echo $value['harga_produk']; ?>
                </td>
                <td>
                    <?php echo $value['berat_produk']; ?>
                </td>
                <td>
                    <?php echo $value['stok_produk']; ?>
                </td>
                <td>
                    <img src="../foto_barang/<?php echo $value['foto_produk']; ?>" width="100">
                </td>
                <td>
                    <a href="index.php?halaman=hapusproduk&id=<?= $value['id_produk']; ?>">hapus</a>
                    <a href="index.php?halaman=ubahproduk&id=<?= $value['id_produk']; ?>">ubah</a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>