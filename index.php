<?php include("koneksi.php"); ?>

<html>

<head>
	<title> informasi skomda </title>
	<link rel="stylesheet" href="style.css">
</head>

<Body>
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
	<a href="tambah.php">
		<p> Tambah Data Guru</p>
	</a>
	<table border "1">
		<thead>
			<tr>
				<th>No</th>
				<th>nama</th>
				<th>jabatan</th>
				<th>no.telp</th>
				<th>jenis_kelamin</th>
				<th>foto</th>
				<th>aksi</th>
			</tr>
		</thead>
		</tbody>

		<?php
		$sql = "SELECT * FROM guru";
		$query = mysqli_query($db, $sql);
		$no = 1;

		while ($guru = mysqli_fetch_array($query)) {
			echo "<tr>";

			echo "<td>" . $no++ . "</td>";
			echo "<td>" . $guru['nama'] . "</td>";
			echo "<td>" . $guru['jabatan'] . "</td>";
			echo "<td>" . $guru['no_telp'] . "</td>";
			echo "<td>" . $guru['jenis_kelamin'] . "</td>";
			echo '<td><img src="./foto_guru/' . $guru['foto_guru'] . '" width="100"></td>';
			echo "<td>";
			echo "<a href='edit.php?id_guru=" . $guru['id_guru'] . "'>edit</a> |";
			echo "<a href=\"hapusdata.php?id_guru=$guru[id_guru]\"onClick=\"return confirm('yakin mau hapus?')\">hapus</a>";
			echo "</tr>";
		}
		?>
	</table>
</Body>

</html>