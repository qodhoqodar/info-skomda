<?php
include("koneksi.php");

// Cek apakah form telah di-submit
if (isset($_POST['submit'])) {
    // Mengambil nilai dari input form
    $nama_ekskul = $_POST['nama_ekskul'];
    $kelengkapan = $_POST['kelengkapan'];

    // Query untuk menambahkan data ke database
    $sql_tambah = "INSERT INTO ekskul (nama_ekskul, kelengkapan) VALUES ('$nama_ekskul', '$kelengkapan')";
    mysqli_query($db, $sql_tambah);
    header("Location: ekskul.php"); 
    exit();
}
?>

<html>
<head>
    <title>Tambah Data Ekskul</title>
</head>

<body>
    <h2>Tambah Data Ekskul</h2>
    <form method="POST" action="">
        <label>Nama Ekstrakurikuler:</label><br>
        <input type="text" name="nama_ekskul" required autocomplete="off" ><br>

        <label>Kelengkapan:</label><br>
        <textarea name="kelengkapan" placeholder="Kelengkapan" required autocomplete="off"></textarea>

        <input type="submit" name="submit" value="Simpan">
    </form>
</body>
</html>
