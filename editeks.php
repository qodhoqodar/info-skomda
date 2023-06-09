<?php
include("koneksi.php");

function getEkskul($id_ekskul) {
    global $db;
    $sql = "SELECT * FROM ekskul WHERE id_ekskul = '$id_ekskul'";
    $query = mysqli_query($db, $sql);
    return mysqli_fetch_assoc($query);
}

if (isset($_POST['submit'])) {
    // Mengambil nilai dari input form
    $id_ekskul = $_POST['id_ekskul'];
    $nama_ekskul = $_POST['nama_ekskul'];
    $kelengkapan = $_POST['kelengkapan'];

    
    $sql_update = "UPDATE ekskul SET nama_ekskul = '$nama_ekskul', kelengkapan = '$kelengkapan' WHERE id_ekskul = '$id_ekskul'";
    mysqli_query($db, $sql_update);
    header("Location: ekskul.php"); 
    exit();
}

if (isset($_GET['id_ekskul'])) {
    $id_ekskul = $_GET['id_ekskul'];
    $ekskul = getEkskul($id_ekskul);
} else {
    header("Location: ekskul.php");
    exit();
}
?>

<html>
<head>
    <title>Edit Data Ekskul</title>
    <link rel="stylesheet" href="style-edit-eks.css">
</head>

<body>
    <h2>Edit Data Ekskul</h2>
    <form method="POST" action="">
        <input type="hidden" name="id_ekskul" value="<?php echo $ekskul['id_ekskul']; ?>">
        <label>Nama Ekstrakurikuler:</label><br>
        <input type="text" name="nama_ekskul" autocomplete="off" value="<?php echo $ekskul['nama_ekskul']; ?>" required><br>

        <label>Kelengkapan:</label><br>
        <input type="text" name="kelengkapan" autocomplete="off" value="<?php echo $ekskul['kelengkapan']; ?>" required><br>

        <input type="submit" name="submit" value="Simpan">
    </form>
</body>
</html>
