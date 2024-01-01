<?php

$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
$fotoproduk = $pecah['foto_produk'];
if (file_exists("../foto_barang/$fotoproduk")) {
    unlink("../foto_barang/$fotoproduk");
}
$koneksi->query("DELETE FROM produk WHERE id_produk = '$_GET[id]'");

echo "<script>alert('produk berhasil dihapus');</Script>";
echo "<script>location='index.php?halaman=produk';</Script>";
?>