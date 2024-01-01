<header>
    <h1><a href="index.php"><b style="color: red; ">SEHAD </b> <b style="color: white;">STORE</b></a>
        <br>
        <a href="admin/login.php">Halaman Admin</a>
        <a href="index.php">Home</a>
    </h1>
    <nav class="nav">
        <ul>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn" style="font-size: large;">Product <i
                        class="fa fa-caret-down"></i></a>
                <div class="dropdown-content">
                    <a href="rubik.php">Rubik's Cube</a>
                    <a href="acessories.php">Accesories</a>
                </div>
            <li><a href="kontak.php">Contact</a></li>
            <li><a href="keranjang.php">Keranjang</a></li>

            <!-- jika sudah login -->
            <?php if (isset($_SESSION['pelanggan'])): ?>
                <li><a href="riwayat.php">Riwayat Belanja</a></li>
                <li><a href="logout.php">Logout</a></li>

                <!-- selain itu -->
            <?php else: ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="registrasi.php">Daftar</a></li>
            <?php endif ?>
            <li><a href="checkout.php">Checkout</a></li>
        </ul>
        </div>
    </nav>
    <div class="menu-toggle">
        <i class="fa fa-bars"></i>
    </div>
</header>