<?php
include "koneksi.php";

if (!isset($_GET['id_guru'])) {
    header('Location: index.php');
}

$id_guru = $_GET['id_guru'];

$sql = "SELECT * FROM guru WHERE id_guru=$id_guru";
$query = mysqli_query($db, $sql);
$data_guru = mysqli_fetch_assoc($query);

if (mysqli_num_rows($query) < 1) {
    die("Data tidak ditemukan");
}

if (isset($_POST['simpan'])) {
    $id_guru = $_POST['id_guru'];
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $no_telp = $_POST['no_telp'];
    $jenis_kelamin = $_POST['jenis_kelamin'];

    $foto_guru = $_FILES['foto_guru'];
    $filename = $foto_guru['name'];
    $tmp_name = $foto_guru['tmp_name'];
    $file_extension = pathinfo($filename, PATHINFO_EXTENSION);
    $allowed_extensions = array('jpg', 'png', 'jpeg');

    if (!empty($filename)) {
        if (!in_array($file_extension, $allowed_extensions)) {
            echo 'Format File Tidak Diizinkan';
        } else {
            $newname = 'foto_guru' . time() . '.' . $file_extension;
            $destination = './foto_guru/' . $newname;

            if (move_uploaded_file($tmp_name, $destination)) {
                mysqli_query($db, "UPDATE guru SET
                    nama = '$nama',
                    jabatan = '$jabatan',
                    no_telp = '$no_telp',
                    jenis_kelamin = '$jenis_kelamin',
                    foto_guru = '$newname'
                    WHERE id_guru = '$id_guru'");

                header("Location: index.php");
            } else {
                echo 'Gagal memindahkan file';
            }
        }
    } else {
        mysqli_query($db, "UPDATE guru SET
            nama = '$nama',
            jabatan = '$jabatan',
            no_telp = '$no_telp',
            jenis_kelamin = '$jenis_kelamin'
            WHERE id_guru = '$id_guru'");

        header("Location: index.php");
    }
}
?>

<html>
<head>
    <title>Edit Data</title>
    <link rel="stylesheet" href="styleedit.css">
</head>
<body>
    <header>
        <h2>Edit Data Guru</h2>
    </header>

    <form action="" method="POST" enctype="multipart/form-data">
        <fieldset>
            <p>
                <label for="id_guru">ID Guru:</label>
                <input type="text" name="id_guru" value="<?php echo $data_guru['id_guru'] ?>" readonly>
            </p>
            <p>
                <label for="nama">Nama:</label>
                <input type="text" name="nama" placeholder="Nama lengkap" value="<?php echo $data_guru['nama'] ?>">
            </p>
            <p>
                <label for="jabatan">Jabatan:</label>
                <input type="text" name="jabatan" placeholder="Jabatan" value="<?php echo $data_guru['jabatan'] ?>">
            </p>
            <p>
                <label for="no_telp">No. Telepon:</label>
                <input type="text" name="no_telp" placeholder="Nomor telepon" value="<?php echo $data_guru['no_telp'] ?>">
            </p>
            <p>
                <label for="jenis_kelamin">Jenis Kelamin:</label>
                <label><input type="radio" name="jenis_kelamin" value="laki-laki" <?php if ($data_guru['jenis_kelamin'] == 'laki-laki') echo 'checked' ?>>Laki-Laki</label>
                <label><input type="radio" name="jenis_kelamin" value="perempuan" <?php if ($data_guru['jenis_kelamin'] == 'perempuan') echo 'checked' ?>>Perempuan</label>
            </p>
            <p>
                <input type="hidden" name="MAX_FILE_SIZE" value="3000000">
                Foto Guru: <input type="file" name="foto_guru">
                <span><?php echo $data_guru['foto_guru'] ?></span>
            </p>
            <p>
                <input type="submit" name="simpan" value="Simpan">
            </p>
        </fieldset>
    </form>

    <a href="index.php">Kembali</a>
</body>
</html>
