<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>fasilitas</title>
    <link rel="stylesheet" href="stylefslts.css">
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
<a href="tambahf2.php"><p> tambah gambar </p></a>


    <table border="1">
        <tr>
            <th>Nama</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>
        <?php
        include("koneksi.php");

        $query = mysqli_query($db, "SELECT * FROM fasilitas");
        while($row = mysqli_fetch_assoc($query)){
            echo '<tr>';
            echo '<td>'.$row['nama'].'</td>';
            echo '<td><img src="./foto_fasilitas/'.$row['gambar'].'" width="100"></td>';
            echo '<td><a href="?delete_id='.$row['id_fasilitas'].'">Delete</a> || <a href="editfasilitas.php?id='.$row['id_fasilitas'].'">Edit</a></td>';
            echo '</tr>';
        }

        // Delete Action
        if(isset($_GET['delete_id'])) {
            $deleteId = $_GET['delete_id'];
            $deleteQuery = "DELETE FROM fasilitas WHERE id_fasilitas = $deleteId";
            mysqli_query($db, $deleteQuery);
        }
        ?>
        
    </table> 

</body>
</html>
