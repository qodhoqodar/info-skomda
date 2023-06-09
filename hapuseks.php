<?php
include("koneksi.php");

if(isset($_GET['id_ekskul'])){
    $id_ekskul = $_GET['id_ekskul'];

    $sql = "DELETE FROM ekskul WHERE id_ekskul='$id_ekskul'";
    $query = mysqli_query($db, $sql);

    if($query){
        echo "Data berhasil dihapus.";
    }else{
        echo "Error: " . mysqli_error($db);
    }
}
?>
