<html>

<head>
    <title>Tambah/Edit Data</title>
    <link rel="stylesheet" href="styletambah.css">
</head>

<body>
    <header>
        <h2> Tambah/Edit Data Guru</h2>
    </header>

    <?php
    include("koneksi.php");

    // Mendapatkan ID data yang akan diedit
    $editId = isset($_GET['edit']) ? $_GET['edit'] : '';

    // Mendapatkan data yang akan diedit dari database
    $editData = null;
    if (!empty($editId)) {
        $query = mysqli_query($db, "SELECT * FROM guru WHERE id = '$editId'");
        $editData = mysqli_fetch_assoc($query);
    }

    if (isset($_POST['daftar'])) {
        $nama = $_POST['nama'];
        $jabatan = $_POST['jabatan'];
        $no_telp = $_POST['no_telp'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $file = $_FILES['userfile'];
        $filename = $file['name'];
        $tmp_name = $file['tmp_name'];
        $file_extension = pathinfo($filename, PATHINFO_EXTENSION);
        $allowed_extensions = ['jpg', 'png', 'jpeg'];

        if (!in_array($file_extension, $allowed_extensions)) {
            echo 'Format File Tidak Diizinkan';
        } else {
            $newname = 'userfile' . time() . '.' . $file_extension;
            $destination = './foto_guru/' . $newname;

            if (move_uploaded_file($tmp_name, $destination)) {
                if (!empty($editId)) {
                    // Jika ID data yang akan diedit ada, lakukan proses pengeditan
                    $update = mysqli_query($db, "UPDATE guru SET
                        nama = '$nama',
                        jabatan = '$jabatan',
                        no_telp = '$no_telp',
                        jenis_kelamin = '$jenis_kelamin',
                        foto_guru = '$newname'
                        WHERE id = '$editId'
                    ");

                    if ($update) {
                        echo '<script>alert("Data berhasil diupdate")</script>';
                        echo '<script>window.location="index.php"</script>';
                    } else {
                        echo '<script>alert("Gagal mengupdate data: ' . mysqli_error($db) . '")</script>';
                    }
                } else {
                    // Jika tidak ada ID data yang akan diedit, lakukan proses penambahan data baru
                    $insert = mysqli_query($db, "INSERT INTO guru (nama, jabatan, no_telp, jenis_kelamin, foto_guru) VALUES (
                        '$nama',
                        '$jabatan',
                        '$no_telp',
                        '$jenis_kelamin',
                        '$newname'
                    )");

                    if ($insert) {
                        echo '<script>alert("Data berhasil ditambahkan")</script>';
                        echo '<script>window.location="index.php"</script>';
                    } else {
                        echo '<script>alert("Gagal menambahkan data: ' . mysqli_error($db) . '")</script>';
                    }
                }
            } else {
                echo 'Gagal memindahkan file';
            }
        }
    }
    ?>

    <form action="" method="POST" enctype="multipart/form-data">
        <p>
            <label for="nama">Nama: </label>
            <input type="text" name="nama" placeholder="nama lengkap" required value="<?php echo !empty($editData) ? $editData['nama'] : ''; ?>" />
        </p>
        <p>
            <label for="jabatan">Jabatan: </label>
            <input type="text" name="jabatan" placeholder="jabatan" required value="<?php echo !empty($editData) ? $editData['jabatan'] : ''; ?>" />
        </p>
        <p>
            <label for="no_telp">No. Telepon: </label>
            <input type="text" name="no_telp" placeholder="nomor telepon" required value="<?php echo !empty($editData) ? $editData['no_telp'] : ''; ?>" />
        </p>
        <p>
            <label for="jenis_kelamin">Jenis kelamin: </label>
            <label><input type="radio" name="jenis_kelamin" value="laki-laki" required <?php echo (!empty($editData) && $editData['jenis_kelamin'] == 'laki-laki') ? 'checked' : ''; ?>> Laki-Laki</label>
            <label><input type="radio" name="jenis_kelamin" value="perempuan" required <?php echo (!empty($editData) && $editData['jenis_kelamin'] == 'perempuan') ? 'checked' : ''; ?>> Perempuan</label>
        </p>
        <p>
            <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
            Foto Guru: <input type="file" name="userfile" <?php echo !empty($editData) ? '' : 'required'; ?> />
        </p>
        <p>
            <input type="submit" name="daftar" value="<?php echo !empty($editData) ? 'Update' : 'Tambah'; ?>">
        </p>
    </form>
</body>

</html>
