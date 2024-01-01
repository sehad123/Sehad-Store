<?php 
session_start();
// koneksi database
include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/kontak.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <title>Sehad Store | Contact us</title>
</head>

<body style="background: #fff;">
    <?php include 'menu.php'; ?>
    <!--CONTACT INFO-->
    <div class="container" style="margin-top: 89.4px;">
        <h3>CONTACT INFO</h3>
        <div class="box">
            <div class="col-4">
                <h4>Address</h4>
                <p>Jalan Maskoki 1 no 85A, Perumnas 2, Kayuringin Jaya, Bekasi, Jawa Barat</p>
            </div>
        </div>
        <div class="box">
            <div class="col-4">
                <h4>Telp</h4>
                <p>087831698802</p>
            </div>
        </div>
        <div class="box">
            <div class="col-4">
                <h4>Email</h4>
                <p><a href="mailto:222112358@stis.ac.id">222112358@stis.ac.id</a></p>

            </div>
        </div>
        <div class="box">
            <div class="col-4">
                <h4>WhatsApp</h4>
                <p>087831698802</p>
            </div>
        </div>
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.133389577429!2d106.98793561473957!3d-6.24614709547875!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698c3648f7a7ff%3A0xbd075d39423b66f3!2sPerumnas%202%20Bekasi!5e0!3m2!1sen!2sid!4v1676554764799!5m2!1sen!2sid"
            width="1400" height="450" style="border:0; margin-top: 15px;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
        <br>
    </div>


    <!--FOOTER-->
    <footer>
        <a href="https://www.facebook.com"><i class="fab fa-facebook"></i></a>
        <a href="https://www.youtube.com/@sehadofficial2233"><i class="fab fa-youtube"></i></a>
        <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
        <p>Copyright &copy; 2022 - Setya Hadi Nugroho all right reserved <a
                href="mailto:222112358@stis.ac.id">(222112358@stis.ac.id)</a></p>
        <a href="https://api.whatsapp.com/send?phone=6287831698802" target="_blank" class="btn-floating whatsapp">
            <img src="img/wa.png" alt="whatsApp" width="50" height="50">
            <span>+6287831698802</span>
        </a>
    </footer>
    <script src="js/script.js"></script>

</body>

</html>