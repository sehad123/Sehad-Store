<link rel="stylesheet" href="css/pelanggan.css">

<h2>Data Pelanggan</h2>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Telepon</th>
            <th>Alamat</th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor = 1; ?>
        <?php $ambil = $koneksi->query("SELECT * FROM pelanggan"); ?>
        <?php while ($pecah = $ambil->fetch_assoc()) { ?>
            <tr>
                <td>
                    <?php echo $nomor; ?>
                </td>
                <td>
                    <?php echo $pecah['nama_pelanggan']; ?>
                </td>
                <td>
                    <?php echo $pecah['email_pelanggan']; ?>
                </td>
                <td>
                    <?php echo $pecah['telepon_pelanggan']; ?>
                </td>
                <td>
                    <?php echo $pecah['alamat_pelanggan']; ?>
                </td>
            </tr>
            <?php $nomor++; ?>
        <?php } ?>
    </tbody>
</table>