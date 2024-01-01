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

        <form action="#" method="post" onsubmit="return validate(this)" enctype="multipart/form-data">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="email">Nama lengkap</label>
                <input type="text" name="nama" id="email" autocomplete="off">
            </div>
            <div class="form-group">
                <label>Foto</label>
                <input type="file" name="foto" height="20" required>
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
            fail = validateUser(form.username.value)
            fail += validateNama(form.nama.value)
            if (fail == "") return true
            else { alert(fail); return false }
        }
        function validateUser(field) {
            if (field == "") return "Anda belum mengisi username\n"
            else if (field.length < 5)
                return "Username anda terlalu pendek \n"
            else if (/[^a-zA-Z0-9_-]/.test(field))
                return "Invalid character in username\n"
            else return ""
        }
        function validateNama(field) {
            if (field == "") return "Anda belum mengisi nama\n"
            else if (field.length < 5)
                return "nama anda terlalu pendek \n"
            else return ""
        }
    </script>
</body>

</html>
<?php

$koneksi = mysqli_connect("localhost", "root", "", "sehadstore");
function registrasi($data)
{
    global $koneksi;
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($koneksi, $data["password"]);
    $password2 = mysqli_real_escape_string($koneksi, $data["password2"]);


    //cek username sudah ada atau belum
    $result = mysqli_query($koneksi, "SELECT username FROM admin WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
        alert('username sudah terdaftar');
        </script>";
        return false;
    }

    // cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
        alert(' konfirmasi password salah');
        </script>";
        return false;
    }
    $nama = $_FILES['foto']['name'];
    $lokasi = $_FILES['foto']['tmp_name'];
    move_uploaded_file($lokasi, "../foto_admin/" . $nama);
    mysqli_query($koneksi, "INSERT INTO admin VALUES('', '$username', '$password','$_POST[nama]','$nama')");
    return mysqli_affected_rows($koneksi);
}

if (isset($_POST['register'])) {
    if (registrasi($_POST) > 0) {

        echo "<script>
        alert('user baru berhasil ditambahkan');
        document.location.href = 'login.php';
        </script>";
    } else {
        echo mysqli_error($koneksi);
    }
}
?>