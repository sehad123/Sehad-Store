<link rel="stylesheet" href="css/ubahproduk.css">

<?php

$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
?>

<?php
$datakategori = array();
$ambil = $koneksi->query("SELECT * FROM kategori");
while ($tiap = $ambil->fetch_assoc()) {
    $datakategori[] = $tiap;
}
?>

<form method="post" enctype="multipart/form-data">
    <h2>Ubah Produk</h2>

    <div class="form-group"> <br>
        <label for="">Kategori</label><br>
        <select name="id_kategori">
            <option value="">Pilih Kategori</option>
            <?php foreach ($datakategori as $key => $value) : ?>
                <option value="<?= $value['id_kategori']; ?>" <?php if ($pecah['id_kategori'] == $value['id_kategori']) {
                                                                    echo "selected";
                                                                } ?>>
                    <?= $value['nama_kategori']; ?>
                </option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="form-group">
        <label>Nama Produk</label>
        <input type="text" name="nama" value="<?= $pecah['nama_produk']; ?>">
    </div>
    <div class="form-group">
        <label>Harga (Rp)</label>
        <input type="number" name="harga" value="<?= $pecah['harga_produk']; ?>">
    </div>
    <div class="form-group">
        <label>Berat (gram)</label>
        <input type="number" name="berat" value="<?= $pecah['berat_produk']; ?>">
    </div>
    <div class="form-group">
        <img src="../foto_barang/<?= $pecah['foto_produk']; ?>" width="200" class="img-preview">
    </div>
    <div class="form-group">
        <label>Ganti Foto</label>
        <input type="file" name="foto" style="height:20px;" id="image" onchange="previewImage();">
    </div>
    <div class="form-group">
        <label>Deskripsi</label>
        <textarea name="deskripsi" rows="10"><?= $pecah['deskripsi_produk']; ?></textarea>
    </div>
    <div class="form-group">
        <label>Stok</label> <br>
        <input type="number" name="stok" value="<?= $pecah['stok_produk'] ?>">
    </div>
    <button name="ubah">Change</button>
</form>

<?php
if (isset($_POST['ubah'])) {
    $namafoto = $_FILES['foto']['name'];
    $lokasifoto = $_FILES['foto']['tmp_name'];
    // jika foto tidak berubah
    if (!empty($lokasifoto)) {
        move_uploaded_file($lokasifoto, "../foto_barang/$namafoto");

        $koneksi->query("UPDATE produk SET nama_produk='$_POST[nama]',id_kategori='$_POST[id_kategori]',
        harga_produk='$_POST[harga]',berat_produk='$_POST[berat]',
        foto_produk='$namafoto',deskripsi_produk='$_POST[deskripsi]',stok_produk='$_POST[stok]'
        WHERE id_produk='$_GET[id]'");
    } else {
        $koneksi->query("UPDATE produk SET nama_produk='$_POST[nama]',id_kategori='$_POST[id_kategori]',
        harga_produk='$_POST[harga]',berat_produk='$_POST[berat]',
        deskripsi_produk='$_POST[deskripsi]',stok_produk='$_POST[stok]'
        WHERE id_produk='$_GET[id]'");
    }
    echo "<script> alert('data produk telah diubah');</script>";
    echo "<script> location = 'index.php?halaman=produk';</script>";
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