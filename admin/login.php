<?php
session_start();
// koneksi
include '../koneksi.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <title>Login</title>
</head>

<body>
    <div class="form">
        <H2>Halaman Login Admin</H2>

        <i class="fa-solid fa-user"></i>

        <form action="#" method="post" onsubmit="return validate(this)">
            <?php
            if (isset($_POST['login'])) {
                $ambil = $koneksi->query("SELECT * FROM admin WHERE username = '$_POST[username]'
                AND password = '$_POST[password]'");
                $tepat = $ambil->num_rows;
                if ($tepat == 1) {
                    $_SESSION['admin'] = $ambil->fetch_assoc();
                    echo "<script>alert('Selamat login berhasil'); </script>";
                    echo "<meta http-equiv='refresh' content='1;url=index.php'>";
                } else {
                    echo " <script>alert('username dan password anda tidak sesuai');</script> ";
                    echo "<meta http-equiv='refresh' content='1;url=login.php'>";
                }
            } ?>
            <input type="text" name="username" placeholder="username" autocomplete="off">
            <input type="password" name="password" placeholder="password" id="password"><br>

            <input class="k" type="checkbox">
            <span> remember me</span>
            <br>
            <button type="submit" name="login">Login</button>
            <p>dont have a account? <a href="registrasi.php">Register</a></p>
        </form>
    </div>
    <script>
        function validate(form) {
            fail = validateUser(form.username.value)
            fail += validatePassword(form.password.value)
            if (fail == "") return true
            else { alert(fail); return false }
        }
        function validateUser(field) {
            if (field == "") return "Username anda masih kosong\n"
            else if (/[^a-zA-Z0-9_-]/.test(field))
                return "Invalid character in username\n"
            else return ""
        }
        function validatePassword(field) {
            if (field == "") return "Anda belum mengisi password\n"
            else return ""
        }

    </script>

</body>

</html>