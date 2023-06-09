<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Fasilitas</title>
    <link rel="stylesheet" href="styleeditfslts.css">
</head>

<body>
    <?php
    include("koneksi.php");

    // Memeriksa apakah ada parameter id yang dikirim melalui URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Mengambil data fasilitas berdasarkan ID
        $query = mysqli_query($db, "SELECT * FROM fasilitas WHERE id_fasilitas = '$id'");
        $data = mysqli_fetch_assoc($query);

        if ($data) {
            $nama = $data['nama'];
            $gambar = $data['gambar'];
    ?>
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="text" name="nama" placeholder="Nama" value="<?php echo $nama; ?>">
                <br>
                <img src="./foto_fasilitas/<?php echo $gambar; ?>" alt="Gambar Fasilitas" width="200">
                <br>
                <input type="file" name="gambar">
                <br>
                <input type="submit" value="Update" name="submit">
            </form>
    <?php
        } else {
            echo "Data tidak ditemukan.";
        }
    } else {
        echo "ID fasilitas tidak ditemukan.";
    }

    if (isset($_POST['submit'])) {
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $file = $_FILES['gambar'];
        $filename = $file['name'];
        $tmp_name = $file['tmp_name'];
        $file_extension = pathinfo($filename, PATHINFO_EXTENSION);
        $allowed_extensions = array('jpg', 'png', 'jpeg');

        if (!empty($filename)) {
            // Jika ada file yang diunggah, lakukan validasi dan update data dengan gambar baru
            if (!in_array($file_extension, $allowed_extensions)) {
                echo 'Format File Tidak Diizinkan';
            } else {
                $newname = 'gambar' . time() . '.' . $file_extension;
                $destination = './foto_fasilitas/' . $newname;

                if (move_uploaded_file($tmp_name, $destination)) {
                    $update = mysqli_query($db, "UPDATE fasilitas SET 
                        nama = '$nama',
                        gambar = '$newname'
                        WHERE id_fasilitas = '$id'");

                    if ($update) {
                        echo '<script>alert("Data berhasil diperbarui")</script>';
                        echo '<script>window.location="fasilitas.php"</script>';
                    } else {
                        echo '<script>alert("Gagal memperbarui data")</script>';
                    }
                } else {
                    echo 'Gagal memindahkan file';
                }
            }
        } else {
            // Jika tidak ada file yang diunggah, lakukan update data tanpa mengubah gambar
            $update = mysqli_query($db, "UPDATE fasilitas SET 
                nama = '$nama'
                WHERE id_fasilitas = '$id'");

            if ($update) {
                echo '<script>alert("Data berhasil diperbarui")</script>';
                echo '<script>window.location="fasilitas.php"</script>';
            } else {
                echo '<script>alert("Gagal memperbarui data")</script>';
            }
        }
    }
    ?>

</body>

</html>
