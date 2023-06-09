<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>fasilitas</title>
    <link rel="stylesheet" href="style-tmbh-fslts.css">
</head>

<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="text" name="nama" placeholder="Nama">
        <br>
        <input type="file" name="gambar">
        <br>
        <input type="submit" value="Tambah" name="submit">
    </form>
</body>

<?php
include("koneksi.php");

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $file = $_FILES['gambar'];
    $filename = $file['name'];
    $tmp_name = $file['tmp_name'];
    $file_extension = pathinfo($filename, PATHINFO_EXTENSION);
    $allowed_extensions = array('jpg', 'png', 'jpeg');

    if (!in_array($file_extension, $allowed_extensions)) {
        echo 'Format File Tidak Diizinkan';
        header('location: fasilitas2.php');
    } else {
        $newname = 'gambar' . time() . '.' . $file_extension;
        $destination = './foto_fasilitas/' . $newname;

        if (move_uploaded_file($tmp_name, $destination)) {
            $insert = mysqli_query($db, "INSERT INTO fasilitas (nama, gambar) VALUES (
                '" . $nama . "',
                '" . $newname . "')");

            if ($insert) {
                echo '<script>alert("Berhasil")</script>';
                echo '<script>window.location="fasilitas.php"</script>';
            } else {
                echo '<script>alert("Gagal Ditambahkan")</script>';
            }
        } else {
            echo 'Gagal memindahkan file';
        }
    }
}
?>

</html>