<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link rel="stylesheet" href="css/registrasi.css">
</head>

<body>
    <div class="wrapper">
        <h1 style="text-align: center;">Halaman Registrasi</h1>

        <form action="#" method="post" onsubmit="return validate(this)">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="nama">Nama Pelanggan</label>
                <input type="text" name="nama" id="nama" autocomplete="off">
            </div>
            <div class="form-group">
                <label>Nomer Wa / Telepon</label> <br>
                <input type="number" name="telepon" style="width:100%;height:50px;" autocomplete="off">
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <input type="text" name="alamat" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="password"> Input Password</label>
                <input type="password" name="password" id="password" required>
                <label for="password2"> Konfirmasi Password </label>
                <input type="password" name="password2" id="password2" required>
            </div>
            <div class="form-group">
                <button type="submit" class="submit" name="register"> Registrasi</button>
            </div>
        </form>
    </div>
    <script>
        function validate(form) {
            fail = validateNama(form.nama.value)
            fail += validateEmail(form.email.value)
            fail += validateNumber(form.telepon.value)
            fail += validateAlamat(form.alamat.value)
            if (fail == "") return true
            else { alert(fail); return false }
        }
        function validateNama(field) {
            if (field == "") return "Anda belum mengisi nama \n"
            else if (field.length < 5)
                return "Nama lengkap anda terlalu pendek \n"
            else return ""
        }
        function validateEmail(field) {
            if (field == "") return "Anda belum mengisi email\n"
            else if (!((field.indexOf(".") > 0) && (field.indexOf("@") > 0)) || /[^a-zA-Z0-9\.\@\_\-]/.test(field))
                return "invalid character in email \n"
            else return ""
        }
        function validateNumber(field) {
            if (field == "") return "Anda belum mengisi nomer WA\n"
            else if (!/[0-9]/.test(field))
                return "Inputan no WA harus berupa nomer \n"
            else if (field.length < 12)
                return "Nomer telpon anda terlalu pendek \n"
            else return ""
        }
        function validateAlamat(field) {
            if (field == "") return "Anda belum mengisi alamat\n"
            else if (field.length < 10)
                return "mohon isi alamat dengan lengkap \n"
            else return ""
        }
    </script>
</body>

</html>
<?php
include 'koneksi.php';
// jika tombol daftar ditekan
if (isset($_POST['register'])) {
    // mengambil isian nama,email,password,alamat,telepon
    $nama = $_POST["nama"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $password2 = $_POST["password2"];
    $alamat = $_POST["alamat"];
    $telepon = $_POST["telepon"];

    // cek validasi apakah email udah digunakan
    $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email'");
    $cocok = $ambil->num_rows;
    if ($cocok == 1) {
        echo "<script> alert('pendaftaran gagal, email sudah digunakan');</script>";
        echo "<script>location='registrasi.php';</script>";
    } elseif ($password !== $password2) {
        echo "<script> alert('pendaftaran gagal, konfirmasi password tidak sesuai');</script>";
        echo "<script>location='registrasi.php';</script>";
    } else {
        // query insert ke tabel pelanggan
        $koneksi->query("INSERT INTO pelanggan
                 (email_pelanggan,password_pelanggan,nama_pelanggan,telepon_pelanggan,alamat_pelanggan)
                 VALUES('$email','$password','$nama','$telepon','$alamat')");

        echo "<script> alert('pendaftaran berhasil, silahkan login');</script>";
        echo "<script>location='login.php';</script>";
    }
}

?>