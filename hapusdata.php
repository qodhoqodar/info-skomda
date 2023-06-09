<?php

include "koneksi.php";

if( isset($_GET['id_guru']) ){

    $id_guru = $_GET['id_guru'];
    $sql = "DELETE FROM guru WHERE id_guru=$id_guru";
    $query = mysqli_query($db, $sql);

    if($query ){
        header('Location: index.php');

    }
    else{
        die("gagal");
    }
}?>