<?php
include("koneksi.php");

// Fungsi hapus data
if (isset($_GET['hapus'])) {
    $id_ekskul = $_GET['hapus'];
    $sql_hapus = "DELETE FROM ekskul WHERE id_ekskul = '$id_ekskul'";
    mysqli_query($db, $sql_hapus);
    header("Location: ekskul.php"); // Redirect kembali ke halaman utama
    exit();
}
?>

<html>
<head>
    <title>ekskul</title>
    <link rel="stylesheet" href="styleeks.css">
</head>

<body>
<style>
		nav {
    background-color: #e10c0c;
    height: 50px;
  }
  
  ul {
    list-style-type: none;
    margin: 0;
    margin-left: 900px;
  }
  
  li {
    display: inline;
  }
  
  li a {
    color: white;
    display: inline-block;
    padding: 10px;
    text-decoration: none;
    font-weight: bold;
  }
  
  li a:hover {
    background-color: #555;
  }
  
	</style>
	<nav>
		<ul>
			<li><a href="index.php">Guru</a></li>
			<li><a href="fasilitas.php">Fasilitas</a></li>
			<li><a href="ekskul.php">Ekskul</a></li>
		</ul>
	</nav>
    <a href="tambaheks.php">
        <p>Tambah Data Ekskul</p>
    </a>
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Ekstrakurikuler</th>
                <th>Kelengkapan</th>
                <th>aksi</th>
            </tr>
        </thead>
        <tbody>

        <?php
        $sql = "SELECT * FROM ekskul";
        $query = mysqli_query($db, $sql);
        $no = 1;

        while ($ekskul = mysqli_fetch_array($query)) {
            echo "<tr>";
            echo "<td>".$no++."</td>";
            echo "<td>".$ekskul['nama_ekskul']."</td>";
            echo "<td>".$ekskul['kelengkapan']."</td>";
            echo "<td>";
            echo "<a href='editeks.php?id_ekskul=".$ekskul['id_ekskul']."'>edit</a> |";
            echo "<a href='ekskul.php?hapus=".$ekskul['id_ekskul']."' onClick=\"return confirm('yakin mau hapus?')\">hapus</a>";
            echo "</td>";
            echo "</tr>";
        }
        ?>

        </tbody>
    </table>
</body>
</html>
