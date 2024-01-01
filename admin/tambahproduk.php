<link rel="stylesheet" href="css/tambahproduk.css">
<link rel="stylesheet" href="css/tambahproduk2.css">
<?php
$datakategori = array();
$ambil = $koneksi->query("SELECT * FROM kategori");
while ($tiap = $ambil->fetch_assoc()) {
    $datakategori[] = $tiap;
}
?>

<form method="post" enctype="multipart/form-data">
    <br>
    <h2>Tambah Product</h2>
    <div class="form-group">
        <label for="">Kategori</label>
        <select name="id_kategori">
            <option value="">Pilih Kategori</option>
            <?php foreach ($datakategori as $key => $value) : ?>

                <option value="<?= $value['id_kategori']; ?>"><?= $value['nama_kategori']; ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="form-group">
        <label>Nama Produk</label>
        <input type="text" name="nama">
    </div>
    <div class="form-group">
        <label>Harga (Rp)</label>
        <input type="number" name="harga">
    </div>
    <div class="form-group">
        <label>Berat (gram)</label>
        <input type="number" name="berat">
    </div>
    <div class="form-group">
        <label>Deskripsi</label>
        <textarea name="deskripsi" rows="10"></textarea>
    </div>
    <div class="form-group">
        <label>Foto</label>
        <img class="img-preview">
        <input type="file" name="foto" style="height: 20px;" id="image" onchange="previewImage();">
        <span class></span>
    </div>
    <div class="form-group">
        <label>Stok</label>
        <input type="number" name="stok">
    </div>
    <button name="save">Simpan</button>
</form>
<?php
if (isset($_POST['save'])) {
    $nama = $_FILES['foto']['name'];
    $lokasi = $_FILES['foto']['tmp_name'];
    move_uploaded_file($lokasi, "../foto_barang/" . $nama);
    $koneksi->query("INSERT INTO produk
    (nama_produk,id_kategori,harga_produk,berat_produk,foto_produk,deskripsi_produk,stok_produk)
    VALUES('$_POST[nama]','$_POST[id_kategori]','$_POST[harga]','$_POST[berat]','$nama','$_POST[deskripsi]','$_POST[stok]')");

    echo "<script> alert('produk baru berhasil ditambahkan');</script>";
    echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=produk'>";
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